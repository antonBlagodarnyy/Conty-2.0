<div class="container">
    <form wire:submit="save">
        <flux:field>

            <flux:label>Fecha</flux:label>
            <flux:input name="date" id="date" type="date" wire:model="date"></flux:input>
            <flux:error name="date">@error('name') {{ 'Debe introducir una fecha' }} @enderror</flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Tipo de trabajo</flux:label>
            <flux:input name="job" id="job" type="text" wire:model="job"></flux:input>
            <flux:error name="job">@error('phone') {{ 'Debe introducir un tipo de trabajo' }} @enderror</flux:error>
        </flux:field>

        <!--TODO add select 1 client -->

        <!--TODO add select 0-n products with quantity-->

        <flux:button class="mt-2" type="submit">Añadir cita</flux:button>
    </form>

    <div>
        @if (session()->has('message'))
        <div class="mt-2">
            {{ session('message') }}
        </div>
        @endif
    </div>
</div>