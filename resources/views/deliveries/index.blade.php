<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Deliveries') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col">
            @if (session('success'))
                <x-alert-success>{{ session('success') }}</x-alert-success>
            @endif
            @if (session('error'))
                <x-alert-danger>{{ session('error') }}</x-alert-danger>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            @can('delivery.write')
            <form method="post" action="{{ route('deliveries.create') }}">
                @csrf
                <div>
                    <x-dropdown-input id="vendor" name="vendor" :model="$model->vendors()" />
                </div>
                <div>
                    <x-dropdown-input id="warehouse" name="warehouse" :model="$model->warehouses()" />
                </div>
                <div>
                    <x-primary-button>{{ __('Create Delivery') }}</x-primary-link>
                </div>
            </form>
            @endcan
        </div>
        <div class="col-md-8">
            @can('delivery.read')
            @if ($model->deliveries()->count() > 0)
                @foreach ($model->deliveries() as $delivery)
                    <div class="row mt-2">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <x-secondary-link :href="route('vendors.show', ['vendor'=> $delivery->vendor->id])">
                                        {{ $delivery->vendor->name }}
                                    </x-secondary-link>
                                    <x-secondary-link :href="route('warehouses.edit', ['warehouse'=> $delivery->warehouse->id])">
                                        {{ $delivery->warehouse->name }}
                                    </x-secondary-link>
                                    <span class="float-end">
                                        {{ $delivery->created_at->format('Y-m-d H:i') }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    {{__('Created by')}}: {{ $delivery->createdBy->name }}
                                    @if ($delivery->external_reference)
                                        <br>{{__('External Reference')}}: {{ $delivery->external_reference }}
                                    @endif
                                    @if ($delivery->invoice_number)
                                        <br>{{__('Invoice Number')}}: {{ $delivery->invoice_number }}
                                    @endif
                                </div>
                                <div class="card-footer text-end">
                                    <x-secondary-link :href="route('deliveries.show', ['id'=> $delivery->id])"><i class="bi bi-eye-fill"></i></x-secondary-link>
                                    @can('delivery.write')
                                        <x-secondary-link :href="route('deliveries.edit', ['id'=> $delivery->id])"><i class="bi bi-pencil-fill"></i></x-secondary-link>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Here comes a list of the latest deliveries...</p>
            @endif
            @endcan
        </div>
    </div>
</x-app-layout>