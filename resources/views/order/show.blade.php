<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Order Details</h2>
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
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="img-fluid">
                                </div>
                                <div class="col-md-10">
                                    <strong>{{ $product->title }}</strong><br>
                                    Price: ${{ $product->pivot->price }}<br>
                                    Amount: {{ $product->pivot->amount }}<br>
                                    Category: {{ $product->category }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                @if($order->payment_id)
                    <h4 class="mt-4">Payment Details</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Payment ID:</strong> {{ $payment->id }}<br>
                            <strong>Amount:</strong> ${{ $payment->amount }}<br>
                            <strong>Method:</strong> {{ ucfirst($payment->method) }}<br>
                            <strong>Date:</strong> {{ $payment->created_at->format('Y-m-d H:i:s') }}
                        </li>
                    </ul>
                @else
                    <h4 class="mt-4">Payment Methods</h4>
                    <form action="{{ route('order.pay', $order->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="method">Select Payment Method:</label>
                            <select name="method" id="method" class="form-control">
                                @foreach($methods as $method)
                                    <option value="{{ $method }}">{{ ucfirst($method) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Pay Now</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
