<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $sales_data = Order::select(
            DB::raw(' year(created_at)as year'),
            DB::raw('month(created_at)as month'),
            DB::raw('sum(total_price)as sum')
        )->groupBy('month')->get();

        return view('dashboard.index' ,compact('sales_data'));
    }
}
