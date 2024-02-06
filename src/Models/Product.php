<?php

namespace App\Models;

class Product {
    public function __construct(public string $title, public string $price) {}
}