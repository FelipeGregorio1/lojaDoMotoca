<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;

class OrderController extends Controller
{
    // Lista todos os pedidos (ou apenas os de um cliente específico)
    public function index(Request $request){
        $query = Order::with('User')->latest();
        $selectedClient = null;

        // Se clicou em "GERENCIAR PEDIDOS" na tela de clientes, filtra pelo user_id
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
            $selectedClient = User::find($request->user_id);
        }

        $orders = $query->get();

        return view('admin.orders', [
            'orders' => $orders,
            'selectedClient' => $selectedClient
        ]);
    }

    // Muda o status do pedido (PAGO -> SEPARAÇÃO -> ENVIADO -> ENTREGUE)
    public function updateStatus(Request $request, Order $order){
        $order->update([
            'status' => $request->status
        ]);

        return back();
    }

    // Quando o cliente clica em "FINALIZAR COMPRA" lá no carrinho
    public function checkout(){
        $carts = Cart::where('user_id', auth()->id())->with('Product')->get();

        if ($carts->isEmpty()) {
            return redirect('/cart');
        }

        $subtotal = $carts->sum(fn($item) => $item->Product->price * $item->quantity);
        $finalTotal = $subtotal >= 299 ? $subtotal : $subtotal + 29.90;

        // Cria o pedido no banco
        Order::create([
            'user_id' => auth()->id(),
            'total'   => $finalTotal,
            'status'  => 'PAGO',
        ]);

        // Limpa o carrinho do usuário após finalizar a compra
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('client.home');
    }
}
