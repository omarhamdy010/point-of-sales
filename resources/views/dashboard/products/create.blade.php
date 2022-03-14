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
                                <form class="form form-vertical" action="{{route('products.store')}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column"> Name</label>
                                                <input type="text" id="last-name-column" class="form-control"

                                                       placeholder="Name" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column"> Price</label>
                                                <input type="text" id="price" class="form-control" placeholder="Price"
                                                       name="price">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column"> Quantity</label>
                                                <input type="text" id="price" class="form-control"
                                                       placeholder="Quantity" name="quantity">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="category"> Category</label>
                                                    <select  class="form-control" name="category_id" >
                                                        <option> Select Category</option>
                                                        @foreach($categories as $category)
                                                        <option  value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="formFile" class="form-label"> image </label>
                                            <input class="form-control" type="file" name="image" accept="image/*"
                                                   id="formFile" onchange="loadFile(event)">
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






