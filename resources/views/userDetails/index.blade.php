<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">User Details</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('userDetails.create') }}" class="btn btn-primary">Create New User Details</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>User ID</th>
                    <th>Billing ID</th>
                    <th>Billing Type</th>
                    <th>Billing Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userDetails as $detail)
                    <tr>
                        <td>{{ $detail->id }}</td>
                        <td>{{ $detail->phone }}</td>
                        <td>{{ $detail->address }}</td>
                        <td>{{ $detail->user_id }}</td>
                        <td>{{ $detail->billing_id }}</td>
                        <td>{{ $detail->billing_type }}</td>
                        <td>{{ $detail->billing_number }}</td>
                        <td>
                            <a href="{{ route('userDetails.edit', $detail->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('userDetails.destroy', $detail->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
