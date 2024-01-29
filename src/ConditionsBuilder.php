<?php

namespace Npldevfr\Liquipedia;

use Exception;
use Npldevfr\Liquipedia\Meta\Conditions;

final class ConditionsBuilder
{
    private string $raw;

    public function __construct(?string $raw = null)
    {
        $this->raw = $raw ?? '';
    }

    /**
     * @throws Exception
     */
    public static function build(string $key, string $operator, string $value): self
    {
        self::ensureValidOperator($operator);

        return new self("([[$key$operator$value]])");
    }

    /**
     * @throws Exception
     */
    private static function ensureValidOperator(string $operator): void
    {
        $isValid = in_array($operator, Conditions::all());

        if (! $isValid) {
            throw new Exception('[LiquipediaBuilder] Operator '.$operator.' is not valid.');
        }

    }

    public function and(string $key, string $operator, string $value): self
    {
        self::ensureValidOperator($operator);
        $this->raw .= ' AND ([['.$key.$operator.$value.']])';

        return $this;
    }

    //    public function andMany(array $conditions): self
    //    {
    //        foreach ($conditions as $key => $condition) {
    //            $this->and($key, $condition[0], $condition[1]);
    //        }
    //        return $this;
    //    }

    public function toValue(): string
    {
        return $this->raw;
    }
}
