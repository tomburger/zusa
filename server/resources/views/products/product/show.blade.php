<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Product') }}: {{$product->name}} ({{$product->external_reference}})
        </h2>
    </x-slot>

    <div class="row">
        <div class="col">
            <nav class="nav justify-content-end">
                @if ($product->product_category_id)
                    <x-primary-link :href="route('products.show', ['type'=>'category','id'=>$product->product_category_id])"><i class="bi bi-arrow-left-square"></i> {{$product->parentCategory->name}}</x-primary-link>
                @else
                    <x-primary-link :href="route('products.index')"><i class="bi bi-arrow-left-square"></i> {{ __('Products') }}</x-primary-link>
                @endif
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
            <x-secondary-link :href="route('vendors.edit', ['vendor'=>$product->vendor->id])">{{$product->vendor->name}}</x-secondary-link>
            <x-secondary-link :href="route('dimensions.edit', ['dimension'=>$product->dimension->id])">{{$product->dimension->name}}</x-secondary-link>
        </div>
    </div>
</x-app-layout>