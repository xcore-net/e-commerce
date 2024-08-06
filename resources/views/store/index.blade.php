<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stores</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Stores</h2>
        <div class="card mb-4">
            <div class="card-header">
                Store List
                <a href="{{ route('store.create') }}" class="btn btn-primary float-right">Add Store</a>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($stores as $store)
                        <li class="list-group-item">
                            <strong>{{ $store->Name }}</strong><br>
                            Location: {{ $store->Location }}<br>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
