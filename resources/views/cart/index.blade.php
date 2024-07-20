<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __(Str::ucfirst(Auth::user()->name).' Cart') }}

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                </div>
                <div class=" w-full">
                    <table class="w-full table-auto  text-white">
                        <thead>
                            <tr >
                                <th>Product</th>
                                <th>Price</th>
                                <th>amount</th>
                                <th>Category</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_price = 0
                            @endphp
                            @forelse ($products as $product)
                            <tr  >
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->pivot->amount }}</td>
                                <td>{{ $product->category }}</td>
                                <td>{{ $product->price*$product->pivot->amount }}</td>
                                @php
                                    $total_price += $product->price*$product->pivot->amount
                                @endphp
                                <td>
                                    
                                    <form method="POST" action="{{ route('cart.destroy', $product->pivot->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="mt-4" onclick="return confirm('Are you sure you want to delete this product?');">
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </form>

                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td>No Products</td>
                            </tr>
                            @endforelse


                        </tbody>
                    </table>

                <div class="p-6 text-white ">
                    <b>Total Price : </b>{{ $total_price }}
                </div>
                <div class="p-6 text-white ">
                    <form action="{{ route('order.add', ['products' => $products]) }}" method="POST">
                      @csrf
                      <button type="button" id="placeOrderButton" class="btn btn-primary">Place Order</button>
                    </form>
                  </div>
                  <script>
                  document.getElementById('placeOrderButton').addEventListener('click', function(event) {
                    if (!confirm('Are you sure you want to place this order?')) {
                      event.preventDefault(); // Prevent form submission if not confirmed
                    }
                  });</script>

                </div>
            </div>
</x-app-layout>