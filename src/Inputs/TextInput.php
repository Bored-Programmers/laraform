<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Inputs;

use BoredProgrammers\LaraForm\Traits\THasLabel;
use BoredProgrammers\LaraForm\Traits\THasTooltip;
use BoredProgrammers\LaraForm\Traits\THasType;

class TextInput extends BaseField
{

    use THasLabel;
    use THasTooltip;
    use THasType;

    public static function make(string $modelField, ?string $label = null)
    {
        $input = new static();
        $input->setModel($modelField);
        $input->setLabel($label);
        $input->setType('text');
        $input->setThemeType('text');
        $input->setWireMode('defer');
        $input->setView('laraform::components.text-input');

        return $input;
    }

}
