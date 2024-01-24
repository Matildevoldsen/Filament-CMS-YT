<?php

namespace App\Livewire;

use Livewire\Component;
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

        // Set your Stripe secret key
        Stripe::setApiKey(config('stripe.secret'));

        // Ensure the user has a Stripe customer ID
        $user = Auth::user();
        if (!$user->stripe_id) {
            $stripeCustomer = $user->createAsStripeCustomer();
        }

        try {
            // Create a Payment Intent with the order amount and currency
            $paymentIntent = PaymentIntent::create([
                'amount' => $this->total * 100, // Convert amount to cents
                'currency' => 'usd', // Change to your currency
                'payment_method' => $paymentMethodId,
                'customer' => $user->stripe_id,
                'confirmation_method' => 'automatic',
                'confirm' => true,
            ]);

            // Check the status of the payment
            if ($paymentIntent->status === 'requires_action') {
                // Handle additional authentication
                $this->handleAdditionalAuthentication($paymentIntent);
            } elseif ($paymentIntent->status === 'succeeded') {
                // Handle successful payment
                $this->handleSuccessfulPayment($paymentIntent);
            } else {
                // Payment failed
                $this->addError('payment', 'Payment failed.');
            }
        } catch (\Exception $e) {
            // Handle error
            $this->addError('payment', $e->getMessage());
        }
    }

    protected function handleAdditionalAuthentication($paymentIntent)
    {
        // Redirect to Stripe's authentication page or handle it as needed
    }

    protected function handleSuccessfulPayment($paymentIntent)
    {
        // Update order status and perform post-payment actions
    }
}
