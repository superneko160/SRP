<?php

class Product {
    public int $id;
    public string $name;
    public int $price;
    public bool $canDiscount;  // SummerDiscountManager作成時に追加
}
