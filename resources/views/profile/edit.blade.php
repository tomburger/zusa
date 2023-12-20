<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        @include('profile.partials.update-profile-information-form')
    </div>
    <div class="mt-5">
        @include('profile.partials.update-password-form')
    </div>
    <!-- 
    We do not want to allow user deletion at the moment
    <div class="row mt-4">
        @include('profile.partials.delete-user-form')
    </div> 
    -->
</x-app-layout>
