<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Edit Product Category') }}: {{$prodcat->name}}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('products.update', ['type'=>'category','id'=>$prodcat->id]) }}">
        @csrf
        @method('PATCH')
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name" value="{{$prodcat->name}}" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Parent')" />
            <x-dropdown-input id="parent" name="parent" :model="$prodcat->parentDropdown()" />
            <x-input-error class="mt-2" :messages="$errors->get('parent')" />
        </div>
        <div>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if ($prodcat->parent)
                <x-secondary-link href="{{ route('products.show', ['type'=>'category','id'=>$prodcat->parent]) }}">{{ __('Cancel') }}</x-secondary-link>
            @else
                <x-secondary-link href="{{ route('products.index') }}">{{ __('Cancel') }}</x-secondary-link>
            @endif
        </div>
    </form>
</x-app-layout>