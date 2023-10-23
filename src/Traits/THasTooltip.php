<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Traits;

trait THasTooltip
{

    protected ?string $tooltip = null;

    protected ?string $tooltipIcon = 'question';

    //////////////////////////////////////////////////////// Getters / Setters

    public function getTooltip(): ?string
    {
        return $this->tooltip;
    }

    public function setTooltip(?string $tooltip): static
    {
        $this->tooltip = $tooltip;

        return $this;
    }

    public function getTooltipIcon(): ?string
    {
        return $this->tooltipIcon;
    }

    public function setTooltipIcon(?string $tooltipIcon): static
    {
        $this->tooltipIcon = $tooltipIcon;

        return $this;
    }

}
