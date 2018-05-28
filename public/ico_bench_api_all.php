<?php 
// Composerオートローダを読み込む
require_once '../vendor/autoload.php';

$api = new ICObenchAPI();
$api->getICOs("all",["orderDesc"=>"rating","status"=>"active"]);

echo $api->result;
exit;