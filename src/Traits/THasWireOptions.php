<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Traits;

trait THasWireOptions
{

    protected array $wireOptions = [
        'key' => null,
        'type' => 'model',
        'mode' => null, // 'debounce.300ms', ...
    ];

    //////////////////////////////////////////////////////// Getters / Setters

    public function setWireType(string $type): static
    {
        $this->wireOptions['type'] = $type;

        return $this;
    }

    public function getWireType(): string
    {
        return $this->wireOptions['type'];
    }

    public function setWireMode(?string $mode): static
    {
        $this->wireOptions['mode'] = $mode;

        return $this;
    }

    public function getWireMode(): ?string
    {
        return $this->wireOptions['mode'];
    }

    public function setWireKey(?string $key): static
    {
        $this->wireOptions['key'] = $key;

        return $this;
    }

    public function getWireKey(): ?string
    {
        return $this->wireOptions['key'];
    }

}
