<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class ToggleEvent extends Component
{
    public Model $model;
      public string $field;
      public bool $hasStock;

      public function mount()
      {
          $this->hasStock =(bool) $this->model->getAttribute($this->field);
          
      }
    public function render()
    {
        return view('livewire.toggle-event');
    }

    public function updating($field, $value)
      {
        
          $this->model->setAttribute($this->field, $value)->save();
        //   $this->emitself('refresh-me');
      }
}
