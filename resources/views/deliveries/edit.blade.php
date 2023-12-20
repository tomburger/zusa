<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Create New Delivery') }}
        </h2>
    </x-slot>

    <div class="row">
        <dlv class="col">
            {{__('Vendor')}}: {{$model->vendor->name}}
        </dlv>
    </div>
    <div class="row mb-4">
        <dlv class="col">
            {{__('Warehouse')}}: {{$model->warehouse->name}}
        </dlv>
    </div>

    <form method="post" action="{{ route('deliveries.update', ['id'=> $model->id]) }}">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col">
                <x-input-label for="external_reference" :value="__('External Reference')" />
                <x-text-input id="external_reference" name="external_reference" type="text" required autofocus autocomplete="external_reference" value="{{$model->external_reference}}"/>
                <x-input-error class="mt-2" :messages="$errors->get('external_reference')" />
            </div>
            <div class="col">
                <x-input-label for="invoice_number" :value="__('Invoice Number')" />
                <x-text-input id="invoice_number" name="invoice_number" type="text" required autofocus autocomplete="invoice_number" value="{{$model->invoice_number}}" />
                <x-input-error class="mt-2" :messages="$errors->get('invoice_number')" />
            </div>
        </div>
        <div id="delivery-items-editor"></div>
        <div>
            <x-input-label for="notes" :value="__('Notes')" />
            <x-text-area id="notes" name="notes" autofocus autocomplete="notes">{{$model->notes}}</x-text-area>
            <x-input-error class="mt-2" :messages="$errors->get('notes')" />
        </div>
        <div>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</x-app-layout>