<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class table extends Component
{
    public $data;
    public $model;
    public $actions;
    public $columns;

    /**
     * Create a new component instance.
     */
    public function __construct($data, $columns, $model = 'default', $actions = [],)
    {
        $this->data = $data;
        $this->model = $model;
        $this->actions = $actions;
        $this->columns = $columns;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table', ['data' => $this->data, 'model' => $this->model, 'actions' => $this->actions, 'columns' => $this->columns]);
    }
}
