@props(['disabled' => false])

<textarea rows="10" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control']) !!}>{{ $slot }}
</textarea>
