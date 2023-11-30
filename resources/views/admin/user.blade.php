@extends('admin.layout.master')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>User List</h4>
                    <h6>Manage your User</h6>
                </div>
                <div class="page-btn">
                    <a href="{{URL::to('registerpage')}}" class="btn btn-added"><img src="{{ 'admin/assets/img/icons/plus.svg' }}"
                            alt="img">Add User</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{ URL::to('admin/assets/img/icons/filter.svg') }}" alt="img">
                                    <span><img src="{{ 'admin/assets/img/icons/closes.svg' }}" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="{{ 'admin/assets/img/icons/search-white.svg' }}"
                                        alt="img"></a>
                            </div>
                        </div>
                        <div class="wordset">
                            <ul>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                            src="{{ URL::to('admin/assets/img/icons/pdf.svg') }}" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                            src="{{ URL::to('admin/assets/img/icons/excel.svg') }}" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                            src="{{ URL::to('admin/assets/img/icons/printer.svg') }}" alt="img"></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter User Name">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Phone">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" class="datetimepicker cal-icon" placeholder="Choose Date">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Disable</option>
                                            <option>Enable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                    <div class="form-group">
                                        <a class="btn btn-filters ms-auto"><img
                                                src="{{ URL::to('admin/assets/img/icons/search-whites.svg') }}"
                                                alt="img"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>User name </th>
                                    <th>Phone</th>
                                    <th>email</th>
                                    <th>gender</th>
                                    <th>image</th>
                                    {{-- <th>Created On</th> --}}
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $users)
                                    @if ($users->roll_id == '0')
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>
                                            {{ $users->name }}
                                        </td>
                                        <td>{{ $users->phone }} </td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="fb8f9394969a88bb9e839a968b979ed5989496">
                                                {{ $users->email }}</a>
                                        </td>
                                        <td>{{ $users->gender }}</td>
                                        <td>
                                            @if ($users->image)
                                            @foreach(explode(',',$users->image) as $key=>$value)
                                            @if($key=='0')
                                            <img src="{{ asset('images/' . $value) }}"
                                            style="height: 60px;width:100px;">
                                            @endif
                                            @endforeach
                                                 @else
                                                <span>No image found!</span>
                                            @endif
                                        </td>
                                        {{-- <td>3/15/2022</td> --}}
                                        <td>
                                            {{-- <input type="hidden" name="id" value="{{ $users->id }}"> --}}
                                            @if ($users->status == '0')
                                                {{-- <input type="hidden" name="id" value="{{ $users->id }}"> --}}
                                                <button data-id="{{ $users->id }}" id="approve"
                                                    class="btn btn-primary btn-sm text-white aprove">
                                                    Aprove
                                                </button>
                                            @else
                                            {{-- <input type="hidden" name="id" value="{{ $users->id }}"> --}}
                                              {{-- <a href="{{URL::to('DenyUser',$users->id)}}"> --}}
                                            <button data-id="{{$users->id}}" id="deny"
                                                    class="btn btn-danger btn-sm text-white">Deny</button>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{URL::to('editUser')}}" method="post">
                                                {{csrf_field()}}
                                                <input type="hidden" name="id" value="{{$users->id}}">
                                            <button  class="me-3 btn btn-sm edit">
                                                <img src="{{ URL::to('admin/assets/img/icons/edit.svg') }}" alt="img">
                                            </button>
                                            <a class="me-3 confirm-text" href="{{URL::to('deleteUser',$users->id)}}">
                                                <img src="{{ URL::to('admin/assets/img/icons/delete.svg') }}"
                                                    alt="img">
                                            </a>
                                        </form>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="jquery-3.7.1.min.js"></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#approve').on('click', function() {
                // var $btn = $(this);
                var id = $(this).data('id'); // it's a number like 6 or 7 or so on.
                // console.log(id);
                $.ajax({
                    type: 'get',
                    url: 'AproveUser',
                    data: {
                        'id': id
                    },
                    //  dataType: 'json',
                    success: function(response) {
                        location.reload();
                        //  $btn.prop('disabled', false);
                        console.log(111111);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#deny').on('click', function() {
                // var $btn = $(this);
                var id = $(this).data('id'); // it's a number like 6 or 7 or so on.
                // console.log(id);
                $.ajax({
                    type: 'get',
                    url: 'DenyUser',
                    data: {
                        'id': id
                    },
                    //  dataType: 'json',
                    success: function(response) {
                        location.reload();
                        //  $btn.prop('disabled', false);
                        console.log(111111);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });
            });
        });

    </script>
@endsection
