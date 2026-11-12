<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Indicadores do topo (KPIs)
        $salesToday = Order::whereDate('created_at', Carbon::today())->sum('total');
        $ordersToday = Order::whereDate('created_at', Carbon::today())->count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();

        // 2. Últimos 3 pedidos para a lista "Pedidos recentes"
        $recentOrders = Order::with('User')->latest()->take(3)->get();

        // 3. Dados dos últimos 7 dias para o Gráfico em CSS Puro
        $chartData = [];
        $maxSale = 0;

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dayTotal = (float) Order::whereDate('created_at', $date)->sum('total');

            if ($dayTotal > $maxSale) {
                $maxSale = $dayTotal;
            }

            $chartData[] = [
                'label' => $date->format('d/m'),
                'total' => $dayTotal,
            ];
        }

        return view('admin.dashboard', compact(
            'salesToday',
            'ordersToday',
            'totalOrders',
            'totalProducts',
            'totalCategories',
            'recentOrders',
            'chartData',
            'maxSale'
        ));
    }
}
