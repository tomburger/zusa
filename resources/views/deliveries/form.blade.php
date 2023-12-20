<input type="hidden" name="vendor" value="{{$model->vendor_id}}">
<input type="hidden" name="warehouse" value="{{$model->warehouse_id}}">
<div class="row">
    <div class="col">
        <x-input-label for="external_reference" :value="__('External Reference')" />
        <x-text-input id="external_reference" name="external_reference" type="text" required autofocus autocomplete="external_reference" />
        <x-input-error class="mt-2" :messages="$errors->get('external_reference')" />
    </div>
    <div class="col">
        <x-input-label for="invoice_number" :value="__('Invoice Number')" />
        <x-text-input id="invoice_number" name="invoice_number" type="text" required autofocus autocomplete="invoice_number" />
        <x-input-error class="mt-2" :messages="$errors->get('invoice_number')" />
    </div>
</div>
<div id="delivery-items-editor"></div>
<script type="text/json" id="product-list">
    [
        @foreach($model->products() as $key => $label)
            {"value":"{{$key}}", "label":"{{$label}}"}
            @if ($loop->last)
            @else
            ,
            @endif
        @endforeach
    ]
</script>
<div>
    <x-input-label for="notes" :value="__('Notes')" />
    <x-text-area id="notes" name="notes" autofocus autocomplete="notes" />
    <x-input-error class="mt-2" :messages="$errors->get('notes')" />
</div>
<div>
    <x-primary-button>{{ __('Save') }}</x-primary-button>
</div>
