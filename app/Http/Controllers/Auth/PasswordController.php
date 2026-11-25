<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use App\Models\VerificationCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
=======
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
<<<<<<< HEAD
    public function sendCode(Request $request): RedirectResponse
    {
        $user = $request->user();
        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        VerificationCode::where('email', $user->email)
            ->where('type', 'change_password')
            ->delete();

        VerificationCode::create([
            'email' => $user->email,
            'code' => $code,
            'type' => 'change_password',
            'expires_at' => now()->addMinutes(15),
        ]);

        Mail::raw(
            "Olá, {$user->name}!\n\nSeu código para confirmar a alteração de senha na Loja do Motoca é: {$code}\n\nEste código expira em 15 minutos.",
            function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Confirmação de Alteração de Senha - Loja do Motoca');
            }
        );

        return redirect()->route('profile.edit', ['tab' => 'seguranca'])
            ->with('status', 'password-code-sent');
    }

    public function update(Request $request): RedirectResponse
    {
        $rules = [
            'verification_code' => ['required', 'digits:6'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ];

        // Se o usuário NÃO veio pelo "Esqueci minha senha", exige também a senha atual
        if (!session('password_reset_verified')) {
            $rules['current_password'] = ['required', 'current_password'];
        }

        $validated = $request->validateWithBag('updatePassword', $rules, [
            'verification_code.required' => 'Informe o código de 6 dígitos enviado ao seu e-mail.',
            'verification_code.digits' => 'O código deve ter exatamente 6 números.',
        ]);

        $record = VerificationCode::where('email', $request->user()->email)
            ->where('code', $validated['verification_code'])
            ->where('type', 'change_password')
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return redirect()->route('profile.edit', ['tab' => 'seguranca'])
                ->withErrors(['verification_code' => 'Código de verificação inválido ou expirado.'], 'updatePassword');
        }

        $record->delete();

=======
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

<<<<<<< HEAD
        session()->forget('password_reset_verified');

        return redirect()->route('profile.edit', ['tab' => 'seguranca'])
            ->with('status', 'password-updated');
    }
}
=======
        return back()->with('status', 'password-updated');
    }
}
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
