<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Dimensions') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col">
            <nav class="nav justify-content-end">
                @can('dimension.write')
                    <x-primary-link :href="route('dimensions.create')">{{ __('New Dimension') }}</x-primary-link>
                @endcan
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if (session('success'))
                <x-alert-success>{{ session('success') }}</x-alert-success>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($dimensions->isEmpty())
                <x-alert-info>{{ __('No dimensions found.') }}</x-alert-info>
            @else
                <div class="row mt-2 g-3">
                    @foreach ($dimensions as $dimension)
                        <div class="col-lg-2 col-md-3 col-sm-6"><div class="card">
                            <div class="card-header">{{ $dimension->name }}</div>
                            <div class="card-body">{{ $dimension->getUnits() }}</div>
                            <div class="card-footer text-end">
                                <x-secondary-link :href="route('dimensions.show', ['dimension'=> $dimension->id])"><i class="bi bi-eye-fill"></i></x-secondary-link>
                                @can('dimension.write')
                                    <x-secondary-link :href="route('dimensions.edit', ['dimension'=> $dimension->id])"><i class="bi bi-pencil-fill"></i></x-secondary-link>
                                @endcan
                            </div>
                        </div></div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</x-app-layout>