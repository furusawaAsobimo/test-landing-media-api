<?php 
// load Composer
require_once '../vendor/autoload.php';
// query:page
$page = isset($_GET['page']) ? $_GET['page'] : 0;
// query:status
$status = isset($_GET['status']) ? $_GET['status'] : 'active';
// order:setting
$order = [];
// query:order_key
$order['key'] = isset($_GET['order_key']) && ($_GET['order_key'] == 'Asc') ? 'Asc' : 'Desc';
// query:order_val
$order['val'] = isset($_GET['order_val']) ? $_GET['order_val'] : 'rating';

$api = new ICObenchAPI();
$api->getICOs("all",["order{$order['key']}" => $order['val'], "status" => $status, "page" => $page]);

echo $api->result;
exit;