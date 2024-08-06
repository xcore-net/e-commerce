<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">{{ $store->name }}</h2>

        <!-- Store Details -->
        <div class="card mb-4">
            <div class="card-header">
                Store Details
            </div>
            <div class="card-body">
                <p><strong>Store Name:</strong> {{ $store->name }}</p>
                <p><strong>Location:</strong> {{ $store->location }}</p>
            </div>
        </div>

        <!-- Display Existing Products -->
        <div class="card mb-4">
            <div class="card-header">
                Existing Products
            </div>
            <div class="card-body">
                <ul class="list-group" id="existingProducts">
                    <!-- Loop through existing store products -->
                    @foreach($storeProducts as $storeProduct)
                        <li class="list-group-item">
                            {{ $storeProduct->title }} - {{ $storeProduct->pivot->quantity }} units - limit: {{ $storeProduct->pivot->limit }} units
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Add Product to Store -->
        <div class="card mb-4">
            <div class="card-header">
                Add Product to Store
            </div>
            <div class="card-body">
                <form id="addProductForm" action="{{ route('store.addProduct', ['id' => $store->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="Product">Select Product:</label>
                        <select name="product_id" id="Product" class="form-control">
                            <!-- Loop through possible products -->
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Quantity">Quantity:</label>
                        <input type="number" name="quantity" id="Quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="limit">Limit:</label>
                        <input type="number" name="limit" id="limit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Add Product</button>
                </form>
            </div>
        </div>
    </div>

  
</body>
</html>
