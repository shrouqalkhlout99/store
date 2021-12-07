<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Repositories\Cart\CartRepository;

class CartMenu extends Component
{
    public $cart;
    /**
     * Create a new component instance.
     *
     * @return void
     */


    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-menu');
    }
}
