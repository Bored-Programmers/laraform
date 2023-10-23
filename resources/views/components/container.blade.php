@php use BoredProgrammers\LaraForm\Controls\LivewireComponent;use BoredProgrammers\LaraForm\Inputs\BaseField; @endphp
<div
        @if($field->getVisibleIf())x-show="{!! Str::replace('%toggleState%', 'toggleState', $field->getVisibleIfFormatted()) !!}" @endif
        {{ $field->getHtmlAttributes() }}
>
    @if($title = $field->getTitle())
        <h4>@lang($title)</h4>
    @endif

    @foreach($field->getChildren() as $child)
        @continue(!$child)

        @if($child instanceof BaseField)
            @php($baseClass = $child->isRequired() ? $theme->inputGroups[$child->getThemeType()]['required'] : $theme->inputGroups[$child->getThemeType()]['notRequired'])
            <div
                    @if($child->getVisibleIf())x-show="{!! Str::replace('%toggleState%', 'toggleState', $child->getVisibleIfFormatted()) !!}" @endif
                    {{ $child->getWrapperHtmlAttributes()->merge(['class' => $baseClass]) }}
                    wire:key="{{ $child->getWireKey() ?: \Illuminate\Support\Str::slug($child->getModel()) }}"
            >
                @include($child->getView(), ['field' => $child])
            </div>
        @elseif($child instanceof LivewireComponent)
            <div>
                @livewire($child->getName(), ['myWireKey' => $child->getWireKey()] + $child->getParams(), key($child->getWireKey()))
            </div>
        @else
            @include($child->getView(), ['field' => $child])
        @endif
    @endforeach
</div>
