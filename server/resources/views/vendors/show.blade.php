<x-app-layout>
    <x-slot name="header">
        <h2>{{$vendor->name}}</h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            {{__('Notes')}}
        </div>
        <div class="card-body" style="white-space: pre-wrap">{{$vendor->notes}}</div>
    </div>

    <div class="card mt-2">
        <div class="card-header">
            {{__('Contacts')}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <nav class="nav justify-content-end">
                        <x-primary-link :href="route('vendors.contacts.create', ['vendor'=>$vendor->id])">{{ __('New Contact') }}</x-primary-link>
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
            @include('contacts.table', ['contacts'=>$vendor->contacts])
        </div>
    </div>


</x-app-layout>