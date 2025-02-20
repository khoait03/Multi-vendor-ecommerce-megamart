<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
  /**
   * Create a new component instance.
   */

  public $product, $key, $column;

  public function __construct($product, $key = NULL, $column = 3)
  {
    $this->product = $product;
    $this->key = $key;
    $this->column = $column;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.product-card');
  }
}
