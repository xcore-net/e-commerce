<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Your Orders</h2>
        @foreach($orders as $order)
        <div class="card mb-4">
            <div class="card-header">
                Order #{{ $order->id }} - Total Price: ${{ $order->total_price }}
                <span class="badge badge-{{ $order->payment_id ? 'success' : 'danger' }} float-right">
                    {{ $order->payment_id ? 'Paid' : 'Unpaid' }}
                </span>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($order->products as $product)
                    <li class="list-group-item">
                        <strong>{{ $product->title }}</strong><br>
                        Price: ${{ $product->pivot->price }}<br>
                        Amount: {{ $product->pivot->amount }}<br>
                        Category: {{ $product->category }}
                    </li>
                    @endforeach
                </ul>
                <form action="{{ route('order.show', $order->id) }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-primary mt-3 float-right">Details</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>