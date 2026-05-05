<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="username" value="Username" />
            <x-text-input id="username" name="username" type="text" :value="old('username')" required autofocus />
            <x-input-error :messages="$errors->get('username')" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" value="Role" />
            <select id="role" name="role" required
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                <option value="">-- Select Role --</option>
                <option value="admin"  {{ old('role') === 'admin'  ? 'selected' : '' }}>Admin</option>
                <option value="agent"  {{ old('role') === 'agent'  ? 'selected' : '' }}>Agent</option>
                <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>Client</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Create Account Link -->
        <div class="mt-4 text-center" style="border-top: 1px solid #E5E7EB; padding-top: 16px;">
            <span class="text-sm text-gray-500">Don't have an account?</span>
            <a href="{{ route('register') }}"
               class="text-sm font-semibold ms-1"
               style="color: #4F46E5; text-decoration: none;"
               onmouseover="this.style.textDecoration='underline'"
               onmouseout="this.style.textDecoration='none'">
                Create Account
            </a>
        </div>

    </form>
</x-guest-layout>