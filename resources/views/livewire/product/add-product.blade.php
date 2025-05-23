<div class="container">
<form wire:submit="save">
        <flux:field>

            <flux:label>Nombre</flux:label>
            <flux:input name="name" id="name" type="text" wire:model="name"></flux:input>
            <flux:error name="name"></flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Precio</flux:label>
            <flux:input name="price" id="price" type="number" step="0.01" wire:model="price"></flux:input>
            <flux:error name="price"></flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Contenido neto</flux:label>
            <flux:input name="net_content" id="netContent" type="number" wire:model="net_content"></flux:input>
            <flux:error name="net_content"></flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Stock en gramos</flux:label>
            <flux:input name="stockInGrams" id="stockInGrams" type="number" wire:model="stockInGrams"></flux:input>
            <flux:error name="stockInGrams"></flux:error>
        </flux:field>

        <flux:button class="mt-2" type="submit">Añadir producto</flux:button>
    </form>
</div>
