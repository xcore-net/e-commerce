{{-- <x-app-layout>

  @foreach ($orders as $order)
      <h3>Order ID: {{ $order->id }}</h3>
      <h3>Total: {{ $order->total }}</h3>
      
    
      <ul>
          @foreach ($order->product as $orderProduct)
              <li>
                  Product: {{ $orderProduct->title }} 
                  Price: {{ $orderProduct->price }}  
                  Quantity: {{ $orderProduct->amount }}
              </li>
          @endforeach
      </ul>
  @endforeach
  
  </x-app-layout> --}}

  <x-app-layout>
<h2 style="text-align: center;margin-bottom:20px">YOUR ORDER</h2>
    @foreach ($orders as $order)
        <div class="order-card mb-4 p-3 border rounded" style="border:2px solid gray;width:300px;margin:auto;margin-bottom:10px" >
            <span style="text-align: center" class="text-primary">Order# : {{ $order->id }}</span>
            <span style="text-align: center" class="text-success">-Total: ${{ number_format($order->total) }}</span>
            
            <ul class="list-group" style="margin-top: 10px">
                @foreach ($order->product as $orderProduct)
                    <li class="list-group-item" style="text-align: center">
                        <p style="width:100;height:100px">{{ $orderProduct->img }}</p> <br>

                        <strong>Product:</strong> {{ $orderProduct->title }} <br>
                        <strong>description:</strong> {{ $orderProduct->desc }} <br>
                        <strong>Category:</strong> {{ $orderProduct->category }} <br>


                        <strong>Price:</strong> ${{ number_format($orderProduct->price) }} <br>
                        <strong>Amount:</strong> {{ $orderProduct->amount }}
                        
                    </li>
                @endforeach

                {{-- @foreach($carts as $cart)
                <strong>Amount:</strong> {{ $carts->amount }}
                @endforeach --}}

            </ul>
        </div>
    @endforeach
    
  </x-app-layout>