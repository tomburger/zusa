<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Create New Product') }}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('products.store') }}">
        @csrf
        <input type="hidden" name="type" value="product">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="external_reference" :value="__('External Reference')" />
            <x-text-input id="external_reference" name="external_reference" type="text" required autofocus autocomplete="external_reference" />
            <x-input-error class="mt-2" :messages="$errors->get('external_reference')" />
        </div>
        <div>
            <x-input-label for="parent" :value="__('Parent')" />
            <x-dropdown-input id="parent" name="parent" :model="$product->categoryDropdown()" />
            <x-input-error class="mt-2" :messages="$errors->get('parent')" />
        </div>
        <div>
            <x-input-label for="vendor" :value="__('Vendor')" />
            <x-dropdown-input id="vendor" name="vendor" :model="$product->vendorDropdown()" />
            <x-input-error class="mt-2" :messages="$errors->get('vendor')" />
        </div>
        <div>
            <x-input-label for="dimension" :value="__('Dimension')" />
            <x-dropdown-input id="dimension" name="dimension" :model="$product->dimensionDropdown()" />
            <x-input-error class="mt-2" :messages="$errors->get('dimension')" />
        </div>
        <div>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if ($product->product_category_id)
                <x-secondary-link href="{{ route('products.show', ['type'=>'category','id'=>$product->product_category_id]) }}">{{ __('Cancel') }}</x-secondary-link>
            @else
                <x-secondary-link href="{{ route('products.index') }}">{{ __('Cancel') }}</x-secondary-link>
            @endif
        </div>
    </form>
</x-app-layout>