@php use Livewire\TemporaryUploadedFile; @endphp
@php
    $id = $field->getId() ?: $form->getFormName() . '-' . Str::camel(Str::replace('.', '-', $field->getModel()));
@endphp

@if($field->getShowLabel())
    @php
        $labelClass = $theme->labels[$field->getThemeType()]['label'];

        if ($errors->has($form->formatModelName($field))) {
            $labelClass .= ' ' . $theme->labelError;
        }
    @endphp

    <label
            for="{{ $id }}"
            {{ $field->getLabelHtmlAttributes()->merge(['class' => $labelClass]) }}
    >
        <span class="{{ $theme->labels[$field->getThemeType()]['span'] }}">@lang($field->getLabel())</span>

        @if($tooltip = $field->getTooltip())
            <span
                    class="{{ $field->getTooltipIcon() ? $theme->labelTooltipWithIcon : $theme->labelTooltip }}"
                    @if($field->getTooltipIcon())
                        {!! $theme->getTooltipIcon($field->getTooltipIcon()) !!}
                    @endif
                    {!! $theme->getTooltip($tooltip) !!}
                    title=""
                    tabindex="0"
            ></span>
        @endif
    </label>
@endif

@php
    $inputClass = $theme->inputs[$field->getThemeType()];

    if ($errors->has($form->formatModelName($field))) {
       $inputClass .= ' ' . $theme->inputError;
    }
@endphp

<input
        type="{{ $field->getType() }}"
        @if($form->getIsLivewire())
            wire:{{ $field->getWireType() }}{{ $field->getWireMode() ? '.' . $field->getWireMode() : '' }}="{{ $field->getModel() }}"
        @else
            name="{{ $field->getModel() }}"
        @endif
        id="{{ $id }}"
        data-input-name="{{ $field->getModel() }}"
        x-on:livewire-upload-start="uploadingState[$el.id] = true"
        x-on:livewire-upload-finish="uploadingState[$el.id] = false"
        x-on:livewire-upload-error="uploadingState[$el.id] = false"
        @if($field->getIsMultipleFiles())multiple @endif
        @if($field->getAllowedMimeTypes())accept="{{ implode(', ', $field->getAllowedMimeTypes()) }}" @endif
        {{ $field->getHtmlAttributes()->merge(['class' => $inputClass]) }}
>

@if ($field->getIsPreviewEnabled() && $image = data_get($this, $field->getModel()))
    @php($images = !is_array($image) ? [$image] : $image)

    <div @class($theme->imagePreviewWrapper)>
        <span>@lang('admin.preview')</span>

        <div @class($theme->previewImages)>
            @foreach($images as $img)
                @if($img instanceof TemporaryUploadedFile)
                    <div @class($theme->previewImage)>
                        <img src="{{ $img->temporaryUrl() }}">
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif

@error($form->formatModelName($field))
<span class="{{ $theme->inputErrorMessage }}">{{ $message }}</span>
{!! $theme->getInputError($message) !!}
@enderror
