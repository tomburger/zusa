<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Create New Delivery') }}
        </h2>
    </x-slot>

    <div class="row mb-4">
        <div class="col">
            {{__('Vendor')}}<br/>
            <b>{{$model->vendorName()}}</b>
        </div>
        <div class="col">
            {{__('Warehouse')}}<br/>
            <b>{{$model->warehouseName()}}</b>
        </div>
    </div>

    <form method="post" action="{{ route('deliveries.store') }}">
        @csrf
        <input type="hidden" name="vendor" value="{{$model->vendor_id}}">
        <input type="hidden" name="warehouse" value="{{$model->warehouse_id}}">
        @include('deliveries.form')
    </form>
</x-app-layout>