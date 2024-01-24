<form
    x-data="{
        stripe: null,
        cardElement: null,
        email: @entangle('accountForm.email').defer,

        async submit () {
            await $wire.callValidate()

            let errorCount = await $wire.getErrorCount()
            if (errorCount >= 1) {
                return
            }

            const { paymentIntent, error } = await this.stripe.confirmCardPayment(
                '{{ $this->setupIntent->client_secret }}', {
                    payment_method: {
                        card: this.cardElement,
                        billing_details: { email: this.email }
                    }
                }
            )

            if (error) {
                console.log(error)
            } else {
                $wire.checkout()
            }
        },

        init () {
            this.stripe = Stripe('{{ config('stripe.key') }}')

            const elements = this.stripe.elements()
            this.cardElement = elements.create('card')

            this.cardElement.mount('#card-element')
        }
    }"
    x-on:submit.prevent="submit"
    class="flex mx-auto flex-col lg:flex-row">
    <section class="flex-grow p-5 lg:pl-32">
        <div class="flex items-center justify-center">
            <h1 class="text-2xl font-semibold text-gray-900">Customer Details</h1>
        </div>

        @guest
            <div class="mt-3">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" wire:model='customerForm.email' id="email"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="john@gmail.com">
                @error('customerForm.email')
                <div class="text-sm text-red-500">
                    {{ $message }}
                </div>
                @enderror
            </div>
        @endguest

        <div class="mt-3">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input wire:model="customerForm.name" type="text" id="name"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="John Smith">
            @error('customerForm.name')
            <div class="text-sm text-red-500">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mt-3 flex items-center justify-center">
            <h1 class="text-2xl font-semibold text-gray-900">Address</h1>
        </div>

        @if (auth()->check() && $this->addresses?->count() > 0)
            <div class="mt-3">
                <label for="address_select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                    Address</label>
                <select name="address_select" id="address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($this->addresses as $address)
                        <option value="{{ $address->id }}">
                            {{ $address->formattedAddress()}}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="mt-3 flex">
            <input type="checkbox" wire:model.live="showAddressForm" id="toggleAddress"
                   class="{{ auth()->check() ? 'block' : 'hidden'}} rounded text-blue-500 focus:ring-blue-500">
            <label for="toggleAddress"
                   class="{{ auth()->check() ? 'block' : 'hidden'}} ml-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">Do
                you want to enter an address?</label>
        </div>

        @if ($showAddressForm)
            <div class="mt-3">
                <label for="address_line_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address
                    Line 1</label>
                <input wire:model="addressForm.address" type="text" id="address_line_1"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Address Line 1">
                @error('addressForm.address')
                <div class="text-sm text-red-500">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="address_line_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address
                    Line 2</label>
                <input wire:model="addressForm.address_2" type="text" id="address_line_2"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Address Line 2">
                @error('addressForm.address_2')
                <div class="text-sm text-red-500">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="grid mt-3 gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                    <input wire:model="addressForm.city" type="text" id="city"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="City">
                    @error('addressForm.city')
                    <div class="text-sm text-red-500">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="post_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post
                        Code / Zip Code</label>
                    <input wire:model="addressForm.postcode" type="text" id="post_code"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Post Code / Zip Code">
                    @error('addressForm.postcode')
                    <div class="text-sm text-red-500">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            @auth()
                <div class="mt-3">
                    <button wire:click="addAddress">Add Address</button>
                </div>
            @endauth
        @endif

        <div class="mt-3">
            <label for="shipping_types" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipping
                Types</label>

            <select wire:model.live="shippingType" name="shipping_types" id="shipping_types"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($this->shippingTypes as $shippingType)
                    <option value="{{ $shippingType->id }}">{{ $shippingType->name }} ({{ money($shippingType->price )}}
                        )
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mt-3">
            <label for="card_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Card Holder
                Name</label>
            <input type="text" id="card_name"
                   class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   placeholder="John Smith">

            <div wire:ignore>
                <div id="card-element"></div>
            </div>

        </div>
    </section>
    <section class="h-screen lg:w-2/5 sm:w-full  py-12 sm:py-10 lg:py-10">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mt-8 max-w-2xl md:mt-12">
                <div class="bg-white shadow">
                    <div class="px-4 py-6 sm:px-8 sm:py-10">
                        <div class="flow-root">
                            <ul class="-my-8">
                                @foreach($items as $item)
                                    <livewire:cart-item :item="$item" :key="$item->id"/>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-6 border-t border-b py-2">
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-400">Subtotal</p>
                                <p class="text-lg font-semibold text-gray-900">{{ money($this->cart->getSubtotal()) }}</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-400">Shipping</p>
                                <p class="text-lg font-semibold text-gray-900">{{ money($this->shippingTypeModel->price) }}</p>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">Total</p>
                            <p class="text-3xl font-semibold text-gray-900">
                                {{ money($this->total) }}
                            </p>
                        </div>

                        <div class="mt-6 text-center">
                            <x-button id="card-button" type="submit"
                                      class="group inline-flex w-full items-center justify-center rounded-md bg-gray-900 px-6 py-4 text-lg font-semibold text-white transition-all duration-200 ease-in-out focus:shadow hover:bg-gray-800">
                                Pay {{ money($this->total) }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
