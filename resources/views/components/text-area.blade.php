@props(['disabled' => false])

<textarea rows="5" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control']) !!}>{{ $slot }}
</textarea>
