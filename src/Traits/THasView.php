<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Traits;

use Exception;

trait THasView
{

    protected string $view;

    //////////////////////////////////////////////////////// Getters / Setters

    public function getView(): string
    {
        if (empty($this->view)) {
            throw new Exception(static::class . '::$view cannot be empty');
        }

        return $this->view;
    }

    public function setView(string $view): static
    {
        $this->view = $view;

        return $this;
    }

}
