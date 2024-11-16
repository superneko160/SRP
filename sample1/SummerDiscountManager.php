<?php

require_once 'DiscountManager.php';

class SummerDiscountManager {
    public DiscountManger $discount_manager;

    /**
     * 商品を追加する
     */
    public function add(Product $product): bool {
        if ($product->id < 0) {
            throw new Exception('商品IDが不正値です');
        }

        if (empty($product->name)) {
            throw new Exception('商品名が未設定です');
        }

        // 割引可能の場合、割引価格を総額に加算。そうでない場合、通常価格を加算
        $tmp = 0;
        if ($product_discount.canDiscount) {
            $tmp = $total_price + $discount_manager->getDisCountPrice($product->price);
        } else {
            $tmp = $total_price + $product->price;
        }

        // 総額上限30000円以内の場合、商品リストに追加
        if ($tmp <= 30000) {
            $total_price = $tmp;
            $discount_price.add($product);
            return true;
        }

        return false;
    }
}
