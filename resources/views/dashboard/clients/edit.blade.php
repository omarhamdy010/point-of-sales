@extends('layouts.dashboard.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{__('site.edit_client')}}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.index')}}">{{__('site.dashboard')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.client')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="content" id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" action="{{route('clients.update',$client->id)}}"
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">

                                                <div class="col-md-6 col-12">
                                                    <label class="form-label"> Name </label>
                                                    <input type="text" class="form-control"
                                                           placeholder="{{__('site.name')}}"
                                                           name="name" value="{{$client->name}}">
                                                </div>

                                        @for($i=0 ; $i<2 ; $i++)
                                            <div class="col-md-6 col-12">
                                                <label class="form-label"> phone{{$i+1}} </label>
                                                <input type="text" class="form-control"
                                                       placeholder="{{__('site.phone')}}" name="phone[]"
                                                       value="{{$client->phone[$i] ?? ''}}">
                                            </div>
                                        @endfor

                                                <div class="col-md-6 col-12">
                                                    <label class="form-label"> Address </label>
                                                    <textarea name="address" class="form-control" placeholder="Address">{{$client->address}}</textarea>
                                                </div>

                                        <div class="card-body col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
