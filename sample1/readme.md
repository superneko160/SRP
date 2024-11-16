# SRPに反している例

## SRPに反していた場合、なにが起こるか

ECサイトに割引サービスが追加されることになった。通常の割引は以下の仕様とする。

- 商品1点につき、300円割り引く
- 上限20000円まで商品を追加可能

開発者は、上の仕様ともとに、下記のクラスを作成した。

- `DiscountManager`（割引商品に関連するクラス）
- `Product`（商品クラス）
- `ProuctDiscount`（商品割引情報クラス）

しばらくして、通常割引以外に、夏季限定の割引の仕様が追加されたとする。  
仕様は以下の通り。

- 商品1点につき、300円割り引く
- 上限30000円まで商品を追加可能

開発者は、上の仕様をもとに`SummberDiscountManager`クラスを新規作成した。

さらにしばらくして、以下のような仕様変更が発生した。

- 通常割引の割引価格を300円から400円に変更する

実装担当は以下のように、`getDiscountPrice`を修正した。

```php
/**
 * 割引価格の取得
 * @param int $price 商品価格
 * @return int 割引価格
 */
function getDisCountPrice(int $price): int {
    $discount_price = $price - 400;  // 300から400円に変更
    if ($discount_price < 0) {
        $discount_price = 0;
    }
    return $discount_price;
}
```

すると、下記割引サービスでも割り引かれる価格が400円になってしまった。夏季割引サービスを担う`SummerDiscountManager`で、`getDiscountPrice`関数が流用されていたからである。

```php
$tmp = $total_price + $discount_manager->getDisCountPrice($product->price);
```

また、マイナス価格の商品を下記割引に追加できてしまうようなバグも見受けられた。

`DiscountManager`クラスには存在している以下のような価格チェックのロジックが`SummerDiscountManager`では未実装だったからである。

```php
if ($product->price < 0) {
    throw new Exception('商品価格が不正値です');
}

if ($product->id !== $product_discount->id) {
    throw new Exception('商品IDが一致しませんでした');
}
```

## 責務（責任）

この割引サービスのロジックは、実装する場所に問題がある。

- `DiscountManager`（と`SummerDiscountManager`）が、商品情報のチェック、割引価格の計算、割引適用の判断、総額上限のチェックなど多くの処理を実装しすぎている。
- `Product`クラス自身に持たせるべきバリデーションを、`DiscountManager`と`SummerDiscountManager`が持っている
- 夏季割引価格の計算のために、`SummerDiscountManager`が`DiscountManager`の通常割引のロジックを流用している

一部のクラスに処理が集中していたり、別のクラスでは自らがやるべき処理が書かれていなかったり、ほかのクラスの一部のメソッドを流用していたり、**責務**が考慮されていない。
