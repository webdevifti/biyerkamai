<!DOCTYPE html>
<html>

<head>
    <title>Total collection</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <p>Total Collection: <strong>{{ $totalCollection }}</strong></p>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Who Added</th>
            <th>Guest Name</th>
            <th>Gift Type</th>
            <th>Amount</th>
            <th>Time</th>
        </tr>
        @foreach ($gifts as $key=>$item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ ($item->giftToUser ? $item->giftToUser->name : 'N/A') }}</td>
                <td>{{ $item->guest_name }}</td>
                <td>{{ $item->gift_type }}</td>
                <td>{{ $item->gift_amount }}</td>
                <td>{{ date('Y-d-m, H:i a', strtotime($item->created_at)) }}</td>
                
            </tr>
        @endforeach
    </table>

</body>

</html>
