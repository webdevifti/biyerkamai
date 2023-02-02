@extends('master')
@section('title', 'Your all collections')
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
                    <h1 class="mt-4">Collections</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">collection</li>
                    </ol>
                    @if(Session()->has('success'))
                    <div class="alert alert-success">
                        {{ Session()->get('success') }}
                    </div>
                    @endif
                    @if(Session()->has('error'))
                    <div class="alert alert-danger">
                      {{ Session()->get('error') }}
                    </div>
                    @endif
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div><i class="fas fa-table me-1"></i>
                                    Your Total collection: <strong>{{ $totalCollection }}</strong></div>
                                    @if($data->count() > 0)
                                    <div>
                                        <div class="dropdown">
                                            <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                              Export
                                            </button>
                                            <ul class="dropdown-menu">
                                              <li><a class="dropdown-item" href="{{ route('data.export.pdf') }}">PDF</a></li>
                                            </ul>
                                          </div>
                                    </div>
                                    @endif
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <table id="myTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Who Added</th>
                                        <th>Guest Name</th>
                                        <th>Gift Type</th>
                                        <th>Amount</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                    @foreach ($data as $key=>$item)
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
                                        <td>
                                            <a href="{{ route('collection.delete', encrypt($item->id)) }}" onclick="return confirm('Are You Sure?')" class="btn btn-danger">Remove</a>
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
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ]
    } );
} );
</script>
@endsection
