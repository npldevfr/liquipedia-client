<?php

namespace Npldevfr\Liquipedia;

use Exception;
use Npldevfr\Liquipedia\Interfaces\ConditionsBuilderInterface;
use Npldevfr\Liquipedia\Meta\Operator;

final class ConditionsBuilder implements ConditionsBuilderInterface
{
    private string $raw;

    public function __construct(?string $raw = null)
    {
        $this->raw = $raw ?? '';
    }

    public static function build(
        ?string $key = null,
        ?string $operator = null,
        ?string $value = null
    ): self {
        if (is_null($key) && is_null($operator) && is_null($value)) {
            return new self();
        }

        if (isset($key) && isset($operator) && isset($value)) {
            self::ensureValidOperator($operator);

            return new self("([[$key$operator$value]])");
        }

        throw new Exception('[LiquipediaBuilder] Invalid arguments, you have to set all or none of them.');
    }

    /**
     * @throws Exception
     */
    private static function ensureValidOperator(string $operator): void
    {
        $isValid = in_array($operator, Operator::all());

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

    public function andManyAnd(string $key, string $operator, array $values): self
    {
        self::ensureValidOperator($operator);

        $raws = array_map(fn ($value): string => "[[$key$operator$value]]", $values);

        $this->raw .= ($this->isEmpty() ? '' : ' AND ').'('.implode(' AND ', $raws).')';

        return $this;
    }

    private function isEmpty(): bool
    {
        return $this->raw === '';
    }

    public function toValue(): string
    {
        return $this->raw;
    }

    public function andManyOr(string $key, string $operator, array $values): ConditionsBuilderInterface
    {
        self::ensureValidOperator($operator);

        $raws = array_map(fn ($value): string => "[[$key$operator$value]]", $values);

        $this->raw .= ($this->isEmpty() ? '' : ' AND ').'('.implode(' OR ', $raws).')';

        return $this;
    }

    public function or(string $key, string $operator, string $value): ConditionsBuilderInterface
    {
        self::ensureValidOperator($operator);

        $this->raw .= ' OR ([['.$key.$operator.$value.']])';

        return $this;
    }

    public function orManyAnd(string $key, string $operator, array $values): ConditionsBuilderInterface
    {
        self::ensureValidOperator($operator);

        $raws = array_map(fn ($value): string => "[[$key$operator$value]]", $values);

        $this->raw .= ($this->isEmpty() ? '' : ' OR ').'('.implode(' AND ', $raws).')';

        return $this;
    }

    public function orManyOr(string $key, string $operator, array $values): ConditionsBuilderInterface
    {
        self::ensureValidOperator($operator);

        $raws = array_map(fn ($value): string => "[[$key$operator$value]]", $values);

        $this->raw .= ($this->isEmpty() ? '' : ' OR ').'('.implode(' OR ', $raws).')';

        return $this;
    }
}
