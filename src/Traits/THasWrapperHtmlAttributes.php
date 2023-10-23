<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Traits;

use Illuminate\View\ComponentAttributeBag;

trait THasWrapperHtmlAttributes
{

    protected ComponentAttributeBag $wrapperHtmlAttributes;

    //////////////////////////////////////////////////////// Getters / Setters

    public function getWrapperHtmlAttributes(): ComponentAttributeBag
    {
        if (!isset($this->wrapperHtmlAttributes)) {
            $this->wrapperHtmlAttributes = new ComponentAttributeBag();
        }

        return $this->wrapperHtmlAttributes;
    }

    public function updateWrapperHtmlAttributes(callable $callback): static
    {
        if (!isset($this->wrapperHtmlAttributes)) {
            $this->wrapperHtmlAttributes = new ComponentAttributeBag();
        }

        $this->wrapperHtmlAttributes = $callback($this->wrapperHtmlAttributes);

        return $this;
    }

    public function setWrapperHtmlAttribute(string $name, string $value): static
    {
        if (!isset($this->wrapperHtmlAttributes)) {
            $this->wrapperHtmlAttributes = new ComponentAttributeBag();
        }

        $this->wrapperHtmlAttributes = $this->wrapperHtmlAttributes->merge([$name => $value]);

        return $this;
    }

    public function setWrapperHtmlAttributes(ComponentAttributeBag $wrapperHtmlAttributes): static
    {
        $this->wrapperHtmlAttributes = $wrapperHtmlAttributes;

        return $this;
    }

}
