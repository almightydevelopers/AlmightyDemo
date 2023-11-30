@extends('admin.layout.master')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>User Management</h4>
                    <h6>Add/Update User</h6>
                </div>
            </div>
            <form action="{{ URL::to('updateUser') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$UpdateDetails->id}}">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                @endif --}}
                {{-- @foreach ($UpdateDetails as $user) --}}

                {{-- @endforeach --}}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" value="{{$UpdateDetails->name}}">
                                    @if ($errors->has('name'))
                                    <div class="error text-danger">{{ $errors->first('name') }}</div>
                                @endif

                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{$UpdateDetails->email}}">
                                    @if ($errors->has('email'))
                                    <div class="error text-danger">{{ $errors->first('email') }}</div>
                                @endif
                                </div>
                            </div>
                            {{-- <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" class=" pass-input" name="password">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                    @if ($errors->has('password'))
                                        <div class="error text-danger">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Confirm-Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-input" name="cpassword">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                    @if ($errors->has('cpassword'))
                                        <div class="error text-danger">{{ $errors->first('cpassword') }}</div>
                                    @endif
                                </div>
                            </div> --}}
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="{{$UpdateDetails->phone}}">
                                </div>
                                @if ($errors->has('phone'))
                                    <div class="error text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="col-lg-9 col-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" value="{{$UpdateDetails->address}}">
                                </div>
                                @if ($errors->has('address'))
                                    <div class="error text-danger">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2" for="gebder">Gender</label>
                                <div class="col-md-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" value="male" {{ $UpdateDetails->gender == "male" ? 'checked' : '' }}> Male
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" value="female" {{ $UpdateDetails->gender == "female" ? 'checked' : '' }}> Female
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" value="other" {{ $UpdateDetails->gender == "other" ? 'checked' : '' }}> Other
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('gender'))
                                    <div class="error text-danger">{{ $errors->first('gender') }}</div>
                                @endif
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label> User Image</label>
                                    <div class="image-upload">

                                        <input type="file" name="image[]" value="{{$UpdateDetails->image}}" multiple>
                                        <div class="image-uploads">
                                            <img src="{{ URL::to('admin/assets/img/icons/upload.svg') }}" alt="img">
                                            <h4>Drag and drop a file to upload </h4>
                                        </div>
                                    </div>
                                    @if ($errors->has('image'))
                                        <div class="error text-danger">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                                @foreach(explode(',',$UpdateDetails->image) as $value)
                                <input type="hidden" name="images[]" value="{{$value}}" multiple>
                                <img src="{{ asset('images/'.$value) }}" style="height: 150px;width:200px;">
                                @endforeach
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2">Update</button>
                                <a href="{{URL::to('userlist')}}" class="btn btn-cancel">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
