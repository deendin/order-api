<?php

use App\Repositories\XmlOrderRepository;
use PHPUnit\Framework\TestCase;

class XmlOrderRepositoryTest extends TestCase {

    private $xmlOrderRepository;

    protected function setUp(): void {
        $this->xmlOrderRepository = new XmlOrderRepository();
    }

    public function testGetAllOrders(): void {
        $allOrders = $this->xmlOrderRepository->getAllOrders();

        $this->assertNotEmpty($allOrders);
    }

    public function testGetOrder(): void {
        $orderId = 2;
        
        $order = $this->xmlOrderRepository->getOrder($orderId);
        
        $this->assertNotNull($order);
        
        $this->assertEquals($orderId, $order->id);
    }

    public function testEditOrder(): void {
        $orderId = 1;

        $newData = [
            'currency' => 'USD',
            'products' => [
                [
                    'title' => 'New Product Title',
                    'price' => 10.99
                ],
            ]
        ];

        $editResult = $this->xmlOrderRepository->editOrder($orderId, $newData);
        
        $this->assertStringContainsString('updated', $editResult);
    }
}

?>
