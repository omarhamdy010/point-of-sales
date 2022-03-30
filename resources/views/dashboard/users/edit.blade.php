@extends('layouts.dashboard.app')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{__('site.edit_user')}}</h3>
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
        <section class="content" id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card navbar-light bg-light">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" action="{{route('users.update',$user->id)}}"
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">First Name</label>
                                                <input type="text" value="{{$user->first_name}}" id="first-name-column"
                                                       class="form-control"
                                                       placeholder="First Name" name="first_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column">Last Name</label>
                                                <input type="text" id="last-name-column" class="form-control"
                                                       placeholder="Last Name" value="{{$user->last_name}}"
                                                       name="last_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Email</label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                       name="email" value="{{$user->email}}" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="mobile-id-icon">Mobile</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="phone"
                                                           placeholder="Mobile" value="{{$user->phone}}"
                                                           id="mobile-id-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-phone"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="password-id-icon">Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control" name="password"
                                                           placeholder="Password" id="password-id-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group has-icon-left">
                                                <label for="password-id-icon">Password confirm</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control"
                                                           name="password_confirmation"
                                                           placeholder="Confirm Password" id="password-id-icon">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-lock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label"> image </label>
                                            <input class="form-control" type="file" name="image" accept="image/*" id="formFile" onchange="loadFile(event)">
                                            <img id="output" style="margin-top: 20px ; height: 200px;width: 200px" src="{{$user->image_path}}" />
                                        </div>
                                        @php
                                            $roles = ['users','categories','products'];
                                                $permissions = ['create','update','delete','read'];
                                        @endphp
                                        <div class="card-header">
                                            <h5 class="card-title">{{__('site.permissions')}}</h5>
                                        </div>

                                        <div class="card-body">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                @foreach($roles as $index=>$role)
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link {{$loop->first?'active':''}}" id="{{$role}}-tab"
                                                           data-bs-toggle="tab" href="#{{$role}}"
                                                           role="tab" aria-controls="{{$role}}"
                                                           aria-selected="true">{{$role}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                @foreach($roles as $index=>$role)
                                                    <div class="tab-pane fade show {{$loop->first ? 'active':''}}"
                                                         id="{{$role}}" role="tabpanel"
                                                         aria-labelledby="{{$role}}-tab">
                                                        @foreach($permissions as $permission)
                                                            <label style="cursor: pointer" class="form-control"><input
                                                                    class="form-check-success" name="permissions[]"
                                                                    value="{{$role}}_{{$permission}}"
                                                                    {{$user->hasPermission($role.'_'.$permission) ?'checked':''}}
                                                                    type="checkbox">{{__('site.'.$permission)}}
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
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
