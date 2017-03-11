<?php
/**
 * 2007-2014 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * No redistribute in other sites, or copy.
 *
 * @author    RSI
 * @copyright 2007-2014 RSI
 * @license   http://localhost
 */

include('smushit.exc.php');
class SmushIt
{

    // URL to the Smush.it web service.
    const SMUSH_URL = 'http://www.resmush.it/ws.php?';

    // User agent string to set for the request.
    const USER_AGENT = 'ShushIt PHP Client/1.2 (+http://github.com/davgothic/SmushIt)';

    /**
     * @var  string  location of the image
     */
    private $image_location;

    /**
     * @var  resource  cURL handle
     */
    private $curl;

    /**
     * @var  int  time of last request
     */
    private $request_time;

    /**
     * @var  int  how often it is allowed to send requests. In microseconds
     */
    public $request_interval = 1000000;

    /**
     * Create a new SmushIt instance.
     *
     * @throws  RuntimeException
     */
    public function __construct()
    {
        if (!extension_loaded('json')) {
            throw new RuntimeException('The json extension was not found.');
        }

        if (!extension_loaded('curl')) {
            throw new RuntimeException('The cURL extension was not found.');
        }

        $this->curl = curl_init();
        curl_setopt(
            $this->curl,
            CURLOPT_RETURNTRANSFER,
            true
        );
        curl_setopt(
            $this->curl,
            CURLOPT_CONNECTTIMEOUT,
            5
        );
        curl_setopt(
            $this->curl,
            CURLOPT_USERAGENT,
            self::USER_AGENT
        );
    }

    /**
     * @param   string  location of the image
     *
     * @return  object
     *
     *  src       = source location of the input image
     *  src_size  = size of the source image in bytes
     *  dest      = temporary location of the compressed image
     *  dest_size = size of the compressed image in bytes
     *  percent   = how much smaller the compressed image is
     */
    public function compress($image_location)
    {
        // Check if we should throttle the request to once per $request_interval
        if (!empty($this->request_time)) {
            $since_last = ((microtime(true) - $this->request_time) * 1000000);

            if ($since_last < $this->request_interval) {
                // Sleep it off
                usleep($this->request_interval - $since_last);
            }
        }

        $this->request_time = microtime(true);

        $this->image_location = $image_location;

        if (preg_match('/https?:\/\//', $this->image_location) === 1
        ) {
            $result = $this->smushUrl();
        } else {
            $result = $this->smushFile();
        }

        return $result;
    }

    /**
     * Compress a remote image using the Smush.it web service.
     *
     * @return  object
     */
    private function smushUrl()
    {
        curl_setopt(
            $this->curl,
            CURLOPT_URL,
            self::SMUSH_URL.http_build_query(array('img' => $this->image_location))
        );
        $json_str = curl_exec($this->curl);

        return $this->parseResponse($json_str);
    }

    /**
     * Compress a local image using the Smush.it web service.
     *
     * @throws  SmushItException
     * @return  object
     */
    private function smushFile()
    {

        if (!is_file($this->image_location) || !is_readable($this->image_location)) {
            throw new SmushItException('Could not read image file', $this->image_location);
        }

        curl_setopt(
            $this->curl,
            CURLOPT_URL,
            self::SMUSH_URL
        );
        curl_setopt(
            $this->curl,
            CURLOPT_POST,
            true
        );
        @curl_setopt(
            $this->curl,
            CURLOPT_POSTFIELDS,
            array('files' => '@'.$this->image_location)
        );
        $json_str = curl_exec($this->curl);

        return $this->parseResponse($json_str);
    }

    /**
     * Parse the response from the Smush.it web service.
     *
     * @param   string  JSON string response from the Smush.it web service
     *
     * @throws  SmushItException
     * @return  object
     */
    private function parseResponse($json_str)
    {
        $result = Tools::jsonDecode($json_str);

        if (is_null($result)) {
            if (isset($result->error)) {
                throw new SmushItException(
                    $result->error,
                    $this->image_location
                );
            }
        }

        return $result;
    }
}
