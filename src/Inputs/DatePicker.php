<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Inputs;

use BoredProgrammers\LaraForm\Traits\THasLabel;
use BoredProgrammers\LaraForm\Traits\THasTooltip;

class DatePicker extends BaseField
{

    use THasLabel;
    use THasTooltip;

    public static function make(string $modelField, ?string $label = null)
    {
        $input = new static();
        $input->setModel($modelField);
        $input->setLabel($label);
        $input->setThemeType('text');
        $input->setHtmlAttribute('class', 'datepicker');
        $input->setView('laraform::components.date-picker');

        return $input;
    }

}
