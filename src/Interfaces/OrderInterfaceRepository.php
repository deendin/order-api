<?php

namespace App\Interfaces;

interface OrderInterfaceRepository {

    /**
     * @param int $orderId
     */
    public function getOrder(int $orderId);

    /**
     * @param int $orderId
     * @param array $newOrderData
     */
    public function editOrder(int $orderId, array $newOrderData);

}