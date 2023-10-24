<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm;

use BoredProgrammers\LaraForm\Controls\Button;
use BoredProgrammers\LaraForm\Controls\IHasChildren;
use BoredProgrammers\LaraForm\Inputs\BaseField;
use BoredProgrammers\LaraForm\Inputs\FileInput;
use BoredProgrammers\LaraForm\Themes\LaraFormTheme;
use Illuminate\Support\Str;
use Livewire\Component;

abstract class LaraForm extends Component
{

    /** @return BaseField[] */
    abstract protected function getFields(): array;

    public function render()
    {
        $params = [
            'form' => $this,
            'theme' => $this->getTheme(),
            'fields' => $this->getFields(),
            'buttons' => $this->getButtons(),
        ];

        return view('laraform::index', $params);
    }

    public function getFormName(): string
    {
        $namespaceParts = explode('\\', static::class);

        return 'form-' . Str::camel(end($namespaceParts));
    }

    public function getField(string $model)
    {
        static $fields = [];

        if (!$fields) {
            $fields = $this->getFields();
        }

        foreach ($fields as $field) {
            if ($field->getModel() === $model) {
                return $field;
            }
        }

        return null;
    }

    public function formatModelName(BaseField $field): string
    {
        $name = $field->getModel();

        if ($field instanceof FileInput && $field->getIsMultipleFiles()) {
            $name .= '.*';
        }

        return $name;
    }

    public function rules(?IHasChildren $container = null)
    {
        $rules = [];

        $fields = $container ? $container->getChildren() : $this->getFields();

        foreach ($fields as $field) {
            if ($field instanceof BaseField) {
                $model = $this->formatModelName($field);

                $rules[$model] = $field->getRules();
            } elseif ($field instanceof IHasChildren) {
                $rules = array_merge($rules, $this->rules($field));
            }
        }

        return $rules;
    }

    //////////////////////////////////////////////////////// Protected

    protected function getButtons(): array
    {
        return [
            [
                Button::make('admin.save'),
                Button::make('admin.saveAndGoBack', "onSubmit('saveAndGoBack')"),
            ],
        ];
    }

    protected function getTheme(): LaraFormTheme
    {
        return new class extends LaraFormTheme {

        };
    }

    protected function getMessages(?IHasChildren $container = null)
    {
        $messages = [];

        $fields = $container ? $container->getChildren() : $this->getFields();

        foreach ($fields as $field) {
            if ($field instanceof BaseField) {
                $model = $this->formatModelName($field);

                foreach ($field->getCustomValidationMessages() as $key => $message) {
                    $messages[$model . '.' . $key] = $message;
                }
            } elseif ($field instanceof IHasChildren) {
                $messages = array_merge($messages, $this->getMessages($field));
            }
        }

        return $messages;
    }

    protected function getValidationAttributes(?IHasChildren $container = null)
    {
        $attributes = [];

        $fields = $container ? $container->getChildren() : $this->getFields();

        foreach ($fields as $field) {
            if ($field instanceof BaseField) {
                $originalModel = $this->formatModelName($field);

                if ($customAttribute = $field->getCustomValidationAttribute()) {
                    $attributes[$originalModel] = $customAttribute;

                    continue;
                }

                if (method_exists($field, 'getLabel') && $label = $field->getLabel()) {
                    $attributes[$originalModel] = __($label);

                    continue;
                }

                /*
                 * "values.tags.159" -> "tags"
                 * "values.videos.new-video-test" -> "videos"
                 */
                $parts = str($field->getModel())
                    ->explode('.')
                    ->take(-2)
                    ->values();

                $firstPart = $parts[0] ?? null;
                $secondPart = $parts[1] ?? null;

                if (null === $firstPart && null === $secondPart) {
                    $model = $field->getModel();
                } elseif (is_numeric($secondPart) || str_starts_with($secondPart, 'new-')) {
                    $model = Str::singular($firstPart);
                } else {
                    $model = $secondPart;
                }

                if (is_numeric($model) && !str_starts_with($model, 'new-')) {
                    $attributes[$originalModel] = __('validation.attributes.' . $model);
                }
            } elseif ($field instanceof IHasChildren) {
                $attributes = array_merge($attributes, $this->getValidationAttributes($field));
            }
        }

        return $attributes;
    }

}
