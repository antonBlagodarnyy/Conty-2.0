<div class="container">
    <form wire:submit="save">
        <flux:field>

            <flux:label>Nombre</flux:label>
            <flux:input name="name" id="name" type="text" wire:model="name"></flux:input>
            <flux:error name="name">@error('name') {{ 'Debe introducir un nombre' }} @enderror</flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Telefono</flux:label>
            <flux:input name="phone" id="phone" type="text" wire:model="phone"></flux:input>
            <flux:error name="phone">@error('phone') {{ 'Debe introducir un numero de telefono' }} @enderror</flux:error>
        </flux:field>

        <flux:button class="mt-2" type="submit">Añadir cliente</flux:button>
    </form>

    <div>
        @if (session()->has('message'))
            <div class="mt-2">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>