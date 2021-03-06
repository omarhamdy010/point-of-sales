@extends('layouts.dashboard.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <p style="font-size:25px">{{__('site.users')}}<small style="font-size:5px">{{$users->count()}}</small></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.index')}}">{{__('site.dashboard')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.user')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="row" id="table-contexual">
                <div class="col-12">
                    <div class="card navbar-light bg-light">
                        <div class="row">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-1">
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <form method="{{route('users.index')}}" type="get">
                                                @csrf
                                                @method('get')
                                            <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="bi bi-search"></i></span>
                                                <input type="text" class="form-control"
                                                       placeholder="{{__('site.search')}}"
                                                       aria-label="Recipient's username" value="{{request()->search}}" name="search" aria-describedby="button-addon2">
                                                <button class="btn btn btn-primary" type="submit" id="button-addon2">Button</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            @if($users->count()>0)
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('site.first_name')}}</th>
                                        <th>{{__('site.last_name')}}</th>
                                        <th>{{__('site.email')}}</th>
                                        <th>{{__('site.image')}}</th>
                                        <th>{{__('site.phone')}}</th>
                                        <th>{{__('site.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($users as $index=>$user)
                                        <tr class="table-primary">
                                            <td class="text-bold-500">{{$index+1}}</td>
                                            <td class="text-bold-500">{{$user->first_name}}</td>
                                            <td class="text-bold-500">{{$user->last_name}}</td>
                                            <td class="text-bold-500">{{$user->email}}</td>
                                            <td class="text-bold-500"><img style=" height: 100px;width: 100px"  src="{{$user->image_path}}"></td>
                                            <td class="text-bold-500">{{$user->phone}}</td>
                                            <td>
                                                <form action="{{route('users.destroy' , $user->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    @if(auth()->user()->hasPermission('users_update'))
                                                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</a>
                                                    @else
                                                        <a class="btn btn-primary disabled">Edit</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('users_delete'))
                                                        <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i>Delete</button>
                                                    @else
                                                        <button type="submit" class="btn btn-danger disabled">Delete</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $users->appends(request()->query())->links() }}
                            </div>
                            @else
                                <h2>{{__('site.no_data_found')}}</h2>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
