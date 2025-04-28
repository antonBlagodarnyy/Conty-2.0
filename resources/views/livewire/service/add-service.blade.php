<div class="container">
    <form wire:submit="save">
        <flux:field>

            <flux:label>Nombre</flux:label>
            <flux:input name="name" id="name" type="text" wire:model="name"></flux:input>
            @error('name')<flux:error name="name" message="Debe introducir un nombre."></flux:error>@enderror
        </flux:field>

        <flux:field>
            <flux:label>Cobro</flux:label>
            <flux:input name="charge" id="charge" type="number" step="0.01" wire:model="charge"></flux:input>
            @error('charge')<flux:error name="charge" message="Debe introducir un cobro"> </flux:error> @enderror
        </flux:field>

        <flux:button class="mt-2" type="submit">Añadir Servicio</flux:button>
    </form>

</div>