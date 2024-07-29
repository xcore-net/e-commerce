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
                    <table class=" w-full table-auto">
                        <thead>
                            <tr >
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Price</th>
                                <th>image</th>
                                <th>Category</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr class="text-right ">
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->desc }}</td>
                                <td>{{ $product->amount }}</td>
                                <td>{{ $product->price }}</td>               
                                {{-- <td>{{ $product->img }}</td> --}}
                               
                                 <td>
                                 <img style="width:50px;height:50px" src={{ asset('storage/'.($product->img)) }} alt="img">
                                </td>
                                <td>{{ $product->category }}</td>    
                                <td>{{ $product->created_at }}</td>
                                <td>{{ $product->updated_at }}</td>
                                <td>
                                    {{-- <a href="{{ url('/product/' . $product->id) }}" class="btn btn-xs btn-info pull-right">View</a> --}}
                                    {{-- <a href="{{ url('/edit_product/' . $product->id ) }}" class="btn btn-xs btn-info pull-right">Edit</a> --}}
                                    
                                 {{-- edit button --}}
                                    <form method="GET" action="{{ route('product.edit', $product->id) }}">
                                        @csrf
                                      
                                        <x-danger-button class="mt-4 mx-5">
                                            {{ __('edit product') }}
                                        </x-danger-button>
                                    </form>
                                    <!-- Delete Button -->

                                    <form method="POST" action="{{ route('product.destroy', $product->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="mt-4 mx-2" onclick="return confirm('Are you sure you want to delete this product?');">
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