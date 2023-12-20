<select {{ $attributes->merge(['class' => 'form-control'])->filter(fn ($v, $k) => $k != 'model') }}>
    @foreach ($model->options as $key => $label)
        <option value="{{ $key }}" {{ $model->value == $key ? 'selected' : '' }}>{{ $label }}</option>
    @endforeach
</select>