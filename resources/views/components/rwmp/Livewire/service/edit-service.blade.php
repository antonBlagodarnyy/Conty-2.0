<div class="container">
<form wire:submit="save">
        <flux:field>

            <flux:label>Nombre</flux:label>
            <flux:input name="newName" id="name" type="text" placeholder="{{ $this->name }}" wire:model="newName"></flux:input>
            <flux:error name="newName"></flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Cobro</flux:label>
            <flux:input name="newCharge" id="charge" type="number" step="0.01" placeholder="{{ $this->charge }}" wire:model="newCharge"></flux:input>
            <flux:error name="newCharge"></flux:error>
        </flux:field>

        <flux:button class="mt-2" type="submit">Guardar cambios</flux:button>
    </form>

</div>
