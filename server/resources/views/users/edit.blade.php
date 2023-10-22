<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Edit User') }}: {{$user->name}}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('users.update', ['user'=>$user->id]) }}">
        @csrf
        @method('PUT')
        
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name" value="{{$user->name}}"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Profile')" />
            <x-dropdown-input id="profile" name="profile" :model="$user->profile" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            <x-secondary-link href="{{ route('users.index') }}">{{ __('Cancel') }}</x-secondary-link>
        </div>
    </form>
</x-app-layout>