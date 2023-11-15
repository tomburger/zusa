<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Vendors') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col">
            <nav class="nav justify-content-end">
                <x-primary-link :href="route('vendors.create')">{{ __('New Vendor') }}</x-primary-link>
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
            @if ($vendors->isEmpty())
                <x-alert-info>{{ __('No vendors found.') }}</x-alert-info>
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
                            @foreach ($vendors as $vendor)
                                <tr>
                                    <td>{{ $vendor->id }}</td>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ substr($vendor->notes, 0, 100) }}</td>
                                    <td class="text-end">
                                        <x-secondary-link :href="route('vendors.show', ['vendor'=> $vendor->id])"><i class="bi bi-eye-fill"></i></x-secondary-link>
                                        <x-secondary-link :href="route('vendors.edit', ['vendor'=> $vendor->id])"><i class="bi bi-pencil-fill"></i></x-secondary-link>
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