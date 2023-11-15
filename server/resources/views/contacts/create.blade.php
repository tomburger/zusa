<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Create New Contact') }}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('vendors.contacts.store', ['vendor'=>$entry->vendor_id]) }}">
        @csrf
        
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="phone" required autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" required autofocus autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
        <div>
            <x-input-label for="notes" :value="__('Notes')" />
            <x-text-area id="notes" name="notes" autofocus autocomplete="notes" />
            <x-input-error class="mt-2" :messages="$errors->get('notes')" />
        </div>
        <div>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            <x-secondary-link href="{{ route('vendors.show', ['vendor'=>$entry->vendor_id]) }}">{{ __('Cancel') }}</x-secondary-link>
        </div>
    </form>
</x-app-layout>