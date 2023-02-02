@extends('master')
@section('title', 'Edit Users')

@section('content')
    <div id="layoutSidenav">
        @include('sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Users Update</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users Update</li>
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
                            <form action="{{ route('user.update', encrypt($user->id)) }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <label for=""> Name</label>
                                    <input type="text" value="{{ $user->name }}" placeholder="Full Name" name="name" class="form-control @error('name') is-invalid @enderror">
                                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-2">
                                    <label for="">Email</label>
                                    <input type="email" value="{{ $user->email }}" placeholder="Email Address" name="email" class="form-control @error('email') is-invalid @enderror">
                                    @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                {{-- <div class="mb-2">
                                    <label for="">Create Password</label>
                                    <input type="password" placeholder="Password for login" name="password" class="form-control @error('password') is-invalid @enderror">
                                    @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                                </div> --}}
                              
                                <div class="mb-2">
                                    <label for="">Phone Number</label>
                                    <input type="text" value="{{ $user->phone_number }}" placeholder="Phone Number" name="phone" class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="mb-2">
                                    <label for="">Photo</label>
                                    <input type="file"  name="photo" class="form-control @error('photo') is-invalid @enderror">
                                    @error('photo') <span class="text-danger">{{ $message }}</span>@enderror
                                    <img src="{{ asset('uploads/users/'.$user->image) }}" width="100" alt="">
                                </div>
                              
                                <div class="mb-2">
                                    <label for="">User Type</label>
                                    <select name="user_type" class="form-control" >
                                        <option value="">-- select user type--</option>
                                        <option {{ ($user->user_type == 'admin' ? 'selected':'') }} value="admin">Admin</option>
                                        <option {{ ($user->user_type == 'normal' ? 'selected':'') }}  value="normal">Normal</option>
                                    </select>
                                    @error('user_type') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                               
                                <div class="mb-2">
                                    <button type="submit" class="btn btn-success">Save Changes</button>
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

