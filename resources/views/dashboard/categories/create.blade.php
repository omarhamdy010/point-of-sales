@extends('layouts.dashboard.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{__('site.create_category')}}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.index')}}">{{__('site.dashboard')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.category')}}</li>
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
                                <form class="form form-vertical" action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <div class="row">
                                    @foreach(config('translatable.locales') as $local)
                                    <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column">{{__('site.'.$local .'.name')}}</label>
                                                <input type="text" id="last-name-column" class="form-control" value="{{old($local.'.name')}}"
                                                placeholder="Name" name="{{$local}}[name]">
                                            </div>
                                        </div>
                                    @endforeach
                                        
                                        <div class="col-md-6 col-12">
                                            <label for="formFile" class="form-label"> image </label>
                                            <input class="form-control" type="file" name="image" accept="image/*" id="formFile" onchange="loadFile(event)">
                                            <img id="output" style="margin-top: 20px ; height: 200px;width: 200px" src="{{asset('uploads/categories/default.jpg')}}" />
                                        </div>
                                    </div>


                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1" id="output">Submit</button>
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






