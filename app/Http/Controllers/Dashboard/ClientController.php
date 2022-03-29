<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    public function index(){
        $clients= Client::all();
        return view('dashboard.clients.index',compact('clients'));
    }
    public function create(){

        return view('dashboard.clients.create');
    }
    public function store(Request $request){
        $request->validate([
           'name'=>'required',
           'phone'=>'required',
           'phone.0'=>'required',
           'address'=>'required',
        ]);

        Client::create($request->all());
        \session()->flash('Success','clients added successfully');
        return view('dashboard.clients.index');
    }
}
