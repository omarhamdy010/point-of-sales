@extends('layouts.dashboard.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{__('site.orders')}}
                <small> {{$orders->total() . __('site.orders')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>{{__('site.dashboard')}}</a>
                </li>
                <li class="active">{{__('site.orders')}}</li>
            </ol>
        </section>
        <section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="margin-bottom: 10px">{{__('site.orders')}}</h3>
                    <form action="{{route('orders.index')}}" method="get">
                        <div class="row">
                            <div class="col-md-8">
                                    <input type="text" name="search" class="form-control" placeholder="Search">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Search</button>
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
{{--                                    <th>{{__('site.status')}}</th>--}}
                                    <th>{{__('site.created_at')}}</th>
{{--                                    <th>{{__('site.actions')}}</th>--}}
                                </tr>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->client->name}}</td>
                                    <td>{{number_format($order->total_price,2)}}</td>
                                    <td>{{$order->created_at->toFormattedDateString()}}</td>
                                </tr>
                                    @endforeach
                            </table>
                    </div>

                    @endif
            </div>
        </div>
    </div>
        </section>
    </div>

@endsection
