<?php 
// Composerオートローダを読み込む
require_once '../vendor/autoload.php';
// page指定
$id = isset($_GET['id']) ? $_GET['id'] : 1;

$api = new ICObenchAPI();
$api->getICO($id);

echo $api->result;
exit;