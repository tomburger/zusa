<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Update Delivery') }}
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

    <form method="post" action="{{ route('deliveries.update', ['id'=> $model->id]) }}">
        @csrf
        @method('PATCH')
        @include('deliveries.form')
    </form>
</x-app-layout>