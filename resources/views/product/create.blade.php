<x-app-layout>
    <form style="width:400px;margin-left:600px"  method="POST" action="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}"  enctype="multipart/form-data">
        @csrf

        <!-- If editing, add method spoofing -->
        @if(isset($product))
        @method('POST')
        @endif
<h2 style="text-align:center;margin-top:40px"> CREATE PRODUCT</h2>
        <!-- Title -->
        <div >
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input class="form-control" id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', isset($product) ? $product->title : '')" required autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Description -->
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input class="form-control" id="description" class="block mt-1 w-full" type="text" name="desc" :value="old('description', isset($product) ? $product->description : '')" required autocomplete="description" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
               {{-- img --}}
               <div>
                <label for="img">Image</label>
                <input type="file" name="img" id="img" class="form-control" required>
            </div>
             {{-- price --}}
        <div>
            <x-input-label for="price" :value="__('price')" />
            <x-text-input class="form-control" id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price', isset($product) ? $product->price : '')" required autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        {{-- amount --}}
        <div>
            <x-input-label for="amount" :value="__('amount')" />
            <x-text-input class="form-control" id="amount" class="block mt-1 w-full" type="text" name="amount" :value="old('amount', isset($product) ? $product->amount : '')" required autocomplete="amount" />
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>

        {{-- category --}}

        <div>
            <x-input-label for="category" :value="__('category')" />
            <x-text-input class="form-control" id="category" class="block mt-1 w-full" type="text" name="category" :value="old('category', isset($product) ? $product->category : '')" required autocomplete="category" />
            <x-input-error :messages="$errors->get('category')" class="mt-2" />
        </div>




    {{-- <div>
        <x-input-label for="category" :value="__('category')" />
            <select name="category[]" class="bg-transparent" id="category" multiple>
              
                <option value="food">Food</option> // إضافة قيمة للخيار
                <option value="clothes">Clothes</option> // إضافة قيمة للخيار
             
            </select>
        </div> --}}


        {{-- update/create button --}}
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ isset($product) ? __('Update') : __('Create') }}
            </x-primary-button>
        </div>
    </form>


    <!-- Delete Button -->
    @if(isset($product))
    <form style="margin-left:900px" method="POST" action="{{ route('product.destroy', $product->id) }}">
        @csrf
        @method('DELETE')
        <x-danger-button class="mt-4" onclick="return confirm('Are you sure you want to delete this product?');">
            {{ __('Delete product') }}
        </x-danger-button>
    </form>
    @endif
</x-app-layout>