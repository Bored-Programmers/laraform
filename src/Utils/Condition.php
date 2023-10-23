<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Utils;

use JetBrains\PhpStorm\ArrayShape;

class Condition
{

    #[ArrayShape(['a' => 'mixed', 'b' => 'mixed', 'operand' => 'string', 'type' => 'string'])]
    private array $conditions = [];

    private bool $falsy = false;

    public static function make(): static
    {
        return new static();
    }

    public function and(string $a, string $operandOrB, ?string $b = null): static
    {
        $this->conditions[] = [
            'a' => $a,
            'b' => null === $b && 2 === func_num_args() ? $operandOrB : $b,
            'operand' => null === $b && 2 === func_num_args() ? '===' : $operandOrB,
            'type' => '&&',
        ];

        return $this;
    }

    public function or(string $a, string $operandOrB, ?string $b = null): static
    {
        $this->conditions[] = [
            'a' => $a,
            'b' => null === $b && 2 === func_num_args() ? $operandOrB : $b,
            'operand' => null === $b && 2 === func_num_args() ? '===' : $operandOrB,
            'type' => '||',
        ];

        return $this;
    }

    public function falsy(): static
    {
        $this->falsy = true;

        return $this;
    }

    public function truthy(): static
    {
        $this->falsy = false;

        return $this;
    }

    #[ArrayShape(['a' => 'mixed', 'b' => 'mixed', 'operand' => 'string', 'type' => 'string'])]
    public function getConditions(): array
    {
        return $this->conditions;
    }

    public function getFalsy(): bool
    {
        return $this->falsy;
    }

}
