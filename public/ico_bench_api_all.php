<?php 
// Composerオートローダを読み込む
require_once '../vendor/autoload.php';
// page指定
$page = isset($_GET['page']) ? $_GET['page'] : 0;

$api = new ICObenchAPI();
$api->getICOs("all",["orderDesc"=>"rating","status"=>"active","page"=>$page]);

echo $api->result;
exit;