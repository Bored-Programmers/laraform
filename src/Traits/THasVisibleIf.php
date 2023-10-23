<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Traits;

use BoredProgrammers\LaraForm\Utils\Condition;

trait THasVisibleIf
{

    protected array $visibleIf = [];

    //////////////////////////////////////////////////////// Getters / Setters

    public function getVisibleIf(): array
    {
        return $this->visibleIf;
    }

    public function getVisibleIfFormatted(): string
    {
        $conditions = [];

        foreach ($this->visibleIf as $name => $show) {
            if (true === $show) {
                $conditions[] = '%toggleState%[\'' . addslashes($name) . '\'] === true';
            } elseif ($show instanceof Condition) {
                $cond = '';

                foreach ($show->getConditions() as $condition) {
                    $a = str_starts_with($condition['a'], '"') || str_starts_with($condition['a'], "'")
                        ? htmlspecialchars($condition['a'])
                        : '%toggleState%[\'' . addslashes($condition['a']) . '\']';
                    $b = str_starts_with($condition['b'], '"') || str_starts_with($condition['b'], "'")
                        ? htmlspecialchars($condition['b'])
                        : '%toggleState%[\'' . addslashes($condition['b']) . '\']';

                    if (!$cond) {
                        $cond = $a . ' ' . $condition['operand'] . ' ' . $b;
                    } else {
                        $cond .= ' ' . $condition['type'] . ' ' . $a . ' ' . $condition['operand'] . ' ' . $b;
                    }
                }

                $conditions[] = $cond;
            } else {
                $conditions[] = '!%toggleState%[\'' . addslashes($name) . '\']';
            }
        }

        return implode(' && ', $conditions);
    }

    public function visibleIf(Condition|string $idOrCondition, bool $show = true): static
    {
        if ($idOrCondition instanceof Condition) {
            $this->visibleIf[] = $idOrCondition;
        } else {
            $this->visibleIf[$idOrCondition] = $show;
        }

        return $this;
    }

}
