# SRP（Single Responsibility Principle）の学習用リポジトリ

## SRP（単一責任の原則）

SOLID原則のS。個々のモジュール（関数やクラス）は、ひとつの責任だけを持つべきという原則。  
責任は、そのシステムを使うアクターに対して持つ。  

アクターとは、UML、ユースケース図で使われるような棒人間を指す。

![sample2-2.php](https://github.com/superneko160/SRP/blob/main/images/ec_system_uml.drawio.svg)

クラスを「共通して利用できる汎用的な部品」と捉えてしまう者がいるが、それはシステムを作成時には弊害となるケースがある。  
逆に**特定の目的に特化した変更に強い構造**にする、これがSRPである。
