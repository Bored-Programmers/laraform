<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Traits;

trait THasLabel
{

    protected ?string $label = null;

    protected bool $showLabel = true;

    //////////////////////////////////////////////////////// Getters / Setters

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getShowLabel(): bool
    {
        return $this->showLabel;
    }

    public function setShowLabel(bool $showLabel): static
    {
        $this->showLabel = $showLabel;

        return $this;
    }

}
