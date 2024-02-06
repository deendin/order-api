<?php

namespace App;

require 'vendor/autoload.php';

use App\Route;
use App\Repositories\XmlOrderRepository;

$route = new Route();

$xmlOrderRepository = new XmlOrderRepository();

/**
 *  Route Definitions
 */

 // Get orders
$route->addRoute('GET', '/orders', function() use ($xmlOrderRepository) {
    $allOrders = $xmlOrderRepository->getAllOrders();
    json_response($allOrders);
});

$route->addRoute('GET', '/order/(\d+)', function($orderId) use ($xmlOrderRepository) {
    $order = $xmlOrderRepository->getOrder($orderId);
    if ($order) {
        json_response($order);
    } else {
        header('Content-Type: application/json');
        http_response_code(404);
        echo json_encode(['error' => 'Order not found']);
    }
});

$route->addRoute('PUT', '/order/(\d+)', function($orderId) use ($xmlOrderRepository) {

    $requestData = json_decode(file_get_contents('php://input'), true);
 
    $editResult = $xmlOrderRepository->editOrder($orderId, $requestData);

    header('Content-Type: application/json');
 
    echo json_encode(['message' => $editResult]);
});


$method = $_SERVER['REQUEST_METHOD'];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$route->handle($method, $uri);