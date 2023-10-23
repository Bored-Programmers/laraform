<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Traits;

trait THasConfirmOptions
{

    protected array $confirmOptions = [
        'component' => null,
        'onSuccess' => null,
        'onCancel' => null,
        'confirmHandler' => null,
        'messageOk' => '',
        'messageCancel' => '',
        'messageConfirm' => '',
        'data' => [],
    ];

    //////////////////////////////////////////////////////// Getters / Setters

    public function setConfirmComponent(?string $component): static
    {
        $this->confirmOptions['component'] = $component;

        return $this;
    }

    public function getConfirmComponent(): ?string
    {
        return $this->confirmOptions['component'];
    }

    public function setConfirmOnSuccess(?string $onSuccess): static
    {
        $this->confirmOptions['onSuccess'] = $onSuccess;

        return $this;
    }

    public function getConfirmOnSuccess(): ?string
    {
        return $this->confirmOptions['onSuccess'];
    }

    public function setConfirmOnCancel(?string $onCancel): static
    {
        $this->confirmOptions['onCancel'] = $onCancel;

        return $this;
    }

    public function getConfirmOnCancel(): ?string
    {
        return $this->confirmOptions['onCancel'];
    }

    public function setConfirmMessageOk(string $messageOk): static
    {
        $this->confirmOptions['messageOk'] = $messageOk;

        return $this;
    }

    public function getConfirmMessageOk(): string
    {
        return $this->confirmOptions['messageOk'];
    }

    public function setConfirmMessageCancel(string $messageCancel): static
    {
        $this->confirmOptions['messageCancel'] = $messageCancel;

        return $this;
    }

    public function getConfirmMessageCancel(): string
    {
        return $this->confirmOptions['messageCancel'];
    }

    public function setConfirmMessageConfirm(string $messageConfirm): static
    {
        $this->confirmOptions['messageConfirm'] = $messageConfirm;

        return $this;
    }

    public function getConfirmMessageConfirm(): string
    {
        return $this->confirmOptions['messageConfirm'];
    }

    public function setConfirmData(array $data): static
    {
        $this->confirmOptions['data'] = $data;

        return $this;
    }

    public function getConfirmData(): array
    {
        return $this->confirmOptions['data'];
    }

    public function getConfirmHandler(): ?string
    {
        return $this->confirmOptions['confirmHandler'];
    }

    public function setConfirmHandler(?string $confirmHandler): static
    {
        $this->confirmOptions['confirmHandler'] = $confirmHandler;

        return $this;
    }

}
