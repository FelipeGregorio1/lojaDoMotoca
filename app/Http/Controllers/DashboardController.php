<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
<<<<<<< HEAD
    public function index(Request $request)
    {
        // 1. Indicadores do topo (KPIs)
        $salesToday = Order::where('status', '!=', 'CANCELADO')
            ->whereDate('created_at', Carbon::today())
            ->sum('total');

=======
    public function index()
    {
        // 1. Indicadores do topo (KPIs)
        $salesToday = Order::whereDate('created_at', Carbon::today())->sum('total');
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
        $ordersToday = Order::whereDate('created_at', Carbon::today())->count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();

        // 2. Últimos 3 pedidos para a lista "Pedidos recentes"
        $recentOrders = Order::with('User')->latest()->take(3)->get();

<<<<<<< HEAD
        // 3. Filtro do Gráfico (day = dia específico, week = 7 dias, month = mês inteiro)
        $period = $request->input('period', 'week');
        $refDate = $request->filled('date')
            ? Carbon::parse($request->input('date'))
            : Carbon::today();

        $selectedDate = $refDate->toDateString();
        $chartData = [];
        $maxSale = 0;

        if ($period === 'day') {
            $chartTitle = 'Desempenho de vendas (' . $refDate->format('d/m/Y') . ')';
            $slots = [
                ['00h-04h', 0, 3],
                ['04h-08h', 4, 7],
                ['08h-12h', 8, 11],
                ['12h-16h', 12, 15],
                ['16h-20h', 16, 19],
                ['20h-24h', 20, 23],
            ];

            foreach ($slots as [$label, $startHour, $endHour]) {
                $start = $refDate->copy()->setTime($startHour, 0, 0);
                $end   = $refDate->copy()->setTime($endHour, 59, 59);

                $slotTotal = (float) Order::where('status', '!=', 'CANCELADO')
                    ->whereBetween('created_at', [$start, $end])
                    ->sum('total');

                if ($slotTotal > $maxSale) {
                    $maxSale = $slotTotal;
                }

                $chartData[] = [
                    'label' => $label,
                    'total' => $slotTotal,
                ];
            }
        } elseif ($period === 'month') {
            $chartTitle = 'Desempenho de vendas (' . $refDate->format('m/Y') . ')';
            $startOfMonth = $refDate->copy()->startOfMonth();
            $endOfMonth   = $refDate->copy()->endOfMonth();

            $weekNum = 1;
            $cursor = $startOfMonth->copy();

            while ($cursor->lte($endOfMonth)) {
                $weekStart = $cursor->copy()->startOfDay();
                $weekEnd   = $cursor->copy()->addDays(6)->endOfDay();

                if ($weekEnd->gt($endOfMonth)) {
                    $weekEnd = $endOfMonth->copy()->endOfDay();
                }

                $weekTotal = (float) Order::where('status', '!=', 'CANCELADO')
                    ->whereBetween('created_at', [$weekStart, $weekEnd])
                    ->sum('total');

                if ($weekTotal > $maxSale) {
                    $maxSale = $weekTotal;
                }

                $chartData[] = [
                    'label' => "Sem {$weekNum} ({$weekStart->format('d')}-{$weekEnd->format('d')})",
                    'total' => $weekTotal,
                ];

                $cursor->addDays(7);
                $weekNum++;
            }
        
        } elseif ($period === 'year') {
            $year = $refDate->year;
            $chartTitle = "Desempenho de vendas ({$year})";
            $months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

            foreach ($months as $index => $monthLabel) {
                $monthNumber = $index + 1;

                $monthTotal = (float) Order::where('status', '!=', 'CANCELADO')
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $monthNumber)
                    ->sum('total');

                if ($monthTotal > $maxSale) {
                    $maxSale = $monthTotal;
                }

                $chartData[] = [
                    'label' => $monthLabel,
                    'total' => $monthTotal,
                ];
            }    

        } else {
            // Padrão: 7 dias terminando na data selecionada
            $startOfWeek = $refDate->copy()->subDays(6);
            $chartTitle = 'Desempenho de vendas (' . $startOfWeek->format('d/m') . ' a ' . $refDate->format('d/m') . ')';

            for ($i = 6; $i >= 0; $i--) {
                $date = $refDate->copy()->subDays($i);
                $dayTotal = (float) Order::where('status', '!=', 'CANCELADO')
                    ->whereDate('created_at', $date)
                    ->sum('total');

                if ($dayTotal > $maxSale) {
                    $maxSale = $dayTotal;
                }

                $chartData[] = [
                    'label' => $date->format('d/m'),
                    'total' => $dayTotal,
                ];
            }
=======
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
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
        }

        return view('admin.dashboard', compact(
            'salesToday',
            'ordersToday',
            'totalOrders',
            'totalProducts',
            'totalCategories',
            'recentOrders',
            'chartData',
<<<<<<< HEAD
            'maxSale',
            'period',
            'selectedDate',
            'chartTitle'
        ));
    }
}
=======
            'maxSale'
        ));
    }
}
>>>>>>> ee0b4fc903e302b86beb4b963e673022e6723f01
