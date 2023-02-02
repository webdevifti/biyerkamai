@extends('master')
@section('title', 'Your all Users')
@section('style')
    <link rel="stylesheet" href="{{ asset('vendors/dataTable/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/dataTable/buttons.dataTables.min.css') }}">
@endsection
@section('content')
    <div id="layoutSidenav">
        @include('sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Users</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                            <div class="d-flex align-items-center justify-content-between">
                                <div><i class="fas fa-table me-1"></i>
                                    Your Total users: <strong>{{ $totalusers }}</strong></div>
                              
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a class="btn btn-success btn-sm" href="{{ route('user.create') }}">Add New User</a>
                                        @if ($data->count() > 0)
                                        <div class="dropdown">
                                            <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Export
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('user.data.export.pdf') }}">PDF</a>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                
                            </div>

                        </div>
                        <div class="card-body">
                            <table id="myTable">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Who Added</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Status</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            @php
                                                $getAddedUser = App\Models\User::where('added_by', $item->added_by)->first();
                                            @endphp
                                            <td>{{ $getAddedUser->name }}</td>
                                            <td>
                                                @if ($item->image)
                                                    <img width="100" src="{{ asset('uploads/users/'.$item->image) }}" alt="">
                                                @else
                                                @endif
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->user_type }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Banned</span>
                                                @endif
                                            </td>
                                            <td>{{ date('Y-d-m, H:i a', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('user.delete', encrypt($item->id)) }}"
                                                    onclick="return confirm('Are You Sure?')"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                <a href="{{ route('user.edit', encrypt($item->id)) }}"
                                                    class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
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
    <script src="{{ asset('vendors/dataTable/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('vendors/dataTable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/dataTable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/dataTable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/dataTable/jszip.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    {{-- <script src="{{ asset('vendors/dataTable/pdfmake.min.js') }}"></script> --}}
    <script src="{{ asset('vendors/dataTable/vfs_font.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                ]
            });
        });
    </script>
@endsection
