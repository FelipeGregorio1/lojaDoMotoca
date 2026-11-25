<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'Não encontramos nenhuma conta com este e-mail.',
        ]);

        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        VerificationCode::where('email', $request->email)
            ->where('type', 'forgot_password')
            ->delete();

        VerificationCode::create([
            'email' => $request->email,
            'code' => $code,
            'type' => 'forgot_password',
            'expires_at' => now()->addMinutes(15),
        ]);

        Mail::raw(
            "Olá!\n\nSeu código de verificação da Loja do Motoca é: {$code}\n\nEste código expira em 15 minutos.",
            function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Código de Verificação - Loja do Motoca');
            }
        );

        session(['reset_email' => $request->email]);

        return redirect()->route('password.code.form')
            ->with('status', 'Enviamos um código de 6 dígitos para o seu e-mail!');
    }

    public function showVerifyForm(): View|RedirectResponse
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-code', [
            'email' => session('reset_email'),
        ]);
    }

    public function verifyCode(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'code' => ['required', 'digits:6'],
        ], [
            'code.digits' => 'O código deve conter exatamente 6 números.',
        ]);

        $record = VerificationCode::where('email', $request->email)
            ->where('code', $request->code)
            ->where('type', 'forgot_password')
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return back()->withErrors(['code' => 'Código inválido ou expirado. Tente novamente.']);
        }

        $record->delete();

        $user = User::where('email', $request->email)->firstOrFail();

        Auth::login($user);
        $request->session()->regenerate();
        session()->forget('reset_email');
        session(['password_reset_verified' => true]);

        return redirect()->route('profile.edit', ['tab' => 'seguranca'])
            ->with('status', 'code-verified');
    }
}