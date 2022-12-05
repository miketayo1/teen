<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use App\Models\Slider;

class CountToggle extends Component
{
    public $counts;
    public Model $model;
    public string $field;
    public bool $hasCount;

    
    
    public function render()
    {
        $this->hasCount =  $this->model->getAttribute($this->field);
      
        return view('livewire.count-toggle');
    }
}
