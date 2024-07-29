{{-- <x-app-layout>
    <form method="POST" action="{{ isset($user) ? route('userDetails.update') : route('userDetails.store') }}">
        @csrf

        <!-- If editing, add method spoofing -->
        @if(isset($user))
        @method('PUT')
        @endif

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', isset($user) ? $user->userdetails->phone : '')" required autofocus/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- address -->
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', isset($user) ?$user->userdetails->address : '')" required  />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- cridit card -->
        <div>
            <x-input-label for="type" :value="__('Cridit Card')" />
            <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type', isset($user) ? $billing->type  : '')" required autofocus/>
            <x-input-error :messages="$errors->get('cridit card')" class="mt-2" />
        </div>

        <!-- cridt number -->
        <div>
            <x-input-label for="number" :value="__('Cridt Number')" />
            <x-text-input id="number" class="block mt-1 w-full" type="text" name="number" :value="old('cridt number', isset($user) ? $billing->number : '')" required autofocus/>
            <x-input-error :messages="$errors->get('number')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ isset($user) ? __('Update') : __('Create') }}
            </x-primary-button>
        </div>
    </form>
    <!-- Delete Button -->
    @if(isset($user))
    <form method="POST" action="{{ route('userDetails.destroy', [$user->userdetails,$billing]) }}">
        @csrf
        @method('DELETE')
        <x-danger-button class="mt-4" onclick="return confirm('Are you sure you want to delete these details?');">
            {{ __('Delete') }}
        </x-danger-button>
    </form>
    @endif
</x-app-layout> --}}


<!-- resources/views/userdetails.blade.php -->
<x-app-layout>
    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md mt-5">
        <h2 class="text-2xl font-semibold mb-4">{{ isset($user) ? __('Edit User Details') : __('Create User Details') }}</h2>
        <form method="POST" action="{{ isset($user) ? route('userDetails.update') : route('userDetails.store') }}">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif

            <!-- Phone -->
            <div class="mb-4">
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" class="block mt-1 w-full border rounded-md" type="text" name="phone" :value="old('phone', isset($user) ? $user->userdetails->phone : '')" required autofocus />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="mb-4">
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" class="block mt-1 w-full border rounded-md" type="text" name="address" :value="old('address', isset($user) ? $user->userdetails->address : '')" required />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Credit Card Type -->
            <div class="mb-4">
                <x-input-label for="type" :value="__('Credit Card Type')" />
                <x-text-input id="type" class="block mt-1 w-full border rounded-md" type="text" name="type" :value="old('type', isset($user) ? $billing->type : '')" required autofocus />
                <x-input-error :messages="$errors->get('credit card')" class="mt-2" />
            </div>

            <!-- Credit Card Number -->
            <div class="mb-4">
                <x-input-label for="number" :value="__('Credit Card Number')" />
                <x-text-input id="number" class="block mt-1 w-full border rounded-md" type="text" name="number" :value="old('credit number', isset($user) ? $billing->number : '')" required autofocus />
                <x-input-error :messages="$errors->get('number')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ isset($user) ? __('Update') : __('Create') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Delete Button -->
        @if(isset($user))
            <form method="POST" action="{{ route('userDetails.destroy', [$user->userdetails, $billing]) }}">
                @csrf
                @method('DELETE')
                <x-danger-button class="mt-4" onclick="return confirm('Are you sure you want to delete these details?');">
                    {{ __('Delete') }}
                </x-danger-button>
            </form>
        @endif
    </div>
</x-app-layout>
