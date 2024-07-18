<x-app-layout>
    <form method="POST" action="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}">
        @csrf

        <!-- If editing, add method spoofing -->
        @if(isset($product))
        @method('POST')
        @endif

        <!-- Title -->
        <div>
            <x-input-label for="product-name" :value="__('Title')" />
            <x-text-input id="product-title" class="block mt-1 w-full" type="text" name="title" :value="old('title', isset($product) ? $product->title : '')" required autofocus  />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- description -->
        <div>
            <x-input-label for="product-description" :value="__('description')" />
            <x-text-input id="product-description" class="block mt-1 w-full" type="text" name="description" :value="old('description', isset($product) ? $product->description : '')" required  />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        
         <!-- price -->
         <div>
            <x-input-label for="product-price" :value="__('Price')" />
            <x-text-input id="product-price" class="block mt-1 w-full" type="text" name="price" :value="old('price', isset($product) ? $product->price : '')" required  />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

         <!-- image -->
         <div>
            <x-input-label for="product-image" :value="__('Image')" />
            <x-text-input id="product-image" class="block mt-1 w-full" type="text" name="image" :value="old('image', isset($product) ? $product->image : '')" required  />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

         <!-- amount -->
         <div>
            <x-input-label for="product-amount" :value="__('Amount')" />
            <x-text-input id="product-amount" class="block mt-1 w-full" type="text" name="amount" :value="old('amount', isset($product) ? $product->amount : '')" required  />
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>

         <!-- category -->
         <div>
            <x-input-label for="product-category" :value="__('Category')" />
            <x-text-input id="product-category" class="block mt-1 w-full" type="text" name="category" :value="old('category', isset($product) ? $product->category : '')" required  />
            <x-input-error :messages="$errors->get('category')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ isset($product) ? __('Update') : __('Create') }}
            </x-primary-button>
        </div>
    </form>
    <!-- Delete Button -->
    @if(isset($product))
    <form method="POST" action="{{ route('product.destroy', $product->id) }}">
        @csrf
        @method('DELETE')
        <x-danger-button class="mt-4" onclick="return confirm('Are you sure you want to delete this product?');">
            {{ __('Delete') }}
        </x-danger-button>
    </form>
    @endif
</x-app-layout>