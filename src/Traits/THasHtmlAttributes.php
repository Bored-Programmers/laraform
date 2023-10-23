<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Traits;

use Illuminate\View\ComponentAttributeBag;

trait THasHtmlAttributes
{

    protected ComponentAttributeBag $htmlAttributes;

    //////////////////////////////////////////////////////// Getters / Setters

    public function getHtmlAttributes(): ComponentAttributeBag
    {
        if (!isset($this->htmlAttributes)) {
            $this->htmlAttributes = new ComponentAttributeBag();
        }

        return $this->htmlAttributes;
    }

    public function updateHtmlAttributes(callable $callback): static
    {
        if (!isset($this->htmlAttributes)) {
            $this->htmlAttributes = new ComponentAttributeBag();
        }

        $this->htmlAttributes = $callback($this->htmlAttributes);

        return $this;
    }

    public function setHtmlAttribute(string $name, string $value): static
    {
        if (!isset($this->htmlAttributes)) {
            $this->htmlAttributes = new ComponentAttributeBag();
        }

        $this->htmlAttributes = $this->htmlAttributes->merge([$name => $value]);

        return $this;
    }

    public function setHtmlAttributes(ComponentAttributeBag $htmlAttributes): static
    {
        $this->htmlAttributes = $htmlAttributes;

        return $this;
    }

}
