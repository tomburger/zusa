<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Phone') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Notes') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact) 
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->notes }}</td>
                    <td class="text-end">
                        <x-secondary-link :href="route('vendors.contacts.edit', ['vendor'=>$contact->vendor_id,'contact'=> $contact->id])"><i class="bi bi-pencil-fill"></i></x-secondary-link>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>