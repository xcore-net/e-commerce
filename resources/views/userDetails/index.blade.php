{{-- <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('User Details') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
            </div>
            <div class=" w-full">
                <b>User Name :</b>  {{ $user->name ?? 'Not Found' }}<br>
                <b>Email : </b>  {{ $user->email ?? 'Not Found' }}<br>
                <b>Phone : </b>  {{ $user->userdetails->phone ?? 'Not Found' }}<br>
                <b>Address : </b> {{ $user->userdetails->address ?? 'Not Found' }}<br>
                <b>Credit Card : </b> {{ $billing->type ?? 'Not Found' }}<br>
                <b>Credit Number : </b> {{ $billing->number ?? 'Not Found' }}<br>


            </div>
        </div>

        <form method="GET" action="{{ route('userDetails.edit') }}">
            <x-primary-button class="mt-4">
                {{ __('edit Details') }}
            </x-primary-button>
        </form>
        @if (isset($user->userdetails))
        <form method="POST" action="{{ route('userDetails.destroy', [$user->userdetails,$billing]) }}">
            @csrf
            @method('DELETE')
            <x-danger-button class="mt-4" onclick="return confirm('Are you sure you want to delete these details?');">
                {{ __('Delete Details') }}
            </x-danger-button>
        </form>
        @else
        <form method="GET" action="{{ route('userDetails.create') }}">
            <x-primary-button class="mt-4">
                {{ __('Add Details') }}
            </x-primary-button>
        </form>
        @endif
        
         --}}


         <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-bold mb-4" style="text-align:center;margin-bottom:40px">User Details</h3>
                        <table class="min-w-full divide-y divide-gray-200" style="border:2px solid gray;border-radius:4px;box-shadow:0px 0px 7px 5px rgb(113, 86, 233);margin:auto;padding:40px">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Field</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">User Name</td>
                                    <td class="px-6 py-4 whitespace-nowrap " style="text-align:center">{{ $user->name ?? 'Not Found' }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Email</td>
                                    <td class="px-6 py-4 whitespace-nowrap" style="text-align:center">{{ $user->email ?? 'Not Found' }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Phone</td>
                                    <td class="px-6 py-4 whitespace-nowrap" style="text-align:center" >{{ $userdetails->phone ?? 'Not Found' }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Address</td>
                                    <td class="px-6 py-4 whitespace-nowrap" style="text-align:center">{{ $userdetails->address ?? 'Not Found' }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Credit Card</td>
                                    <td class="px-6 py-4 whitespace-nowrap" style="text-align:center">{{ $billing->type ?? 'Not Found' }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap" >Credit Number</td>
                                    <td class="px-6 py-4 whitespace-nowrap" style="text-align:center">{{ $billing->number ?? 'Not Found' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        
                <div class="mt-4" >
                    <form method="GET" action="{{ route('userDetails.edit') }}" style="margin-left:450px">
                        <x-primary-button style="padding:20px;background-color:rgba(101, 101, 239, 0.311)" >
                            {{ __('Edit Details') }}
                        </x-primary-button>
                    </form>
        
                    {{-- @if (isset($user->userdetails)) --}}
                        <form method="POST" action="{{ route('userDetails.destroy',) }}" class="inline" style="margin-left:450px">
                            @csrf
                            @method('DELETE')
                            <x-danger-button style="padding:17px;background-color:rgba(101, 101, 239, 0.311)" onclick="return confirm('Are you sure you want to delete these details?');">
                                {{ __('Delete Details') }}
                            </x-danger-button>
                        </form>
                    {{-- @else --}}
                        <form method="GET" action="{{ route('userDetails.create') }}" class="inline"  style="margin-left:450px">
                            <x-primary-button style="padding:17px;background-color:rgba(101, 101, 239, 0.311)">
                                {{ __('Add Details') }}
                            </x-primary-button>
                        </form>
                    {{-- @endif --}}
                </div>
            </div>
        </div>