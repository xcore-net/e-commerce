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