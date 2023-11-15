<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Warehouses') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col">
            <nav class="nav justify-content-end">
                <x-primary-link :href="route('warehouses.create')">{{ __('New Warehouse') }}</x-primary-link>
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
            @if ($entries->isEmpty())
                <x-alert-info>{{ __('No warehouse found.') }}</x-alert-info>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Notes') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($entries as $entry)
                                <tr>
                                    <td>{{ $entry->id }}</td>
                                    <td>{{ $entry->name }}</td>
                                    <td>{{ substr($entry->notes, 0, 100) }}</td>
                                    <td class="text-end">
                                        <x-secondary-link :href="route('warehouses.edit', ['warehouse'=> $entry->id])"><i class="bi bi-pencil-fill"></i></x-secondary-link>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>