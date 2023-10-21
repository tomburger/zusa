<x-guest-layout>
    <x-narrow>
        <div>
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mt-4">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-primary-button>
                        {{ __('Resend Verification Email') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
        <div class="mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-secondary-button type="submit">
                    {{ __('Log Out') }}
                </x-secondary-button>
            </form>
        </div>
    </x-narrow>
</x-guest-layout>
