<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Inputs;

use Illuminate\Support\Collection;

class VirtualSelect extends Select
{

    protected ?string $onServerSearch = null;

    protected array $onServerSearchArguments = [];

    protected int $minSearchTermLength = 2;

    public static function make(
        string $name,
        ?string $label = null,
        array|Collection $options = [],
        bool $withOptionValidation = true
    )
    {
        $input = parent::make($name, $label, $options, $withOptionValidation);
        $input->setView('laraform::components.virtual-select');

        return $input;
    }

    public function getOnServerSearch(): ?string
    {
        return $this->onServerSearch;
    }

    public function setOnServerSearch(?string $onServerSearch, array $arguments = []): static
    {
        $this->onServerSearch = $onServerSearch;
        $this->onServerSearchArguments = $arguments;

        return $this;
    }

    public function getOnServerSearchArguments(): array
    {
        return $this->onServerSearchArguments;
    }

    public function setOnServerSearchArguments(array $onServerSearchArguments): void
    {
        $this->onServerSearchArguments = $onServerSearchArguments;
    }

    public function getMinSearchTermLength(): int
    {
        return $this->minSearchTermLength;
    }

    public function setMinSearchTermLength(int $minSearchTermLength): static
    {
        $this->minSearchTermLength = $minSearchTermLength;

        return $this;
    }

}
