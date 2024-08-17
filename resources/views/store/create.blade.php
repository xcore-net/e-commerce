<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Store</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container mt-5">
            <h2 class="text-center mb-4">Add Store</h2>
            <div class="card mb-4">
                <div class="card-header">
                    Store Details
                </div>
                <div class="card-body">
                    <form action="{{ route('store.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="Name">Store Name:</label>
                            <input type="text" name="name" id="Name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="Location">Location:</label>
                            <input type="text" name="location" id="Location" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Add Store</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
</x-app-layout>