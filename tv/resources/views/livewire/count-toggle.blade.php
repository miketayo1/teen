<div wire:poll>
        @if ($hasCount == 0)
                <p class="mb-0 text-sm" wire:model.lazy="hasCount" >Active: {{$hasCount="off"}}</p>
        @else
                <p class="mb-0 text-sm" wire:model.lazy="hasCount" >Active: {{$hasCount="on"}} </p>
        @endif
        
</div>
