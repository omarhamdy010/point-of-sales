@extends('layouts.dashboard.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{__('site.create_product')}}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.index')}}">{{__('site.dashboard')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.product')}}</li>
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
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <p>{{$error}}</p>
                                        @endforeach
                                    </div>
                                @endif
                                <form class="form form-vertical" action="{{route('products.store')}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
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

                                                            <label for="last-name-column">{{__('site.'.$local .'.name')}}</label>

                                                            <input type="text" id="last-name-column" class="form-control"
                                                                   placeholder="{{__('site.'.$local .'.name')}}"
                                                                   name="{{ $local }}[name]" value="{{old($local.'.name')}}">

                                                            <label for="last-name-column">{{__('site.'.$local .'.description')}}</label>
                                                             <textarea placeholder="{{__('site.'.$local .'.description')}}"
                                                                       id="last-name-column" class="form-control ckeditor"
                                                                       name="{{ $local }}[description]">{{old($local.'.description')}}</textarea>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column">selling price</label>
                                                <input type="number" id="selling price" value="{{old('selling price')}}"
                                                       class="form-control" placeholder="selling price"
                                                       name="selling_price">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column">Purchasing price</label>
                                                <input type="number" id="Purchasing price" value="{{old('Purchasing price')}}"
                                                       class="form-control" placeholder="Purchasing price"
                                                       name="Purchasing_price">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column"> Stock</label>
                                                <input type="number" id="Stock" class="form-control"
                                                       value="{{old('stock')}}" placeholder="stock" name="stock">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="category"> Category</label>
                                                <select class="form-control" name="category_id">
                                                    <option> Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" {{old('category_id')==$category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="formFile" class="form-label"> image </label>
                                            <input class="form-control" type="file" name="image" accept="image/*"
                                                   value="{{old('image')}}" id="formFile" onchange="loadFile(event)">
                                            <img id="output" style="margin-top: 20px ; height: 200px;width: 200px"
                                                 src="{{asset('uploads/products/default.jpg')}}"/>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1" id="output">Submit
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






