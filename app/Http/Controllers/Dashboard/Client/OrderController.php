<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;

class OrderController extends Controller
{
    public function create()
    {
        $categories = Category::with('product')->get();
        return view('dashboard.clients.orders.create',compact('categories'));
    }

    public function store()
    {

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
