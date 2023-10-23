@php use BoredProgrammers\LaraForm\Controls\LivewireComponent;use BoredProgrammers\LaraForm\Inputs\BaseField; @endphp
<div class="uk-width">
    <form @class($theme->form) x-data="{toggleState: {}, uploadingState: {}}">
        @foreach($fields as $field)
            @continue(!$field)

            @if($field instanceof BaseField)
                @php($baseClass = $field->isRequired() ? $theme->inputGroups[$field->getThemeType()]['required'] : $theme->inputGroups[$field->getThemeType()]['notRequired'])
                <div
                        @if($field->getVisibleIf())x-show="{!! Str::replace('%toggleState%', 'toggleState', $field->getVisibleIfFormatted()) !!}" @endif
                        wire:key="{{ $field->getWireKey() ?: \Illuminate\Support\Str::slug($field->getModel()) }}"
                        {{ $field->getWrapperHtmlAttributes()->merge(['class' => $baseClass]) }}
                >
                    @include($field->getView(), ['field' => $field])
                </div>
            @elseif($field instanceof LivewireComponent)
                <div>
                    @livewire($field->getName(), ['myWireKey' => $field->getWireKey()] + $field->getParams(), key($field->getWireKey()))
                </div>
            @else
                @include($field->getView(), ['field' => $field])
            @endif
        @endforeach

        @if($buttons)
            <div class="{{ $theme->buttonsWrapper }}">
                @foreach($buttons as $button)
                    @continue(!$button)

                    <div class="{{ $theme->buttonGroup }}">
                        @if(is_array($button))
                            <div class="{{ $theme->buttonsGroup }}">
                                @php($firstButton = array_shift($button))
                                @include($firstButton->getView(), ['field' => $firstButton])

                                @if($button)
                                    <div class="{{ $theme->buttonsDropdownWrapper }}">
                                        <button
                                                wire:ignore
                                                type="button"
                                                class="{{ $theme->button }}"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                                x-bind:disabled="Object.values(uploadingState).filter(function(e){return e}).length > 0"
                                        >
                                            {!! $theme->getIcon('chevron-down') !!}
                                        </button>
                                        <div
                                                wire:ignore.self
                                                class="{{ $theme->buttonsDropdown }}"
                                                {!! $theme->getButtonsDropdown() !!}
                                        >
                                            <ul class="{{ $theme->buttonsList }} ">
                                                @foreach($button as $buttonInGroup)
                                                    <li class="{{ $theme->buttonsListItem }}">
                                                        @include($buttonInGroup->getView(), ['field' => $buttonInGroup])
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            @include($button->getView(), ['field' => $button])
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </form>
</div>
