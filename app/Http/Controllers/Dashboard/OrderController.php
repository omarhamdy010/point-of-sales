<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::whereHas('client', function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%');
        })->paginate(5);
        return view('dashboard.orders.index', compact('orders'));
    }

    public function products(Order $order)
    {

        $products = $order->products()->get();

        return view('dashboard.orders._products',compact('products' , 'order'));
    }

    public function destroy(Order $order){

       foreach ($order->products as $product_item){

           $quantity = $product_item->pivot->quantity;

           $product_item->update([
               'stock'=> $product_item->stock + $quantity ,
           ]);
       }


        $order->delete();

        Alert::toast('You\'ve Successfully deleted', 'success');

        return redirect()->route('orders.index');
    }
}
