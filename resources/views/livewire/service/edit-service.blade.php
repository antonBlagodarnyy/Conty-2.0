<div class="container">
<form wire:submit="save">
        <flux:field>

            <flux:label>Nombre</flux:label>
            <flux:input name="name" id="name" type="text" placeholder="{{ $this->name }}" wire:model="newName"></flux:input>
            <flux:error name="name">@error('name') {{ 'Debe introducir un nombre' }} @enderror</flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Cobro</flux:label>
            <flux:input name="charge" id="charge" type="number" step="0.01" placeholder="{{ $this->charge }}" wire:model="newCharge"></flux:input>
            <flux:error name="charge">@error('phone') {{ 'Debe introducir un cobro valido' }} @enderror</flux:error>
        </flux:field>

        <flux:button class="mt-2" type="submit">Guardar cambios</flux:button>
    </form>

    <div>
        @if (session()->has('message'))
            <div class="mt-2">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
