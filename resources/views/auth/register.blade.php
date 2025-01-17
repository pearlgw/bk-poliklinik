<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="nama" :value="__('Nama')" />
            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required
                autofocus autocomplete="nama" />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="alamat" :value="__('Alamat')" />
            <x-text-input id="text" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="no_ktp" :value="__('No KTP')" />
            <x-text-input id="text" class="block mt-1 w-full" type="text" name="no_ktp" :value="old('no_ktp')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('no_ktp')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="no_hp" :value="__('No HP')" />
            <x-text-input id="text" class="block mt-1 w-full" type="text" name="no_hp" :value="old('no_hp')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
        </div>

        {{-- <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div> --}}

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
