<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Inputs;

use BoredProgrammers\LaraForm\Traits\THasLabel;
use BoredProgrammers\LaraForm\Traits\THasTooltip;

class Checkbox extends BaseField
{

    use THasLabel;
    use THasTooltip;

    public static function make(string $modelField, ?string $label = null): static
    {
        $input = new static();
        $input->setModel($modelField);
        $input->setLabel($label);
        $input->setThemeType('checkbox');
        $input->setWireMode('defer');
        $input->setView('laraform::components.checkbox');

        return $input;
    }

}
