        <x-slot name="header">
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
                        <b>Phone : </b>  {{ $user->user_datail->phone ?? 'Not Found' }}<br>
                        <b>Address : </b> {{ $user->user_datail->adress ?? 'Not Found' }}<br>
                        <b>Credit Card : </b> {{ $billing->type ?? 'Not Found' }}<br>
                        <b>Credit Number : </b> {{ $billing->number ?? 'Not Found' }}<br>
    
    
                    </div>
                </div>
                @if (isset($user->user_datail))
                <form method="POST" action="{{ route('details.destroy', [$user->user_datail,$billing]) }}">
                    @csrf
                    @method('DELETE')
                    <x-danger-button class="mt-4" onclick="return confirm('Are you sure you want to delete this field?');">
                        {{ __('Delete Details') }}
                    </x-danger-button>
                </form>
                @else
                <form method="GET" action="{{ route('details.create') }}">
                    <x-primary-button class="mt-4">
                        {{ __('Add Details') }}
                    </x-primary-button>
                </form>
                @endif
                
                