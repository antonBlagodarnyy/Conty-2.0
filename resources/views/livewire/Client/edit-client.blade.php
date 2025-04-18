<div class="container">
<form wire:submit="save">
        <flux:field>

            <flux:label>Nombre</flux:label>
            <flux:input name="name" id="name" type="text" placeholder="{{ $this->name }}" wire:model="newName"></flux:input>
            <flux:error name="name">@error('name') {{ 'Debe introducir un nombre' }} @enderror</flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Telefono</flux:label>
            <flux:input name="phone" id="phone" type="text" placeholder="{{ $this->phone }}" wire:model="newPhone"></flux:input>
            <flux:error name="phone">@error('phone') {{ 'Debe introducir un numero de telefono' }} @enderror</flux:error>
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
