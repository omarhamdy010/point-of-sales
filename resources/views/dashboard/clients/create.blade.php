@extends('layouts.dashboard.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{__('site.create_client')}}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.index')}}">{{__('site.dashboard')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.clients')}}</li>
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

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <p>{{$error}}</p>
                                        @endforeach
                                    </div>
                                @endif

                                <form class="form form-vertical" action="{{route('clients.store')}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <label class="form-label"> Name </label>
                                            <input type="text" class="form-control"
                                                   placeholder="{{__('site.name')}}"
                                                   name="name" value="{{old('name')}}">
                                        </div>

                                        @for($i=0 ; $i<2 ; $i++)
                                            <div class="col-md-6 col-12">
                                                <label class="form-label"> phone{{$i+1}} </label>
                                                <input type="text" class="form-control"
                                                       placeholder="{{__('site.phone')}}" name="phone[]"
                                                       value="{{old('phone[]')}}">
                                            </div>

                                        @endfor
                                        <div class="col-md-6 col-12">
                                            <label class="form-label"> Address </label>
                                            <textarea name="address" class="form-control"
                                                      placeholder="Address">{{old('address')}}</textarea>
                                        </div>

                                    </div>

                                    <div class=" card-body col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1" id="output">Create
                                        </button>
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






