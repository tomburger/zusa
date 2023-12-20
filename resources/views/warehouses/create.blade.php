<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Create New Warehouse') }}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('warehouses.store') }}">
        @csrf
        
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="notes" :value="__('Notes')" />
            <x-text-area id="notes" name="notes" autofocus autocomplete="notes" />
            <x-input-error class="mt-2" :messages="$errors->get('notes')" />
        </div>
        <div>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            <x-secondary-link href="{{ route('warehouses.index') }}">{{ __('Cancel') }}</x-secondary-link>
        </div>
    </form>
</x-app-layout>