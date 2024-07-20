<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Orders

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                </div>
                <div class=" w-full">
                    <table>
                        <thead>
                          <tr>
                            <th>Order ID,User ID</th>
                            <th>Products</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                          <tr>
                            @php
                                $user = App\Models\User::where('id',$order->user_id)->first()
                            @endphp
                            <td>{{ $order->id }} , {{ $user->name }}</td>
                            <td>
                              <table>
                                <thead>
                                  <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($order->product as $product)
                                  <tr>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->amount }}</td>
                                  </tr>
                                @endforeach
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                      
               

                </div>
            </div>
</x-app-layout>