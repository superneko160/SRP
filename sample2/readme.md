# SRPを守っている例

## 疎結合

- `RegularDiscount`
- `RegularDiscountPrice`
- `RegularDiscountPrice`

クラスが通常割引価格、夏季割引価格と責務ごとに個別に分かれている。そのため、割引価格の仕様変更があったとしても、互いに影響はない。このように関心事が分離（独立）している構造を**疎結合**と呼ぶ。
