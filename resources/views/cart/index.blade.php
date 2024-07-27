<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/cart">
                        <img src="https://img.icons8.com/ios-filled/50/000000/shopping-cart.png" alt="Cart" style="width: 24px; height: 24px;">
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('cart.checkout') }}" method="POST" class="form-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Checkout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">

        <h2 class="text-center mb-4">Cart</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartsWithProducts as $cart)
                <tr>
                    <td>{{ $cart->id }}</td>
                    <td>{{ $cart->title }}</td>
                    <td>{{ $cart->price }}</td>
                    <td>{{ $cart->category }}</td>
                    <td>{{ $cart->amount }}</td>
                    <td>
                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
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