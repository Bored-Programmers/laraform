@php
    /**
    * @var \BoredProgrammers\LaraForm\Inputs\VirtualSelect $field
    */

    use Illuminate\Support\Str;
@endphp

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
                tabindex="0"
            >
        @endif
    </label>
@endif

@php
    $inputClass = $theme->inputs[$field->getThemeType()];

    if ($errors->has($form->formatModelName($field))) {
       $inputClass .= ' ' . $theme->inputError;
    }

    $options = [];

    foreach ($field->getOptions() as $optionValue => $title) {
        $options[] = [
            'value' => $optionValue,
            'label' => $field->getTranslateOptions() ? __($title) : $title,
        ];
    }

    $selectedValue = data_get($this, $field->getModel());
    $selectedValue = json_encode($selectedValue);
@endphp

<div wire:ignore>
    <div
        id="{{ $id }}"
        @change="toggleState[$el.id] = $el.value || null; $wire.set('{{ $field->getModel() }}', $el.value || null, {{ $field->getWireMode() === 'live' ? "true" : "false" }});"
        x-init="toggleState[$el.id] = $el.value || null; $wire.set('{{ $field->getModel() }}', $el.value || null, {{ $field->getWireMode() === 'live' ? "true" : "false" }})"
        data-input-name="{{ $field->getModel() }}"
    >
    </div>

    <script>
      {
        const initVirtualSelect = function () {
          let options = {
            ele: '#{!! $id !!}',
            placeholder: {!! $field->getPrompt() ? "'" . $field->getPrompt() . "'" : "''" !!},
            options: {!! json_encode($options) !!},
            multiple: {!! $field->getIsMultiOptions() ? 'true' : 'false' !!},
            search: true,
            searchNormalize: true,
            selectedValue: {!! $selectedValue ?: 'null' !!},
            noOptionsText: '{{ __('laraform::forms.virtualSelect.noOptionsText') }}',
            noSearchResultsText: '{{ __('laraform::forms.virtualSelect.noSearchResultsText') }}',
            selectAllText: '{{ __('laraform::forms.virtualSelect.selectAllText') }}',
            searchPlaceholderText: '{{ __('laraform::forms.virtualSelect.searchPlaceholderText') }}',
            optionsSelectedText: '{{ __('laraform::forms.virtualSelect.optionsSelectedText') }}',
            optionSelectedText: '{{ __('laraform::forms.virtualSelect.optionSelectedText') }}',
            allOptionsSelectedText: '{{ __('laraform::forms.virtualSelect.allOptionsSelectedText') }}',
            clearButtonText: '{{ __('laraform::forms.virtualSelect.clearButtonText') }}',
            moreText: '{{ __('laraform::forms.virtualSelect.moreText') }}',
            enableSecureText: true,
          };

          @if($onServerSearch = $field->getOnServerSearch())
          options['searchPlaceholderText'] = '{{ trans_choice('laraform::forms.virtualSelect.serverSearchPlaceholderText', $field->getMinSearchTermLength()) }}';

          options['onServerSearch'] = function (searchValue, virtualSelect) {
            if (searchValue && searchValue.length >= {{ $field->getMinSearchTermLength() }}) {
              const eventArguments = Object.values({!! json_encode($field->getOnServerSearchArguments()) !!});

              Livewire.emitTo(
                '{{ $this->getComponentName() }}',
                '{{ $onServerSearch }}',
                searchValue,
                ...eventArguments
              )
            } else {
              virtualSelect.setServerOptions(options.options);
            }
          };
          @endif

          VirtualSelect.init(options)

          document.getElementById('{!! $id !!}')
            .addEventListener('change', function () {
              const searchInput = this.querySelector('input[type=text].vscomp-search-input');

              if (searchInput) {
                searchInput.value = '';
              }
            })
        };

        if (typeof VirtualSelect !== 'undefined') {
          initVirtualSelect()
        } else {
          document.addEventListener('DOMContentLoaded', initVirtualSelect)
        }
      }
    </script>
</div>

<div wire:key="{{ rand() }}">
    <script>
      {
        const newOptions = {!! json_encode($options) !!};
        const select = document.getElementById('{!! $id !!}');

        if (select && select.virtualSelect) {
          select.virtualSelect.setServerOptions(newOptions)
        }
      }
    </script>
</div>

@error($form->formatModelName($field))
<span class="{{ $theme->inputErrorMessage }}">{{ $message }}</span>
{!! $theme->getInputError($message) !!}
@enderror
