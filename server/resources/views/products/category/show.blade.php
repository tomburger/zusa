<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Product Category') }}: {{$prodcat->name}}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col">
            <nav class="nav justify-content-end">
                @if ($prodcat->parent)
                    <x-primary-link class="me-2" :href="route('products.show', ['type'=>'category','id'=>$prodcat->parent])"><i class="bi bi-arrow-left-square"></i> {{$prodcat->parentCategory->name}}</x-primary-link>
                @else
                    <x-primary-link class="me-2" :href="route('products.index')"><i class="bi bi-arrow-left-square"></i> {{ __('Products') }}</x-primary-link>
                @endif
                @can('product.write')
                    <x-primary-link class="me-2" :href="route('products.create', ['type'=>'category','parent'=>$prodcat->id])">{{ __('New Category') }}</x-primary-link>
                    <x-primary-link :href="route('products.create', ['type'=>'product','parent'=>$prodcat->id])">{{ __('New Product') }}</x-primary-link>
                @endcan
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
    @if (!$prodcat->categories->isEmpty() || !$prodcat->products->isEmpty())
        @include('products.table', ['prodcats'=>$prodcat->categories, 'products'=>$prodcat->products])
    @endif
</x-app-layout>