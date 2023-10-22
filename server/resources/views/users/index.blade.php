<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col">
            @if (session('success'))
                <x-alert-success>{{ session('success') }}</x-alert-success>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($users->isEmpty())
                <x-alert-info>{{ __('No users found.') }}</x-alert-info>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Active') }}</th>
                                <th>{{ __('Profile') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    @if ($user->active)
                                    	<td class="text-success"><i class="bi bi-check-square"></i></td>
                                    @else
                                        <td class="text-warning"><i class="bi bi-check-square"></i></td>
                                    @endif
                                    <td>{{ $user->profile->getLabel() }}</td>
                                    <td class="text-end">
                                        <form method="POST" style="display:inline-block;" action="{{ route('users.activate', ['user'=> $user->id]) }}">
                                            @csrf
                                            <x-secondary-button type="submit"><i class="bi bi-check-square"></i></x-secondary-link>
                                        </form>
                                        <x-secondary-link :href="route('users.edit', ['user'=> $user->id])"><i class="bi bi-pencil-fill"></i></x-secondary-link>
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