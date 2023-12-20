<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Dimension') }}: {{$dimension->name}}
        </h2>
    </x-slot>

    <div class="row mt-4">
        <div class="col"><h3>{{ __('Units of Measure') }}</h3></div>
        <div class="col text-end">
            <x-secondary-link href="{{ route('dimensions.index') }}">{{ __('Cancel') }}</x-secondary-link>
        </div>
    </div>
    <div class="row">
    @if ($dimension->units->isEmpty())
        <div class="col">
            <x-alert-info>{{ __('No units of measure found.') }}</x-alert-info>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
            @foreach($dimension->units as $unit) 
                <tr>
                    <td>{{ $unit->name }}</td>
                </tr>
            @endforeach
            </table>
        </div>
    @endif
    </div>
    <div class="row">
        <div class="col">
            <form method="post" action="{{ route('dimensions.addUnit', ['dimension'=>$dimension->id]) }}">
                @csrf
                @method('POST')
                
                <div class="row">
                    <div class="col">
                        <x-text-input id="name" name="name" type="text" required autofocus autocomplete="name" placeholder="{{ __('Add new unit') }}"/>
                    </div>
                    <div class="col">
                        <x-primary-button>{{ __('Add') }}</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>