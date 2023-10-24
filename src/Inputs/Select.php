<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Inputs;

use BoredProgrammers\LaraForm\Traits\THasLabel;
use BoredProgrammers\LaraForm\Traits\THasTooltip;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class Select extends BaseField
{

    use THasLabel;
    use THasTooltip;

    protected array $options = [];

    protected bool $translateOptions = true;

    protected ?string $prompt = null;

    protected bool $isMultiOptions = false;

    public static function make(
        string $name,
        ?string $label = null,
        array|Collection $options = [],
        bool $withOptionValidation = true
    )
    {
        $input = new static();
        $input->setModel($name);
        $input->setLabel($label);
        $input->setOptions($options instanceof Collection ? $options->toArray() : $options);
        $input->setView('laraform::components.select');
        $input->setThemeType('select');

        if ($withOptionValidation) {
            $input->addRule(Rule::in(array_keys($input->getOptions())));
        }

        return $input;
    }

    //////////////////////////////////////////////////////// Getters / Setters

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function getTranslateOptions(): bool
    {
        return $this->translateOptions;
    }

    public function setTranslateOptions(bool $translateOptions): static
    {
        $this->translateOptions = $translateOptions;

        return $this;
    }

    public function getPrompt(): ?string
    {
        return $this->prompt;
    }

    public function setPrompt(?string $prompt): static
    {
        $this->prompt = $prompt;

        return $this;
    }

    public function getIsMultiOptions(): bool
    {
        return $this->isMultiOptions;
    }

    public function setIsMultiOptions(bool $isMultiOptions = true): static
    {
        $this->isMultiOptions = $isMultiOptions;

        return $this;
    }

}
