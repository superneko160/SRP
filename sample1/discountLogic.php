<?php

/**
 * 割引価格の取得
 * @param int $price 商品価格
 * @return int 割引価格
 */
function getDisCountPrice(int $price): int {
    $discount_price = $price - 300;
    if ($discount_price < 0) {
        $discount_price = 0;
    }
    return $discount_price;
}
