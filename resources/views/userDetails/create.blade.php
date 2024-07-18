<x-app-layout>
    <form method="POST" action="{{ isset($user) ? route('details.update') : route('details.store') }}">
        @csrf

        <!-- If editing, add method spoofing -->
        @if(isset($user))
        @method('POST')
        @endif

        <!-- Phone -->
        <div>
            <x-input-label for="field-phone" :value="__('Phone')" />
            <x-text-input id="field-adress" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', isset($user) ? $user->user_datail->phone : '')" required autofocus/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- address -->
        <div>
            <x-input-label for="field-adress" :value="__('Address')" />
            <x-text-input id="field-label" class="block mt-1 w-full" type="text" name="adress" :value="old('adress', isset($user) ?$user->user_datail->adress : '')" required  />
            <x-input-error :messages="$errors->get('adress')" class="mt-2" />
        </div>

        <!-- cridit card -->
        <div>
            <x-input-label for="field-pay_type" :value="__('Cridit Card')" />
            <x-text-input id="field-pay_type" class="block mt-1 w-full" type="text" name="pay_type" :value="old('cridit card', isset($user) ? $billing->type  : '')" required autofocus/>
            <x-input-error :messages="$errors->get('cridit card')" class="mt-2" />
        </div>

        <!-- cridt number -->
        <div>
            <x-input-label for="field-card_number" :value="__('Cridt Number')" />
            <x-text-input id="field-card_number" class="block mt-1 w-full" type="text" name="card_number" :value="old('cridt number', isset($user) ? $billing->number : '')" required autofocus/>
            <x-input-error :messages="$errors->get('card_number')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ isset($user) ? __('Update') : __('Create') }}
            </x-primary-button>
        </div>
    </form>
    <!-- Delete Button -->
    @if(isset($user))
    <form method="POST" action="{{ route('details.destroy', [$user->user_datail,$billing]) }}">
        @csrf
        @method('DELETE')
        <x-danger-button class="mt-4" onclick="return confirm('Are you sure you want to delete this field?');">
            {{ __('Delete') }}
        </x-danger-button>
    </form>
    @endif
</x-app-layout>