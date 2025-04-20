<div class="container">
    <flux:field>
        <flux:input wire:keyup="saveQuantity({{ $model->id }}, $event.target.value)" type="number"></flux:input>
    </flux:field>
</div>
