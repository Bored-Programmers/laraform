<a
        @if($url = $field->getUrl())href="{{ $url }}" @endif
        {{ $field->getHtmlAttributes() }}
>
    @lang($field->getTitle())
</a>
