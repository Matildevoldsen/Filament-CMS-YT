<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class AddressCheckoutForm extends Form
{
    #[Validate('required')]
    public $address = '';

    #[Validate('required')]
    public $address_2 = '';

    #[Validate('required')]
    public $city = '';

    #[Validate('required')]
    public $postcode = '';
}
