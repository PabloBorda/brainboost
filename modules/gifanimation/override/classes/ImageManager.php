<?php
/**
* Modulo Gif Animation for Product Sheet
*
* @author    Kijam
* @copyright 2016 Kijam
* @license   Commercial use allowed (Non-assignable & non-transferable), can modify source-code but cannot distribute modifications (derivative works).
*/

class ImageManager extends ImageManagerCore
{
    public static function resize(
        $src_file,
        $dst_file,
        $dst_width = null,
        $dst_height = null,
        $file_type = 'jpg',
        $force_type = false,
        &$error = 0,
        &$tgt_width = null,
        &$tgt_height = null,
        $quality = 5,
        &$src_width = null,
        &$src_height = null
    ) {
        static $time_init, $is_active, $file_type, $is_gif, $list_frames, $duration_frames;
        $is_16 = version_compare(_PS_VERSION_, '1.6.0.3') >= 0;
        if (!class_exists('\GifFrameExtractor\GifFrameExtractor') && file_exists(_PS_MODULE_DIR_.'gifanimation/lib/GifFrameExtractor/GifFrameExtractor.php')) {
            include_once(_PS_MODULE_DIR_.'gifanimation/lib/GifFrameExtractor/GifFrameExtractor.php');
        }
        if (!is_array($file_type)) {
            $time_init = time();
            $instance = Module::getInstanceByName('gifanimation');
            $is_active = $instance && $instance->active;
            $file_type = array();
            $list_frames = array();
            $duration_frames = array();
            $is_gif = array();
        }
        if (!file_exists($src_file) || !filesize($src_file)) {
            return $is_16?!($error = self::ERROR_FILE_NOT_EXIST):false;
        }
        if (!isset($file_type[$src_file])) {
            $file_type[$src_file] = getimagesize($src_file);
            list($tmp_width, $tmp_height, $type) = $file_type[$src_file];
            if ($type == IMAGETYPE_GIF) {
                $is_gif[$src_file] = \GifFrameExtractor\GifFrameExtractor::isAnimatedGif($src_file);
            } else {
                $is_gif[$src_file] = false;
            }
        }
        if (!$is_active || !$is_gif[$src_file]) {
            if (!$is_16) {
                return ImageManagerCore::resize($src_file, $dst_file, $dst_width, $dst_height, $file_type, $force_type);
            }
            if (version_compare(_PS_VERSION_, '1.6.1.0') < 0) {
                return ImageManagerCore::resize($src_file, $dst_file, $dst_width, $dst_height, $file_type, $force_type, $error);
            }
            return ImageManagerCore::resize($src_file, $dst_file, $dst_width, $dst_height, $file_type, $force_type, $error, $tgt_width, $tgt_height, $quality, $src_width, $src_height);
        }
        list($tmp_width, $tmp_height, $type) = $file_type[$src_file];
        if (PHP_VERSION_ID < 50300) {
            clearstatcache();
        } else {
            clearstatcache(true, $src_file);
        }
        $rotate = 0;
        if (function_exists('exif_read_data') && function_exists('mb_strtolower')) {
            $exif = @exif_read_data($src_file);
            if ($exif && isset($exif['Orientation'])) {
                switch ($exif['Orientation']) {
                    case 3:
                        $src_width = $tmp_width;
                        $src_height = $tmp_height;
                        $rotate = 180;
                        break;
                    case 6:
                        $src_width = $tmp_height;
                        $src_height = $tmp_width;
                        $rotate = -90;
                        break;
                    case 8:
                        $src_width = $tmp_height;
                        $src_height = $tmp_width;
                        $rotate = 90;
                        break;
                    default:
                        $src_width = $tmp_width;
                        $src_height = $tmp_height;
                }
            } else {
                $src_width = $tmp_width;
                $src_height = $tmp_height;
            }
        } else {
            $src_width = $tmp_width;
            $src_height = $tmp_height;
        }
        if (!$src_width) {
            return $is_16?!($error = self::ERROR_FILE_WIDTH):false;
        }
        if (!$dst_width) {
            $dst_width = $src_width;
        }
        if (!$dst_height) {
            $dst_height = $src_height;
        }
        $width_diff = $dst_width / $src_width;
        $height_diff = $dst_height / $src_height;
        $ps_image_generation_method = Configuration::get('PS_IMAGE_GENERATION_METHOD');
        if ($width_diff > 1 && $height_diff > 1) {
            $next_width = $src_width;
            $next_height = $src_height;
        } else {
            if ($ps_image_generation_method == 2 || (!$ps_image_generation_method && $width_diff > $height_diff)) {
                $next_height = $dst_height;
                $next_width = round(($src_width * $next_height) / $src_height);
                $dst_width = (int)(!$ps_image_generation_method ? $dst_width : $next_width);
            } else {
                $next_width = $dst_width;
                $next_height = round($src_height * $dst_width / $src_width);
                $dst_height = (int)(!$ps_image_generation_method ? $dst_height : $next_height);
            }
        }
        if (!ImageManager::checkImageMemoryLimit($src_file)) {
            return $is_16?!($error = self::ERROR_MEMORY_LIMIT):false;
        }
        $tgt_width  = $dst_width;
        $tgt_height = $dst_height;
        $max_time = ((float)ini_get('max_execution_time')) * 0.9;
        //echo var_dump(ini_get('max_execution_time'));
        //echo var_dump($max_time);
        //echo (time() - $time_init);
        if (class_exists('Imagick') && method_exists('Imagick', 'getVersion')) {
            $imagick = new Imagick($src_file);
            $imagick = $imagick->coalesceImages();
            do {
                if (time() - $time_init > $max_time) {
                    return $is_16?!($error = self::ERROR_MEMORY_LIMIT):false;
                }
                $imagick->resizeImage((int)$dst_width, (int)$dst_height, Imagick::FILTER_LANCZOS, 1, true);
            } while ($imagick->nextImage());
            $imagick = $imagick->deconstructImages();
            if ($imagick->writeImages($dst_file.'.gif', true)) {
                rename($dst_file.'.gif', $dst_file);
                return true;
            } else {
                return $is_16?!($error = self::ERROR_MEMORY_LIMIT):false;
            }
        } else {
            if (!class_exists('\GifCreator\GifCreator')) {
                include_once(_PS_MODULE_DIR_.'gifanimation/lib/GifCreator/GifCreator.php');
            }
            if (!class_exists('\PHPImageWorkshop\ImageWorkshop')) {
                include_once(_PS_MODULE_DIR_.'gifanimation/lib/PHPImageWorkshop/ImageWorkshop.php');
            }
            try {
                if (!isset($list_frames[$src_file])) {
                    $gfe = new \GifFrameExtractor\GifFrameExtractor();
                    $list_frames[$src_file] = $gfe->extract($src_file);
                    foreach ($list_frames[$src_file] as &$frame) {
                        $frame['layer'] = \PHPImageWorkshop\ImageWorkshop::initFromResourceVar($frame['image']);
                    }
                    $duration_frames[$src_file] = $gfe->getFrameDurations();
                }
                $retouchedFrames = array();
                foreach ($list_frames[$src_file] as &$frame) {
                    if (time() - $time_init > $max_time) {
                        return $is_16?!($error = self::ERROR_MEMORY_LIMIT):false;
                    }
                    $frameLayer = clone $frame['layer'];
                    $frameLayer->resizeInPixel((int)$dst_width, (int)$dst_height, true);
                    $retouchedFrames[] = $frameLayer->getResult('ffffff');
                    $frameLayer->delete();
                    unset($frameLayer);
                }
                $gc = new \GifCreator\GifCreator();
                $gc->create($retouchedFrames, $duration_frames[$src_file], 0);
                file_put_contents($dst_file, $gc->getGif());
                return true;
            } catch (Exception $e) {
                //echo "Error on PHPImageWorkshop: ".print_r($e, true);
                return $is_16?!($error = self::ERROR_MEMORY_LIMIT):false;
            }
        }
    }
}
