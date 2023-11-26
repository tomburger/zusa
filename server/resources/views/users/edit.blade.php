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
            <x-input-label :value="__('Roles')" />
            <div class="form-control">
                @foreach($user->allRoles() as $role)
                    <input type="checkbox" class="btn-check" 
                                id="{{$role->name}}" name="{{$role->name}}" 
                                @if ($user->hasRole($role->name))
                                    checked
                                @endif
                                autocomplete="off">
                    <label class="btn" for="{{$role->name}}">{{$role->name}}</label>
                @endforeach
            </div>
        </div>

        <div>
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            <x-secondary-link href="{{ route('users.index') }}">{{ __('Cancel') }}</x-secondary-link>
        </div>
    </form>
</x-app-layout>