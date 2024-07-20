<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$product->name}} Details</title>
     <style>
    body {
      font-family: sans-serif;
      margin: 0;
      padding: 20px;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      max-width: 900px;
      margin: 0 auto;
    }

    .product-image {
      width: 50%;
      padding: 20px;
    }

    .product-image img {
      width: 100%;
      object-fit: cover;
    }

    .product-details {
      width: 50%;
      padding: 20px;
    }

    .product-details h1 {
      font-size: 2em;
      margin-bottom: 10px;
    }

    .price {
      font-weight: bold;
      margin-bottom: 15px;
    }

    .description {
      margin-bottom: 20px;
    }

    button {
      background-color: #333;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    button:hover {
      background-color: #444;
    }

    /* Add media queries for responsive design (optional) */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }
      .product-image, .product-details {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="product-image">
      <img src={{  $product->image }} alt="{{$product->name}}">
    </div>
    <div class="product-details">
      <h1>{{$product->name}}</h1>
      <p class="price">${{$product->price}}</p>
      <div class="description">
        {{ $product->description }}  </div>
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <label for="amount">Quantity:</label>
            <input type="number" id="amount" name="amount" min="1" value="1">
            <button type="submit">Add to Cart</button>
          </form>
    </div>
  </div>

  </body>
</html>