<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ isset($product) ? 'Edit' : 'Create' }} Product</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container mt-5">
            <h2 class="text-center mb-4">{{ isset($product) ? 'Edit' : 'Create' }} Product</h2>

            <div class="row">
                <!-- Product Form -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ isset($product) ? 'Edit' : 'Create' }} Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($product))
                                @method('PUT')
                                @endif
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ isset($product) ? $product->title : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="desc">Description</label>
                                    <input type="text" name="desc" id="desc" class="form-control" value="{{ isset($product) ? $product->desc : '' }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" value="{{ isset($product) ? $product->price : '' }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="text" name="amount" id="amount" class="form-control" value="{{ isset($product) ? $product->amount : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" name="category" id="category" class="form-control" value="{{ isset($product) ? $product->category : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="img">Image</label>
                                    <input type="file" name="img" id="img" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Create' }} Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
</x-app-layout>