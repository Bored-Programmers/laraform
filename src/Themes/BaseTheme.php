<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Themes;

abstract class LaraFormTheme
{

    public string $form = '';

    public string $labelTooltip = '';

    public string $labelTooltipWithIcon = '';

    public string $labelError = '';

    public string $button = '';

    public string $buttonGroup = '';

    public string $buttonsGroup = '';

    public string $buttonsDropdown = '';

    public string $buttonsDropdownWrapper = '';

    public string $buttonsList = '';

    public string $buttonsListItem = '';

    public string $buttonsWrapper = '';

    public string $inputError = '';

    public string $inputErrorMessage = '';

    public string $imagePreviewWrapper = '';

    public string $previewImages = '';

    public string $previewImage = '';

    public array $inputs = [
        'text' => '',
        'textarea' => '',
        'select' => '',
        'checkbox' => '',
        'file' => '',
    ];

    public array $labels = [
        'text' => [
            'label' => '',
            'span' => '',
        ],
        'textarea' => [
            'label' => '',
            'span' => '',
        ],
        'select' => [
            'label' => '',
            'span' => '',
        ],
        'checkbox' => [
            'label' => '',
            'span' => '',
        ],
        'file' => [
            'label' => '',
            'span' => '',
        ],
    ];

    public array $inputGroups = [
        'text' => [
            'notRequired' => '',
            'required' => '',
        ],
        'textarea' => [
            'notRequired' => '',
            'required' => '',
        ],
        'select' => [
            'notRequired' => '',
            'required' => '',
        ],
        'checkbox' => [
            'notRequired' => '',
            'required' => '',
        ],
        'file' => [
            'notRequired' => '',
            'required' => '',
        ],
    ];

    public function getIcon(?string $iconName): string
    {
        return '';
    }

    public function getTooltipIcon(?string $iconName): string
    {
        return '';
    }

    public function getTooltip(?string $tooltip): string
    {
        return '';
    }

    public function getButtonsDropdown(): string
    {
        return '';
    }

    public function getInputError(?string $message): string
    {
        return '';
    }

}
