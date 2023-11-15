<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Name') }}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prodcats as $prodcat)
                <tr>
                    <td><i class="bi bi-collection"></i> {{ $prodcat->id }}</td>
                    <td colspan="4">{{ $prodcat->name }}</td>
                    <td class="text-end">
                        <x-secondary-link :href="route('products.show', ['type'=>'category', 'id'=> $prodcat->id])"><i class="bi bi-arrow-right-square"></i></x-secondary-link>
                        <x-secondary-link :href="route('products.edit', ['type'=>'category', 'id'=> $prodcat->id])"><i class="bi bi-pencil-fill"></i></x-secondary-link>
                    </td>
                </tr>
            @endforeach
            @foreach ($products as $product)
                <tr>
                    <td><i class="bi bi-box"></i> {{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->external_reference }}</td>
                    <td>{{ $product->vendor?->name }}</td>
                    <td>{{ $product->dimension?->name }}</td>
                    <td class="text-end">
                        <x-secondary-link :href="route('products.show', ['type'=>'product', 'id'=> $product->id])"><i class="bi bi-eye-fill"></i></x-secondary-link>
                        <x-secondary-link :href="route('products.edit', ['type'=>'product', 'id'=> $product->id])"><i class="bi bi-pencil-fill"></i></x-secondary-link>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
