<x-app-layout>
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg" style="width:400px;margin-top:20px">
        <h1 class="text-3xl font-bold mb-4">{{ $product->title }}</h1>
        <img src="{{ $product->img }}" alt="{{ $product->title }}" class="w-full h-auto rounded-lg mb-4" />
        <p class="text-lg"><strong>Description:</strong> {{ $product->desc }}</p>
        <p class="text-lg"><strong>Amount:</strong> {{ $product->amount }}</p>
        <p class="text-lg"><strong>Price:</strong> ${{ $product->price }}</p>
        <p class="text-lg"><strong>Category:</strong> {{ $product->category }}</p>
<div style="border-radius:5px;border:1px solid gray;width:100px;background-color:rgba(128, 128, 128, 0.915);padding:4px">        <a href="{{ route('product.index') }}" class="btn btn-primary mt-4" style="">Back to Products</a>
</div>   
    </div>



    <form method="POST" action="{{ route('cart.add', ['product_id' => $product->id])}}" class="mt-6">
        @csrf
        <div class="mb-4" style="width:120px;margin:auto">
            <x-input-label for="amount" :value="__(' Enter Amount')" style="margin-left:20px" />
            <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="1" min="1" />
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>
        <div style="display: flex;margin-top:8px">
        <button style="margin:auto" type="submit" class="bg-orange-600 rounded px-4 py-2">Add to Cart</button>
        </div>
    </form>
</x-app-layout>