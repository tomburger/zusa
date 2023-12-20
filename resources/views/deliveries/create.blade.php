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

    <form method="post" action="{{ route('deliveries.store') }}">
        @csrf
        <input type="hidden" name="vendor" value="{{$model->vendor_id}}">
        <input type="hidden" name="warehouse" value="{{$model->warehouse_id}}">
        @include('deliveries.form')
    </form>
</x-app-layout>