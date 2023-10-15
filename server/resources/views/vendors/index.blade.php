<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vendors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <x-primary-link :href="route('vendors.create')">{{ __('New Vendor') }}</x-primary-link>
                <div class="max-w-xl">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Notes</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
