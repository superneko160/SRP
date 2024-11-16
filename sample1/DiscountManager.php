<?php

require_once 'Product.php';
require_once 'ProductDiscount.php';
require_once 'discountLogic.php';

class DiscountManger {
    public array $discount_products;
    public int $total_price;

    /**
     * 商品を追加する
     * @param Product $product 商品
     * @param ProductDiscount $product_discount 商品割引情報
     * @return bool 追加成功true、追加失敗false
     */
    public function add(Product $product, ProductDiscount $product_discount): bool {
        if ($product->id < 0) {
            throw new Exception('商品IDが不正値です');
        }

        if (empty($product->name)) {
            throw new Exception('商品名が未設定です');
        }

        if ($product->price < 0) {
            throw new Exception('商品価格が不正値です');
        }

        if ($product->id !== $product_discount->id) {
            throw new Exception('商品IDが一致しませんでした');
        }

        // 割引価格の計算
        $discount_price = getDisCountPrice($product->price);

        // 割引可能の場合、割引価格を総額に加算。そうでない場合、通常価格を加算
        $tmp = 0;
        if ($product_discount.canDiscount) {
            $tmp = $total_price + $discount_price;
        } else {
            $tmp = $total_price + $product->price;
        }

        // 総額上限20000円以内の場合、商品リストに追加
        if ($tmp <= 20000) {
            $total_price = $tmp;
            $discount_price.add($product);
            return true;
        }

        return false;
    }
}
