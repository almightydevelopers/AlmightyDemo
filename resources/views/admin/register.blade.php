@extends('admin.layout.master')
@section('content')
    <style>
        .img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            margin: 0 1rem;
        }

        img:hover {
            cursor: pointer;
        }
    </style>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>User Management</h4>
                    <h6>Add/Update User</h6>
                </div>
            </div>
            <form action="{{ URL::to('adduser') }}" method="post"  id="form" enctype="multipart/form-data">
                @csrf
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
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <div class="error text-danger">{{ $errors->first('name') }}</div>
                                    @endif

                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <div class="error text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" class=" pass-input" name="password"
                                            value="{{ old('password') }}">
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
                                        <input type="password" class="pass-input" name="cpassword"
                                            value="{{ old('cpassword') }}">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                    @if ($errors->has('cpassword'))
                                        <div class="error text-danger">{{ $errors->first('cpassword') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}">
                                </div>
                                @if ($errors->has('phone'))
                                    <div class="error text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="col-lg-9 col-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" value="{{ old('address') }}">
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
                                            <input type="radio" name="gender" value="male"
                                                value="{{ old('gender') }}"> Male
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" value="female"
                                                value="{{ old('gender') }}"> Female
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" value="other"
                                                value="{{ old('gender') }}"> Other
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
                                        <input type="file" name="image[]" id="choose-files" value="{{ old('image') }}"
                                            multiple>
                                        <div class="image-uploads">
                                            <img src="{{ URL::to('admin/assets/img/icons/upload.svg') }}" alt="img">
                                            <h4>Drag and drop a file to upload</h4>
                                        </div>
                                    </div>
                                    @if ($errors->has('image'))
                                        <div class="error text-danger">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <div class="mt-1 text-center">
                                        <div id="preview-wrapper"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2" name="submit" id="submit">Submit</button>
                                <a href="{{ URL::to('userlist') }}" class="btn btn-cancel">Back</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script type="text/javascript">

    let chooseFiles = document.getElementById("choose-files");
    let previewWrapper = document.getElementById("preview-wrapper");
    let form = document.getElementById('form');

    // form.addEventListener('submit', (e) => {
    //     const fd = new FormData();

    //     e.preventDefault();

    //     for (const file of chooseFiles.files) {
    //         fd.append('choose-files[]', file, file.name)
    //     }

        // You can POST this to the server with fetch like
        // fetch(url, { method: 'POST', body: fd })
        // console.log('submit', Array.from(fd.values()));
    // });
    chooseFiles.addEventListener("change", (e) => {
        [...e.target.files].forEach(showFiles);
    });

    function showFiles(file) {
        let previewImage = new Image();

        previewImage.dataset.name = file.name;
        previewImage.classList.add("img");
        previewImage.src = URL.createObjectURL(file);

        previewWrapper.append(previewImage); // append preview image

        // -- remove the image preview visually
        document.querySelectorAll(".img").forEach((i) => {
            i.addEventListener("click", (e) => {
                const transfer = new DataTransfer();
                const name = e.target.dataset.name;

                for (const file of chooseFiles.files) {
                    if (file.name !== name) {
                        transfer.items.add(file);
                    }
                }

                chooseFiles.files = transfer.files;
                e.target.remove();
            });
        });
    }
</script>


@endsection
