@extends('master')
@section('title', 'Add your collection')
@section('content')
        <div id="layoutSidenav">
           @include('sidenav')
           <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                 
                    <h1 class="mt-4">Collections</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">add collection</li>
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
                            <i class="fas fa-table me-1"></i>
                           Add your collection data
                        </div>
                        <div class="card-body">
                           <form action="{{ route('collection.store') }}" method="POST">
                            @csrf
                            <div class="mb-2">
                                <label for="">Guest Name</label>
                                <input type="text" autofocus placeholder="Guest Name" name="guest_name" class="form-control @error('guest_name') is-invalid @enderror">
                                @error('guest_name') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-2">
                                <label for="">Guest Address (Optional)</label>
                                <input type="text" placeholder="Guest Address" name="guest_address" class="form-control">
                                
                            </div>
                            <div class="mb-2">
                                <label for="">Gift Type</label>
                                <select name="gift_type" class="form-control" onchange="getGiftType(this.value)">
                                    <option value="">-- select gift type--</option>
                                    <option value="gift">Gift</option>
                                    <option value="cash">Cash</option>
                                </select>
                                @error('gift_type') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-2" id="cashDiv">
                                <label for="">Amount in Cash</label>
                                <input type="text" placeholder="Amount in Cash" name="gift_amount" class="form-control @error('gift_amount') is-invalid @enderror">
                                @error('gift_amount') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-2">
                                <button type="submit" class="btn btn-success">Collect</button>
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
            function getGiftType(val){
                var d = document.getElementById('cashDiv');
                if(val == 'gift'){
                    d.style.display = 'none';
                }else{
                    d.style.display = 'block';
                }
            }
        </script>
@endsection