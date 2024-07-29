{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('carts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('This is carts Page!') }}

                </div>
                <div class=" w-full">
                    <table class=" w-full table-auto">
                        <thead>
                            <tr>
                                <th>ID</th>

                                <th>amount</th>
                                <th>title</th>
                                <th>price</th>

                                <th>total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_price = 0;
                            @endphp
                            {{-- {{   dd($products);}} --}}
                            {{-- @forelse ($products as $product)
                                <tr class="text-center ">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->amount }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->price * $product->amount }}</td>
                                    @php
                                        $total_price += $product->price * $product->amount;
                                    @endphp
                                    <td> --}}
                                        {{-- <a href="{{ url('/product/' . $product->id) }}" class="btn btn-xs btn-info pull-right">View</a> --}}
                                        {{-- <a href="{{ url('/edit_product/' . $product->id ) }}" class="btn btn-xs btn-info pull-right">Edit</a> --}}

                                        {{-- edit button --}}
                                        {{-- <form method="GET" action="{{ route('product.edit', $product->id) }}">
                                        @csrf
                                      
                                        <x-danger-button class="mt-4 mx-5">
                                            {{ __('edit product') }}
                                        </x-danger-button>
                                    </form> --}}
                                        <!-- Delete Button -->

                                        {{-- <form method="POST" action="{{ route('cart.destroy', $product->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button class="mt-4 mx-2"
                                                onclick="return confirm('Are you sure you want to delete this cart?');">
                                                {{ __('Delete cart') }}
                                            </x-danger-button>
                                        </form>

                                    </td>
                                </tr>
                                <div class="p-6">
                                    <b>Total Price : </b>{{ $total_price }}
                                </div>
                            @empty
                                <tr>
                                    <td>no cart</td>
                                </tr>
                            @endforelse


                            <form method="POST" action="{{ route('order.add') }}">
                                @csrf
                              
                                <button class="mt-4 mx-2">
                                    
                                    {{ __('order ') }}
                                </button>
                            </form>

                        </tbody>
                    </table>



                </div>
            </div>
</x-app-layout> --}} 


<!-- resources/views/carts.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Carts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('This is the Carts Page!') }}
                </div>
                <div class="w-full">
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Amount</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_price = 0;
                            @endphp
                            @forelse ($products as $product)
                                <tr class="text-center">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->amount }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->price * $product->amount }}</td>
                                    @php
                                        $total_price += $product->price * $product->amount;
                                    @endphp
                                    <td>
                                        <!-- Delete Button -->
                                        <form method="POST" action="{{ route('cart.destroy', $product->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button class="mt-4 mx-2"
                                                onclick="return confirm('Are you sure you want to delete this cart?');">
                                                {{ __('Delete cart') }}
                                            </x-danger-button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('order.add', $product->id) }}">
                                            @csrf
                                         
                                            <x-danger-button class="mt-4 mx-2">
                                                {{ __('Order') }}
                                            </x-danger-button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No items in the cart.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="p-6">
                        <b>Total Price: </b>{{ $total_price }}
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</x-app-layout>

