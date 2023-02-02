<!DOCTYPE html>
<html>

<head>
    <title>All users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style>
            table tr th{
                font-size: 12px;
            }
            table tr td{
                font-size: 10px;
            }
        </style>
</head>

<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <p>Total users: <strong>{{ $totalusers }}</strong></p>

    <table class="table table-bordered">
        <tr>
            <th>Sl</th>
            <th>Who Added</th>
            <th>Name</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Status</th>
            <th>Time</th>
        </tr>
        @foreach ($users as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                @php
                    $getAddedUser = App\Models\User::where('added_by', $item->added_by)->first();
                @endphp
                <td>{{ $getAddedUser->name }}</td>
               
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
               
            </tr>
        @endforeach
    </table>

</body>

</html>
