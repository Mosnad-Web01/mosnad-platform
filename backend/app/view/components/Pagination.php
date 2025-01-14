<?php
namespace App\View\Components;

use Illuminate\View\Component;

class Pagination extends Component
{
    public $items;

    /**
     * Create a new component instance.
     *
     * @param \Illuminate\Pagination\LengthAwarePaginator $items
     */
    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pagination');
    }
}