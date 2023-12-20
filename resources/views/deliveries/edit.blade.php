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
        @include('deliveries.form')
    </form>
</x-app-layout>