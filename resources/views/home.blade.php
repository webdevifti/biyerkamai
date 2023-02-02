@extends('master')
@section('title', 'Welcome to Dashboard')
@section('content')
        <div id="layoutSidenav">
           @include('sidenav')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        Total Collections
                                        <span class="badge bg-danger">{{ $total_collection }}</span>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('collection.index') }}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">
                                        Total Users
                                        <span class="badge bg-danger">{{ $total_users }}</span>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('user.index') }}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                        @if($maximum_collections->count() > 0)
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Maximum Collection Given By Guest

                                <a href="{{ route('collection.index') }}" class="btn btn-info btn-sm">View All</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Who Added</th>
                                            <th>Guest Name</th>
                                            <th>Gift Type</th>
                                            <th>Amount</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($maximum_collections as $key=>$item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ ($item->giftToUser ? $item->giftToUser->name : 'N/A') }}</td>
                                            <td>{{ $item->guest_name }}</td>
                                            <td>
                                                @if($item->gift_type == 'cash')
                                                <span class="badge bg-success">{{ $item->gift_type }}</span>
                                                @else 
                                                <span class="badge bg-danger">{{ $item->gift_type }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->gift_amount }}</td>
                                            <td>{{ date('Y-d-m, H:i a', strtotime($item->created_at)) }}</td>
                                           
                                        </tr>
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
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