<form method="POST" action="{{ route('register') }}">
    @csrf
    <div>
        <label for="name">Nome</label>
        <input id="name" type="text" name="name" required>
    </div>

    <div>
        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" required>
    </div>

    <div>
        <label for="password">Senha</label>
        <input id="password" type="password" name="password" required/>
    </div>

    <div>
        <label for="password_confirmation">Confirmar Senha</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required/>
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-primary-button class="ms-4">
            {{ __('Register') }}
        </x-primary-button>
    </div>
</form>

