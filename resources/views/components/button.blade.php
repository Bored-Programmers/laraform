<button
        @if($form->getIsLivewire())
            wire:{{ $field->getWireType() }}{{ $field->getWireMode() ? '.' . $field->getWireMode() : '' }}="{{ $field->getHandler() }}"
        @else
            name="{{ $field->getHandler() }}"
        type="submit"
        @endif
        data-button-name="{{ $field->getHandler() }}"
        x-bind:disabled="Object.values(uploadingState).filter(function(e){return e}).length > 0"
        {{ $field->getHtmlAttributes()->merge(['class' => $theme->button]) }}
>
    @lang($field->getTitle())
</button>
