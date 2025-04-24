<div class="flex flex-col items-center justify-center ">
    <form wire:submit="save">
        <flux:field >
            <flux:label>Fecha</flux:label>
            <flux:input name="date" id="date" type="date" wire:model="date"></flux:input>
            <flux:error name="date">@error('date') {{ 'Debe introducir una fecha' }} @enderror</flux:error>
        </flux:field>

        <flux:field class="mt-10">
            <flux:label>Servicio</flux:label>
            <livewire:appointment.add.select-service-table wire:model="serviceSelection"></livewire:appointment.add.select-service-table>
            <flux:error name="serviceSelection">@error('serviceSelection') {{ 'Debe seleccionar un servicio' }} @enderror</flux:error>
        </flux:field>

        <flux:field class="mt-10">
            <flux:label>Cliente</flux:label>
            <livewire:appointment.add.select-client-table wire:model="clientSelection"></livewire:appointment.add.select-client-table>
            <flux:error name="clientSelection">@error('clientSelection') {{ 'Debe seleccionar un cliente' }} @enderror</flux:error>
        </flux:field>

        <flux:field class="mt-10">
            <flux:label>Productos</flux:label>
            <livewire:appointment.add.select-products-table wire:model="products"></livewire:appointment.add.select-products-table>
            <flux:error name="products">@error('products') {{ 'Debe seleccionar productos con stock disponible' }} @enderror</flux:error>

        </flux:field>

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