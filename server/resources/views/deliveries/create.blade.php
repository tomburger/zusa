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
    <div class="row">
        <dlv class="col">
            {{__('Warehouse')}}: {{$model->warehouse->name}}
        </dlv>
    </div>

    <form method="post" action="{{ route('deliveries.store') }}">
        @csrf
        <input type="hidden" name="vendor" value="{{$model->vendor_id}}">
        <input type="hidden" name="warehouse" value="{{$model->warehouse_id}}">
        <div>
            <x-input-label for="notes" :value="__('Notes')" />
            <x-text-area id="notes" name="notes" autofocus autocomplete="notes" />
            <x-input-error class="mt-2" :messages="$errors->get('notes')" />
        </div>
        <div>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</x-app-layout>