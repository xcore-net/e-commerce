<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("This is product Page!") }}
                    <x-nav-link :href="route('product.create')">
                        {{ __('Create') }}
                    </x-nav-link>
                </div>
                <div class=" w-full">
                    <table class=" w-full table-auto text-left">
                        <thead>
                            <tr class="text-left">
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Price</th>
                                <th>image</th>
                                <th>Category</th>
                         
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->desc }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->img }}</td>
                                <td>{{ $product->category }}</td>    
                               <td>{{ $product->amount }}</td>
                                {{-- <td><select>
                                     @foreach ($form->fields as $field)
                                     <option value="{{ $field->id }}">{{ $field->label }}</option>
                                      @endforeach
                                    </select></td> --}}
                                    
                                <td>{{ $product->created_at }}</td>
                                <td>{{ $product->updated_at }}</td>
                                <td>
                                    {{-- <a href="{{ url('/product/' . $product->id) }}" class="btn btn-xs btn-info pull-right">View</a> --}}
                                    <a href="{{ url('/edit_product/' . $product->id ) }}" class="btn btn-xs btn-info pull-right">Edit</a>
                                    
                                    <!-- Delete Button -->

                                    <form method="POST" action="{{ route('product.destroy', $product->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="mt-4" onclick="return confirm('Are you sure you want to delete this product?');">
                                            {{ __('Delete product') }}
                                        </x-danger-button>
                                    </form>

                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td>no product</td>
                            </tr>
                            @endforelse


                        </tbody>
                    </table>



                </div>
            </div>
</x-app-layout>