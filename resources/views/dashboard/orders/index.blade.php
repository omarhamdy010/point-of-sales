@extends('layouts.dashboard.app')

@section('content')



    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{__('site.order')}}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.index')}}">{{__('site.dashboard')}}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="content" id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-4 row">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <a></a>
                                        <h3 class="card-title">{{__('site.show_order')}}</h3>
                                    </div>
                                </div>

                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title"></h3>
                                        <div class="box-body">
                                            <div id="loading"
                                                 style="display: none ; flex-direction: column ; align-items: center">
                                                <div class="loader"></div>
                                                <p style="margin-top: 10px">{{__('site.loading')}}</p>
                                            </div>
                                            <div id="order-product-list">
                                                <table class="table mb-0 table_hide">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{__('site.name')}}</th>
                                                        <th>{{__('site.quantity')}}</th>
                                                        <th>{{__('site.price')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <a></a>
                                        <h3>{{__('site.orders')}}
                                            {{--                    <h6> {{$orders->total() . __('site.orders')}}</h6>--}}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-md-6 mb-1">
                                        <form action="{{route('orders.index')}}" method="get">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input type="text" name="search" class="form-control"
                                                           value="{{request()->search}}"
                                                           placeholder="Search">
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-search"></i>Search
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @if($orders->count()>0)

                                        <div class="box-body table-responsive">
                                            <table class="table table-hover">
                                                <tr>
                                                    <th>{{__('site.client_name')}}</th>
                                                    <th>{{__('site.price')}}</th>
                                                    <th>{{__('site.status')}}</th>
                                                    <th>{{__('site.created_at')}}</th>
                                                    <th>{{__('site.actions')}}</th>
                                                </tr>
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td>{{$order->client->name}}</td>
                                                        <td>{{number_format($order->total_price,2)}}</td>
                                                        <td>
                                                            <button
                                                                data-status="{{__('site.'.$order->status)}}"
                                                                {{--                                                        data-url="{{route('order.update_status')}}"--}}
                                                                data-method="put"
                                                                data-available-status='["{{__('site.processing')}}"]'
                                                            ></button>
                                                        </td>
                                                        <td>{{$order->created_at->toFormattedDateString()}}</td>
                                                        <td>
                                                            <button class="btn btn-primary btn-sm order-products"
                                                                    data-url="{{route('orders.products',$order->id)}}"
                                                                    data-method="get"
                                                            >
                                                                <i class="fa fa-list"></i>{{__('site.show')}}
                                                            </button>
                                                            @if(auth()->user()->hasPermission('orders_update'))
                                                                <a class="btn btn-warning btn-sm"
                                                                   href="{{route('clients.orders.edit',['client'=>$order->client->id,'order'=>$order->id])}}"><i
                                                                        class="fa fa-edit"></i> {{__('site.edit')}}</a>
                                                            @else
                                                                <a href="#" disabled class="btn btn-warning btn-sm"><i
                                                                        class="fa fa-edit"></i>{{__('site.edit')}}</a>
                                                            @endif

                                                            <form action="{{route('orders.destroy',$order->id)}}" method="post">
                                                                @if(auth()->user()->hasPermission('orders_delete'))
                                                                @method('DELETE')
                                                                     @csrf
                                                                    <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i>Delete</button>
                                                                @else
                                                                    <button type="submit" class="btn btn-danger disabled">Delete</button>
                                                                @endif
                                                            </form>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    @else
                                        {{__('site.no_data_found')}}
                                    @endif
                                </div>

                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
