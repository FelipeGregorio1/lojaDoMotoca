<form method="POST" action="{{ route('login') }}">
    @csrf
    <div>
        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" required>
    </div>

    <div>
        <label for="password">Senha</label>
        <x-text-input id="password" type="password" name="password" required/>
    </div>
        <button type="submit">Logar</button>
    </div>
</form>