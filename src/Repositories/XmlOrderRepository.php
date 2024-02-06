<?php

namespace App\Repositories;

use App\Interfaces\OrderInterfaceRepository;
use App\Models\Order;
use App\Models\Product;

final class XmlOrderRepository implements OrderInterfaceRepository {

    private $xmlFile = __DIR__. '/orders.xml';

    /**
     * Gets all orders.
     * 
     * @return array
     */
    public function getAllOrders(): array {

        $orders = simplexml_load_file($this->xmlFile);

        $allOrders = [];

        foreach ($orders->order as $order) {

            $orderData = new Order(
                (int)$order->id,
                (string)$order->currency,
                (string)$order->date,
                $this->parseProducts($order->products),
                (float)$order->total
            );

            $allOrders[] = $orderData;

        }

        return $allOrders;
    }

    /**
     * Gets a specific order.
     * 
     * @param int $orderId
     * @return Order|null
     */
    public function getOrder(int $orderId): Order|null {

        $orders = simplexml_load_file($this->xmlFile);
        
        foreach ($orders->order as $o) {
        
            if ((int)$o->id === (int)$orderId) {

                return new Order(
                    (int)$o->id,
                    (string)$o->currency,
                    (string)$o->date,
                    $this->parseProducts($o->products),
                    (float)$o->total
                );

            }

        }

        return null;
    }

    /**
     * Updates/Amends a specific order.
     * 
     * @param int $orderId
     * @param $newData
     * @return string
     */
    public function editOrder(int $orderId, array $newData): string {

        $orders = simplexml_load_file($this->xmlFile);
        
        $orderFound = false;
        
        foreach ($orders->order as $o) {

            if ((int)$o->id === (int)$orderId) {

                $o->currency = $newData['currency'];

                if (isset($newData['products'])) {

                    unset($o->products->product);

                    foreach ($newData['products'] as $product) {
                        $newProduct = $o->products->addChild('product');
                        $newProduct->addAttribute('title', $product['title']);
                        $newProduct->addAttribute('price', $product['price']);
                    }

                }

                $orders->asXML($this->xmlFile); // Save changes to XML file
                
                $orderFound = true;

                break;
            }
        }

        if ($orderFound) {

            return "Order with ID $orderId has been updated.";

        } else {

            return "Order with ID $orderId not found.";

        }

    }

    /**
     * @param $products
     * 
     * @return array
     */
    private function parseProducts($products): array {

        $parsedProducts = [];
        
        foreach ($products->product as $product) {
        
            $parsedProducts[] = new Product(
                (string)$product['title'],
                (float)$product['price']
            );
        
        }
        
        return $parsedProducts;
    }
}

?>
