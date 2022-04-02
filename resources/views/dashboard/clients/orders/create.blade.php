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
                        <div class="col-md-6 ">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <a></a>
                                        <h3 class="card-title">{{__('site.categories')}}</h3>
                                    </div>
                                </div>
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
                                                            <th>{{__('site.stock')}}</th>
                                                            <th>{{__('site.price')}}</th>
                                                            <th>{{__('site.add')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($category->product as $product)
                                                            <tr>
                                                                <td>{{$product->name}}</td>
                                                                <td>{{$product->stock}}</td>
                                                                <td>{{$product->selling_price}}</td>
                                                                <td>
                                                                    <a href=""
                                                                       id="product-{{$product->id}}"
                                                                       data-name="{{$product->name}}"
                                                                       data-id="{{$product->id}}"
                                                                       data-price="{{$product->selling_price}}"
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

                        <div class="col-md-6 row">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <a></a>
                                        <h3 class="card-title">{{__('site.orders')}}</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">

                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>{{__('site.price')}}</th>
                                                <th>{{__('site.quantity')}}</th>
                                                <th>{{__('site.product')}}</th>
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
                                            <a class="btn btn-primary form-control" style="background-color: #435ebe">{{__('site.add_order')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection






