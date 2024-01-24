<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomerCheckoutForm extends Form
{
    #[Validate('required')]
    public $name = '';

    #[Validate('required')]
    public $email = '';
}
