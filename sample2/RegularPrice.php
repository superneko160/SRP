<?php

class RegularPrice {
    private const MIN_AMOUNT = 0;
    public int $amount;

    public function __construct(int $amount) {
        if ($amount < self::MIN_AMOUNT) {
            throw new Exception('価格が0円以上ではありません');
        }
        $this->amount = $amount;
    }
}
