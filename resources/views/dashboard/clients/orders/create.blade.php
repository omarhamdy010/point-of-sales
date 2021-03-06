@extends('layouts.dashboard.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{__('site.create_order')}}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.index')}}">{{__('site.dashboard')}}</a></li>
                            <li class="breadcrumb-item " aria-current="page"><a
                                    href="{{route('clients.index')}}">{{__('site.client')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.order')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="content" id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h4>{{$client->name}}</h4>
                                            <h3 class="card-title">{{__('site.orders')}}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('clients.orders.store',$client->id)}}" method="post">
                                        @method('post')
                                        @csrf
                                        <div class="card-body">
                                            <div class="d-flex">

                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>{{__('site.product')}}</th>
                                                        <th>{{__('site.image')}}</th>
                                                        <th>{{__('site.quantity')}}</th>
                                                        <th>{{__('site.price')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="order-list">

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div>
                                                {{__('site.total')}} : <span class="total-price">0</span>
                                            </div>


                                            <div class="d-flex flex-row justify-content-end">
                                                <button type="submit"
                                                        class="btn btn-primary btn-block disabled form-control"
                                                        id="add_order_btn"
                                                        style="background-color: #435ebe">{{__('site.add_order')}}</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>

                            <div class="card">
                                @if($client->orders->count()>0)
                                    <div class="card-header">
                                        <div class="card-header border-0">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="card-title">{{__('site.previous_orders')}}
                                                    <samll>{{$orders->total()}}</samll>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @foreach($orders as $order)
                                            <div class="panel-group">
                                                <div class="panel panel-success">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse"
                                                               href="#{{$order->id}}">{{$order->created_at->toFormattedDateString()}}</a>
                                                        </h4>
                                                    </div>
                                                    <div id="{{$order->id}}">
                                                        <div class="panel-body">
                                                            <ul class="list-group">
                                                                @foreach($order->products as $product)
                                                                    <li class="list-group-item">{{$product->name}}</li>
                                                                    <li class="list-group-item">
                                                                        <ul>
                                                                            <li>price: {{$product->selling_price}}</li>
                                                                            <li>quantity: {{$product->pivot->quantity}}</li>
                                                                            <li>image: <img style="width: 50px;height: 50px" src="{{$product->image_path}}"></li>
                                                                        </ul>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <div>total price :{{$order->total_price}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        {{$orders->links()}}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <a></a>
                                        <h3 class="card-title">{{__('site.categories')}}</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @foreach($categories as $category)
                                        <div class="col-12">
                                            <div class="card card-cyan">
                                                <div class="card-header">
                                                    <h3 class="card-title">{{$category->name}}</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                                data-card-widget="collapse" title="Collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">

                                                    @if($category->product->count()>0)
                                                        <table class="table table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__('site.name')}}</th>
                                                                <th>{{__('site.image')}}</th>
                                                                <th>{{__('site.stock')}}</th>
                                                                <th>{{__('site.price')}}</th>
                                                                <th>{{__('site.add')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($category->product as $product)
                                                                <tr>
                                                                    <td>{{$product->name}}</td>
                                                                    <td><img style="height: 50px;width: 50px" src="{{$product->image_path}}"></td>
                                                                    <td>{{$product->stock}}</td>
                                                                    <td>{{number_format($product->selling_price , 2)}}</td>
                                                                    <td>
                                                                        <a href=""
                                                                           id="product-{{$product->id}}"
                                                                           data-name="{{$product->name}}"
                                                                           data-id="{{$product->id}}"
                                                                           data-price="{{$product->selling_price}}"
                                                                           data-image="{{$product->image_path}}"
                                                                           class="btn btn-success btn-sm add-product-btn"
                                                                        ><i class="fa fa-plus"></i></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        {{__('site.no_data_found')}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection






