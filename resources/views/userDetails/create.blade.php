<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($userDetail) ? 'Edit' : 'Create' }} User Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">{{ isset($userDetail) ? 'Edit' : 'Create' }} User Details</h2>
        
        <div class="row">
            <!-- User Details Form -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ isset($userDetail) ? 'Edit' : 'Create' }} User Details</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($userDetail) ? route('userDetails.update', $userDetail->id) : route('userDetails.store') }}" method="POST">
                            @csrf
                            @if(isset($userDetail))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ isset($userDetail) ? $userDetail->phone : '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ isset($userDetail) ? $userDetail->address : '' }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="pay_type">Payment Type</label>
                                <select name="pay_type" id="pay_type" class="form-control" required>
                                    <option value="visa" {{ isset($userDetail) && $userDetail->billing->type == 'visa' ? 'selected' : '' }}>Visa</option>
                                    <option value="paypal" {{ isset($userDetail) && $userDetail->billing->type == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="card_number">Card Number</label>
                                <input type="text" name="card_number" id="card_number" class="form-control" value="{{ isset($userDetail) ? $userDetail->billing->number : '' }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ isset($userDetail) ? 'Update' : 'Create' }} User Details</button>
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
