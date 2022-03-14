@extends('layouts.dashboard.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <p style="font-size:25px">{{__('site.products')}}<small style="font-size:5px">{{$products->count()}}</small></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.index')}}">{{__('site.dashboard')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.product')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="row" id="table-contexual">
                <div class="col-12">
                    <div class="card">
                        <div class="row">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-1">
                                            <div class="input-group mb-3">
                                                @if(auth()->user()->hasPermission('products_create'))
                                                <a href="{{route('products.create')}}" class="btn btn-primary icon col-6 col-md-3 col-lg-2 pr4 pb2 pt2 bb bw1 b--gray1 hover-black bw0-pr db fl-pr">Create</a>
                                                @else
                                                    <a  class="btn btn-primary disabled icon col-6 col-md-3 col-lg-2 pr4 pb2 pt2 bb bw1 b--gray1 hover-black bw0-pr db fl-pr">Create</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <form method="{{route('products.index')}}" type="get">
                                                @csrf
                                                @method('get')
                                            <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="bi bi-search"></i></span>
                                                <input type="text" class="form-control"
                                                       placeholder="{{__('site.search')}}"
                                                       aria-label="Recipient's productname" value="{{request()->search}}" name="search" aria-describedby="button-addon2">
                                                <button class="btn btn btn-primary" type="submit" id="button-addon2">Button</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            @if($products->count()>0)
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('site.name')}}</th>
                                        <th>{{__('site.price')}}</th>
                                        <th>{{__('site.quantity')}}</th>
                                        <th>{{__('site.category')}}</th>
                                        <th>{{__('site.image')}}</th>
                                        <th>{{__('site.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($products as $index=>$product)
                                        <tr class="table-primary">
                                            <td class="text-bold-500">{{$index+1}}</td>
                                            <td class="text-bold-500">{{$product->name}}</td>
                                            <td class="text-bold-500">{{$product->price}}</td>
                                            <td class="text-bold-500">{{$product->quantity}}</td>
                                            <td class="text-bold-500">{{$product->category->name}}</td>
                                            <td class="text-bold-500"><img style=" height: 100px;width: 100px"  src="{{$product->image_path}}"></td>
                                            <td>
                                                <form action="{{route('products.destroy' , $product->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    @if(auth()->user()->hasPermission('products_update'))
                                                    <a href="{{route('products.edit',$product->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                                                    @else
                                                        <a class="btn btn-primary disabled">Edit</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('products_delete'))
                                                        <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i>Delete</button>
                                                    @else
                                                        <button type="submit" class="btn btn-danger disabled">Delete</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $products->appends(request()->query())->links() }}
                            </div>
                            @else
                                <h2>{{__('site.no_data_found')}}</h2>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
