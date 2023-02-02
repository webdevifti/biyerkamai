@extends('master')
@section('title', 'Create Users')
@section('style')
    <style>
        #basic-addon1 {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div id="layoutSidenav">
        @include('sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Users Create</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users Create</li>
                    </ol>
                    @if (Session()->has('success'))
                        <div class="alert alert-success">
                            {{ Session()->get('success') }}
                        </div>
                    @endif
                    @if (Session()->has('error'))
                        <div class="alert alert-danger">
                            {{ Session()->get('error') }}
                        </div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-header">


                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.store') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <label for=""> Name</label>
                                    <input type="text" value="{{ old('name') }}" placeholder="Full Name" name="name"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="">Email</label>
                                    <input type="email" value="{{ old('email') }}" placeholder="Email Address"
                                        name="email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">show</span>
                                    <input type="password" id="passwordField" placeholder="Password for login"
                                        name="password" class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="mb-2">
                                    <label for="">Phone Number</label>
                                    <input type="text" value="{{ old('phone') }}" placeholder="Phone Number"
                                        name="phone" class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="">Photo</label>
                                    <input type="file" name="photo"
                                        class="form-control @error('photo') is-invalid @enderror">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="">User Type</label>
                                    <select name="user_type" class="form-control">
                                        <option value="">-- select user type--</option>
                                        <option value="admin">Admin</option>
                                        <option value="normal">Normal</option>
                                    </select>
                                    @error('user_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; webdevifti {{ date('Y') }}</div>

                    </div>
                </div>
            </footer>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        var clickButton = document.getElementById('basic-addon1');
        var passwordField = document.getElementById('passwordField');
        if (passwordField.type == 'password') {
            clickButton.addEventListener('click', function() {
                if (passwordField.type == 'password') {
                    passwordField.type = 'text';
                    clickButton.innerHTML = 'hide';
                } else {
                    passwordField.type = 'password';
                    clickButton.innerHTML = 'show';
                }

            });
        }
    </script>
@endsection
