<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Client $client)
    {
        $categories = Category::with('product')->get();
        return view('dashboard.clients.orders.create',compact('categories','client'));
    }

    public function store(Request $request)
    {
        dd($request->all());
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
