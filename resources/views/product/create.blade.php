<x-app-layout>
    <form  method="POST" action="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}">
        @csrf

        <!-- If editing, add method spoofing -->
        @if(isset($product))
        @method('POST')
        @endif

        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', isset($product) ? $product->title : '')" required autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Description -->
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="desc" :value="old('description', isset($product) ? $product->description : '')" required autocomplete="description" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
               {{-- img --}}
        <div>
            <x-input-label for="img" :value="__('image')" />
            <x-text-input id="img" class="block mt-1 w-full" type="text" name="img" :value="old('img', isset($product) ? $product->img : '')" required autocomplete="img" />
            <x-input-error :messages="$errors->get('img')" class="mt-2" />
        </div>

             {{-- price --}}
        <div>
            <x-input-label for="price" :value="__('price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price', isset($product) ? $product->price : '')" required autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        {{-- amount --}}
        <div>
            <x-input-label for="amount" :value="__('amount')" />
            <x-text-input id="amount" class="block mt-1 w-full" type="text" name="amount" :value="old('amount', isset($product) ? $product->amount : '')" required autocomplete="amount" />
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>

        {{-- category --}}

        <div>
            <x-input-label for="category" :value="__('category')" />
            <x-text-input id="category" class="block mt-1 w-full" type="text" name="category" :value="old('category', isset($product) ? $product->category : '')" required autocomplete="category" />
            <x-input-error :messages="$errors->get('category')" class="mt-2" />
        </div>




        {{-- <div>
        <x-input-label for="price" :value="__('price')" />
            <select name="fields[]" class="bg-transparent" id="form-fields" multiple>
                @foreach ($fields as $field)
                    <option class="text-white" value="{{ $field->id }}">{{ $field->label }}</option>
                @endforeach
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
    <form method="POST" action="{{ route('product.destroy', $product->id) }}">
        @csrf
        @method('DELETE')
        <x-danger-button class="mt-4" onclick="return confirm('Are you sure you want to delete this product?');">
            {{ __('Delete product') }}
        </x-danger-button>
    </form>
    @endif
</x-app-layout>