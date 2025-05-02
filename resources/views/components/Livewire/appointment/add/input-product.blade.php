<div class="container">
    <flux:field>
        <flux:input
            type="number"
            placeholder="{{$introducedQuantity}}"
            wire:click.stop
            wire:keyup="saveQuantity({{ $productId }}, $event.target.value)"
            :disabled="$disabled"></flux:input>
    </flux:field>
</div>