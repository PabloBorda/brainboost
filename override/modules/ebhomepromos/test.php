<?php
$sql = 'UPDATE ps_module_shop set enable_device="7" where id_module="86"';
echo $sql;
if (!Db::getInstance()->execute($sql))
    die('error!');
?>