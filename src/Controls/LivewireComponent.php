<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Controls;

class LivewireComponent
{

    private string $name;

    private string $wireKey;

    private array $params = [];

    public static function make(string $wireKey, string $name, array $params = []): static
    {
        $component = new static();
        $component->setWireKey($wireKey);
        $component->setName($name);
        $component->setParams($params);

        return $component;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setParams(array $params): static
    {
        $this->params = $params;

        return $this;
    }

    public function getWireKey(): string
    {
        return $this->wireKey;
    }

    public function setWireKey(string $wireKey): static
    {
        $this->wireKey = $wireKey;

        return $this;
    }

}
