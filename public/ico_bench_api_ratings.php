<?php 
// Composerオートローダを読み込む
require_once '../vendor/autoload.php';

$api = new ICObenchAPI();
$api->getICOs("ratings");

echo $api->result;
exit;