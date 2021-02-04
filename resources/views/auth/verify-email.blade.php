<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">

            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            <p>
                Va multumim pentru ca v-ati creat un cont pe situl nostru! Pentur a putea folosi serviciile sitului
                trebuie sa va verificati contul la adresa de email inregistrata!
                <br>
                In cazul in care nu ati primit un email pentru verificarea contului, va rugam sa verificat sectiunea
                spam a adresei Dvs de email.
                <br>
                Daca nu gasiti emailul de verrificare a contului puteti cere o noua verificare apasand butonul de mai
                jos!
            </p>

        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A fost trimis un nou email de verificare a contului. Daca in decurs de cateva minute nu primiti acest email, verificati sectiunea spam a emailului Dvs.') }}
            </div>
        @endif

        <div class="mt-4  items-center justify-between">
            <div style="width: 100%;">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-button>
                            {{ __('Trimite o noua cerere de verificare a contului') }}
                        </x-button>
                    </div>
                </form>
            </div>

            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                        {{ __('Logout') }}
                    </button>
                </form>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
