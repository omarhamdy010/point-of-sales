@extends('layouts.dashboard.app')

@section('content')
    <div class="page-content">
        @php
            $user = count(\App\Models\User::all());
            $category = count(\App\Models\Category::all());
            $product = count(\App\Models\Product::all());
            $clients = count(\App\Models\Client::all());
        @endphp
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">{{__('site.users')}}</h6>
                                        <h6 class="font-extrabold mb-0">{{$user-1}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldDocument"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">{{__('site.category')}}</h6>
                                        <h6 class="font-extrabold mb-0">{{$category}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-brokenPlus"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">{{__('site.product')}}</h6>
                                        <h6 class="font-extrabold mb-0">{{$product}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldUser1"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">{{__('site.client')}}</h6>
                                        <h6 class="font-extrabold mb-0">{{$clients}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Line Chart</h4>
                            </div>
                            <div class="card-body">
                                <div class="chart" id="line"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>

        var lineOptions = {
            chart: {
                type: "line",
            },
            series: [
                {
                    name: "total",
                    data: [
                        @foreach($sales_data as $data)
                        {{$data->sum}},
                        @endforeach
                    ],
                },
            ],
            xaxis: {
                categories: [
                    @foreach($sales_data as $data)

                   " {{$data->year}} - {{$data->month}}",
                    @endforeach
                ],
            },
        };
    </script>
@endpush
