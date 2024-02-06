<?php

namespace App\Models;

class Order {
    public $id;
    public $currency;
    public $date;
    public $products;
    public $total;

    public function __construct($id, $currency, $date, $products, $total) {
        $this->id = $id;
        $this->currency = $currency;
        $this->date = $date;
        $this->products = $products;
        $this->total = $total;
    }
}