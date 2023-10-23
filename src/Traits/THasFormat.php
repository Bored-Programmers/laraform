<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Traits;

trait THasFormat
{

    protected string $format = 'd.m.Y';

    //////////////////////////////////////////////////////// Getters / Setters

    public function getFormat(): string
    {
        return $this->format;
    }

    public function setFormat(string $format): static
    {
        $this->format = $format;

        return $this;
    }

}
