<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Traits;

use Illuminate\View\ComponentAttributeBag;

trait THasLabelHtmlAttributes
{

    protected ComponentAttributeBag $labelHtmlAttributes;

    //////////////////////////////////////////////////////// Getters / Setters

    public function getLabelHtmlAttributes(): ComponentAttributeBag
    {
        if (!isset($this->labelHtmlAttributes)) {
            $this->labelHtmlAttributes = new ComponentAttributeBag();
        }

        return $this->labelHtmlAttributes;
    }

    public function updateLabelHtmlAttributes(callable $callback): static
    {
        if (!isset($this->labelHtmlAttributes)) {
            $this->labelHtmlAttributes = new ComponentAttributeBag();
        }

        $this->labelHtmlAttributes = $callback($this->labelHtmlAttributes);

        return $this;
    }

    public function setLabelHtmlAttribute(string $name, string $value): static
    {
        if (!isset($this->labelHtmlAttributes)) {
            $this->labelHtmlAttributes = new ComponentAttributeBag();
        }

        $this->labelHtmlAttributes = $this->labelHtmlAttributes->merge([$name => $value]);

        return $this;
    }

    public function setLabelHtmlAttributes(ComponentAttributeBag $labelHtmlAttributes): static
    {
        $this->labelHtmlAttributes = $labelHtmlAttributes;

        return $this;
    }

}
