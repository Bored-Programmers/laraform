<?php

declare(strict_types=1);

namespace BoredProgrammers\LaraForm\Controls;

use BoredProgrammers\LaraForm\Traits\THasConfirmOptions;

class ConfirmButton extends Button
{

    use THasConfirmOptions;

    public static function make(
        string $title,
        ?string $handler = 'onSubmit', /** onSuccessHandler */
        ?string $onCancelHandler = null,
        string $confirmHandler = 'openConfirmModal',
    ) {
        $button = parent::make($title, null);
        $button->setConfirmMessageOk(__('laraform::forms.messageOk'));
        $button->setConfirmMessageCancel(__('laraform::forms.messageCancel'));
        $button->setConfirmMessageConfirm(__('laraform::forms.messageConfirm'));
        $button->setConfirmOnSuccess($handler);
        $button->setConfirmOnCancel($onCancelHandler);
        $button->setConfirmHandler($confirmHandler);

        return $button;
    }

    public function getHandler(): string
    {
        return $this->getConfirmHandler() . '('
            . '"' . $this->getConfirmOnSuccess() . '",'
            . '"' . $this->getConfirmOnCancel() . '",'
            . '' . json_encode($this->getConfirmData()) . ','
            . '"' . $this->getConfirmComponent() . '",'
            . '"' . $this->getConfirmMessageOk() . '",'
            . '"' . $this->getConfirmMessageCancel() . '",'
            . '"' . $this->getConfirmMessageConfirm() . '"'
            . ')';
    }

}
