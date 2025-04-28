<div>
<form wire:submit="save">
        <flux:field>

            <flux:label>Nombre</flux:label>
            <flux:input name="newName" id="name" type="text" placeholder="{{ $this->name }}" wire:model="newName"></flux:input>
            <flux:error name="newName"></flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Precio</flux:label>
            <flux:input name="newPrice" id="price" type="number" step="0.01" placeholder="{{ $this->price }}" wire:model="newPrice"></flux:input>
            <flux:error name="newPrice"></flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Contenido neto</flux:label>
            <flux:input name="newNetContent" id="netContent" type="number"  placeholder="{{ $this->netContent }}" wire:model="newNetContent"></flux:input>
            <flux:error name="newNetContent"></flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Stock en gramos</flux:label>
            <flux:input name="newStockInGrams" id="stockInGrams" placeholder="{{ $this->stockInGrams }}" type="number" wire:model="newStockInGrams"></flux:input>
            <flux:error name="newStockInGrams"></flux:error>
        </flux:field>

        <flux:button class="mt-2" type="submit">Editar producto</flux:button>
    </form>
</div>
