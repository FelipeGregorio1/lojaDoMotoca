<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientAdminController extends Controller
{
    public function index(){
        // Busca todos os usuários cadastrados (você pode usar User::where('is_admin', false)->get() se quiser ocultar os admins atuais)
        $clients = User::all();

        return view('admin.clients', ['clients' => $clients]);
    }

    public function toggleAdmin(User $user){
        // Alterna o status de administrador (se era 0 vira 1, se era 1 vira 0)
        $user->update([
            'is_admin' => !$user->is_admin
        ]);

        return redirect()->route('admin.clients.index');
    }

    public function destroy(User $user){
        // Evita que o admin logado exclua a própria conta sem querer
        if (auth()->id() !== $user->id) {
            $user->delete();
        }

        return redirect()->route('admin.clients.index');
    }
}
