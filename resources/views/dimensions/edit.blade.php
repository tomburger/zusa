<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Edit Dimension') }}: {{$dimension->name}}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col">
            <form method="post" action="{{ route('dimensions.update', ['dimension'=>$dimension->id]) }}">
                @csrf
                @method('PUT')
                
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name" value="{{$dimension->name}}"/>
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div>
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                    <x-secondary-link href="{{ route('dimensions.index') }}">{{ __('Cancel') }}</x-secondary-link>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>