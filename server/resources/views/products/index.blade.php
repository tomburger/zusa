<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col">
            <nav class="nav justify-content-end">
                <x-primary-link class="me-2" :href="route('products.create', ['type'=>'category'])">{{ __('New Category') }}</x-primary-link>
                <x-primary-link :href="route('products.create', ['type'=>'product'])">{{ __('New Product') }}</x-primary-link>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if (session('success'))
                <x-alert-success>{{ session('success') }}</x-alert-success>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($prodcats->isEmpty() && $products->isEmpty())
                <x-alert-info>{{ __('No products found.') }}</x-alert-info>
            @else
                @include('products.table')
            @endif
        </div>
    </div>

</x-app-layout>