<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">

        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            <p>Toate parolele utilizatorilor de pe site sunt criptate </p><br>
            <p>In cazul in care ati uitat parola trebuie sa va introduceti adresa de email in campul de mai jos si sa
                trimiteti cerea de resetare a parolei. Veti primi un link, valabil 60 de minute, la care va veti putea
                schimba parola!</p>


        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    Trimite cerere resetare parola
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
