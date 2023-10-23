<?php declare(strict_types=1);

namespace BoredProgrammers\LaraForm;

use Illuminate\Support\ServiceProvider;

class LaraFormProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laraform');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'laraform');
    }

}
