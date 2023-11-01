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
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prodcats as $prodcat)
                                <tr>
                                    <td><i class="bi bi-collection"></i> {{ $prodcat->id }}</td>
                                    <td>{{ $prodcat->name }}</td>
                                    <td class="text-end">
                                        <x-secondary-link :href="route('products.show', ['type'=>'category', 'id'=> $prodcat->id])"><i class="bi bi-eye-fill"></i></x-secondary-link>
                                        <x-secondary-link :href="route('products.edit', ['type'=>'category', 'id'=> $prodcat->id])"><i class="bi bi-pencil-fill"></i></x-secondary-link>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($products as $product)
                                <tr>
                                    <td><i class="bi bi-box"></i> {{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td class="text-end">
                                        <x-secondary-link :href="route('products.show', ['type'=>'product', 'id'=> $product->id])"><i class="bi bi-eye-fill"></i></x-secondary-link>
                                        <x-secondary-link :href="route('products.edit', ['type'=>'product', 'id'=> $product->id])"><i class="bi bi-pencil-fill"></i></x-secondary-link>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>