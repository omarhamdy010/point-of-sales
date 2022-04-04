<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function create(Client $client)
    {
        $categories = Category::with('product')->get();
        return view('dashboard.clients.orders.create',compact('categories','client'));
    }

    public function store(Request $request,Client $client)
    {
        $request->validate([
            'products'=>'required|array',
//            'quantities'=>'required|array'
        ]);

        $order = $client->orders()->create([]);


//        foreach ($request->product_ids as  $index=>$product_id){
//
//            $product = Product::findOrFail($product_id);
//            $price =  $product->selling_price;
//            $quantity = $request->quantities[$index];
////            dd($product);
//            $total_price += $price* $quantity ;
//            $order->products()->attach($product_id , ['quantity'=>$request->quantities[$index]]);
//            $product->update(['stock'=>$product->stock -$quantity]);
//
//        }
        $order->products()->attach($request->products);

        $total_price = 0 ;
        foreach ($request->products as  $id=>$quantity){

            $product = Product::findOrFail($id);
            $price =  $product->selling_price;

//            dd($product);

            $total_price += $price * $quantity['quantity'];
            $product->update(['stock'=>$product->stock - $quantity['quantity']]);

        }
        $order->update(['total_price'=>$total_price]);
        Alert::toast('You\'ve Successfully order created', 'success');

        return redirect()->route('orders.index');
    }

    public function edit()
    {


    }

    public function update()
    {


    }

    public function destroy()
    {

    }
}
