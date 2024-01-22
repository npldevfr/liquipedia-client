<?php

namespace KCNetwork\Liquipedia\Query;

use stdClass;

class QueryParameter implements QueryParametersInterface
{
    private stdClass $params;

    public function __construct(array $params = [])
    {
        $this->params = (object) $params;

        foreach ($this->params as $key => $value) {
            $this->generateMethod($key);
        }
    }

    private function generateMethod(string $key): void
    {
        $methodName = 'get'.ucfirst($key);
        $this->{$methodName} = fn () => $this->params->{$key};
    }

    public function toArray(): array
    {
        return (array) $this->params;
    }

    public function __toString(): string
    {
        return json_encode($this->params, JSON_THROW_ON_ERROR);
    }

    public function __get(string $name): mixed
    {
        return $this->params->{$name};
    }

    public function __set(string $name, mixed $value): void
    {
        $this->params->{$name} = $value;
        $this->generateMethod($name);
    }

    public function __isset(string $name): bool
    {
        return isset($this->params->{$name});
    }

    public function __unset(string $name): void
    {
        unset($this->params->{$name});
        unset($this->{'get'.ucfirst($name)});
    }
}
