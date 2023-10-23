<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Inputs;

class PasswordInput extends TextInput
{

    public static function make(string $modelField, ?string $label = null)
    {
        $input = parent::make($modelField, $label);
        $input->setType('password');
        $input->setThemeType('text');

        return $input;
    }

}
