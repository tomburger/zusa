<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Edit Warehouse') }}: {{$entry->name}}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('warehouses.update', ['warehouse'=>$entry->id]) }}">
        @csrf
        @method('PUT')
        
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name" value="{{$entry->name}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="notes" :value="__('Notes')" />
            <x-text-area id="notes" name="notes" required autofocus autocomplete="notes">{{$entry->notes}}</x-text-area>
            <x-input-error class="mt-2" :messages="$errors->get('notes')" />
        </div>
        <div>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            <x-secondary-link href="{{ route('warehouses.index') }}">{{ __('Cancel') }}</x-secondary-link>
        </div>
    </form>
</x-app-layout>