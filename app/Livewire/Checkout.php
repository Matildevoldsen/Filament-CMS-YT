<?php

namespace App\Livewire;

use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Stripe\PaymentIntent;
use Livewire\Attributes\On;
use App\Models\ShippingType;
use App\Services\CartManager;
use Livewire\Attributes\Computed;
use App\Livewire\Forms\AddressCheckoutForm;
use App\Livewire\Forms\CustomerCheckoutForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;

class Checkout extends Component
{
    public $items;
    public CustomerCheckoutForm $customerForm;
    public AddressCheckoutForm $addressForm;
    public $showAddressForm = false;
    public $shippingType;
    public $shippingTypeModel;
    public $address_model;

    protected $listeners = [
        'cart.updated' => '$refresh',
    ];


    public function getCartProperty()
    {
        return app(CartManager::class);
    }

    public function getAddressesProperty()
    {
        return auth()->user()->addresses ?? null;
    }

    public function getShippingTypesProperty()
    {
        return ShippingType::all();
    }

    public function updatedShippingType()
    {
        $this->shippingTypeModel = ShippingType::find($this->shippingType);
    }

    public function mount()
    {
        $this->shippingType = $this->shippingTypes->first()->id;
        $this->shippingTypeModel = $this->shippingTypes->first();
        $this->customerForm->email = auth()->user()->email ?? null;
        $this->address_model = $this->addresses->first()->id ?? null;
        if (!auth()->check()) {
            $this->showAddressForm = true;
        }
    }

    public function getTotalProperty(): int
    {
        return (int) $this->cart->getSubtotal() + (int) $this->shippingTypeModel->price;
    }

    public function addAddress()
    {
        if (auth()->user()->addresses()->create($this->addressForm->toArray())) {
            $this->dispatch('cart.updated');
            $this->showAddressForm = false;

            $this->addressForm->reset();
        }
    }

    public function getSetupIntentProperty()
    {
        return auth()->user()->createSetupIntent();
    }


    public function callValidate()
    {
        $this->validate();
    }

    public function getErrorCount()
    {
        return $this->getErrorBag()->count();
    }

    public function checkout($paymentMethodId)
    {
        $this->dispatch('submitPayment');

        $user = auth()->user();

        if (!$user->stripe_id) {
            $user->createAsStripeCustomer();
        }

        auth()->user()->addPaymentMethod($paymentMethodId['id']);

        $user->charge($this->total, $paymentMethodId['id'], [
            'return_url' => route('home') . '?success=true',
        ]);

        app(CartManager::class)->clear();

        $order = $user->orders()->create([
            'total' => $this->total,
            'address_id' => $this->address_model,
            'email' => $this->customerForm->email,
        ]);

        Toaster::success('Order placed successfully!');

        $this->redirect(route('home') . '?orderId=' . $order->uuid);
    }
}
