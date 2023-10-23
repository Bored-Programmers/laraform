<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Traits;

trait THasType
{

    protected string $type = 'text';

    //////////////////////////////////////////////////////// Getters / Setters

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

}
