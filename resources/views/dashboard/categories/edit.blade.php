@extends('layouts.dashboard.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{__('site.edit_category')}}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.index')}}">{{__('site.dashboard')}}</a></li>
                            <li class="breadcrumb-item " aria-current="page">{{__('site.category')}}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.edit')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="content" id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card navbar-light bg-light">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" action="{{route('categories.update',$category->id)}}"
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">

                                        <div class="card-body">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                @foreach(config('translatable.locales') as $local)
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link {{$loop->first?'active':''}}"
                                                           id="{{$local}}-tab"
                                                           data-bs-toggle="tab" href="#{{$local}}"
                                                           role="tab" aria-controls="{{$local}}"
                                                           aria-selected="true">{{$local == 'ar' ?'Arabic name':'English name'}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                @foreach(config('translatable.locales') as $local)
                                                    <div class="tab-pane fade show {{$loop->first ? 'active':''}}"
                                                         id="{{$local}}" role="tabpanel"
                                                         aria-labelledby="{{$local}}-tab">
                                                        <input type="text" id="last-name-column" class="form-control"
                                                               placeholder="{{__('site.'.$local .'.name')}}"
                                                               name="{{$local}}[name]" value="{{$category->translate($local)->name}}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <label for="formFile" class="form-label"> image </label>
                                            <input class="form-control" type="file" name="image" accept="image/*" id="image" onchange="loadFile(event)">
                                            <img id="output" style="margin-top: 20px ; height: 200px;width: 200px" src="{{$category->image_path}}" />
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
