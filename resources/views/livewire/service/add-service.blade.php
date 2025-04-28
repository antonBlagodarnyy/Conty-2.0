<div class="container">
    <form wire:submit="save">
        <flux:field>

            <flux:label>Nombre</flux:label>
            <flux:input name="name" id="name" type="text" wire:model="name"></flux:input>
           <flux:error name="name"></flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Cobro</flux:label>
            <flux:input name="charge" id="charge" type="number" step="0.01" wire:model="charge"></flux:input>
            <flux:error name="charge"></flux:error>
        </flux:field>

        <flux:button class="mt-2" type="submit">Añadir Servicio</flux:button>
    </form>

</div>