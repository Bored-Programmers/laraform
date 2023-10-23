<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Inputs;

use BoredProgrammers\LaraForm\Traits\THasLabel;
use BoredProgrammers\LaraForm\Traits\THasTooltip;
use BoredProgrammers\LaraForm\Traits\THasType;

class FileInput extends BaseField
{

    use THasLabel;
    use THasTooltip;
    use THasType;

    protected bool $multipleFiles = false;

    protected bool $isPreviewEnabled = false;

    protected array $allowedMimeTypes = [];

    public static function make(string $modelField, ?string $label = null)
    {
        $input = new static();
        $input->setModel($modelField);
        $input->setLabel($label);
        $input->setType('file');
        $input->setThemeType('file');
        $input->setWireMode('defer');
        $input->setView('laraform::components.file-input');

        return $input;
    }

    public function getIsMultipleFiles(): bool
    {
        return $this->multipleFiles;
    }

    public function setMultipleFiles(bool $multipleFiles = true): static
    {
        $this->multipleFiles = $multipleFiles;

        return $this;
    }

    public function getAllowedMimeTypes(): array
    {
        return $this->allowedMimeTypes;
    }

    public function setAllowedMimeTypes(array $allowedMimeTypes, ?string $customValidationMessage = null): static
    {
        $this->allowedMimeTypes = $allowedMimeTypes;
        $this->addRule('mimetypes:' . implode(',', $allowedMimeTypes), $customValidationMessage);

        return $this;
    }

    public function getIsPreviewEnabled(): bool
    {
        return $this->isPreviewEnabled;
    }

    public function setIsPreviewEnabled(bool $isPreviewEnabled): static
    {
        $this->isPreviewEnabled = $isPreviewEnabled;

        return $this;
    }

    public function setMaxFileSize(int $maxFileSize = 32 * 1024, string $customValidationMessage = null): static
    {
        if ($maxFileSize) {
            $this->addRule('max:' . $maxFileSize, $customValidationMessage);
        } else {
            $this->removeRule('max:' . $maxFileSize);
        }

        return $this;
    }

}
