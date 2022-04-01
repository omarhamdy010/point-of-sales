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
                                <div class="card-body">



                                </div>
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

                                    </div>


                                    <div class="d-flex flex-row justify-content-end">

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






