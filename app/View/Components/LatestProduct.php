<?php

namespace App\View\Components;

use App\Models\product;
use Illuminate\View\Component;

class LatestProduct extends Component
{
    public $products;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($count =10)
    {
//      $this->products =product::latest()
//              ->active()
//              ->price(100)
//              ->limit($count)
//               ->get();
        $this->products=product::get();

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.latest-product');
    }
}
