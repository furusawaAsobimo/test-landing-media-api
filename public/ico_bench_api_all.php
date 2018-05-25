<?php 
// Composerオートローダを読み込む
require_once '../vendor/autoload.php';

$api = new ICObenchAPI();
$api->getICOs("all");

echo $api->result;
exit;