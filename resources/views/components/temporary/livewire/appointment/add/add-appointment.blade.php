<div class="flex flex-col items-center justify-center ">
    <form wire:submit="save">
        <flux:field >
            <flux:label>Fecha</flux:label>
            <flux:input name="date" id="date" type="date" wire:model="date"></flux:input>
            <flux:error name="date">r</flux:error>
        </flux:field>

        <flux:field class="mt-10">
            <flux:label>Servicio</flux:label>
            <livewire:appointment.add.add-select-service-table wire:model="serviceSelection"></livewire:appointment.add.add-select-service-table>
            <flux:error name="serviceSelection"></flux:error>
        </flux:field>

        <flux:field class="mt-10">
            <flux:label>Cliente</flux:label>
            <livewire:appointment.add.add-select-client-table wire:model="clientSelection"></livewire:appointment.add.add-select-client-table>
            <flux:error name="clientSelection"></flux:error>
        </flux:field>

        <flux:field class="mt-10">
            <flux:label>Productos</flux:label>
            <livewire:appointment.add.add-select-products-table wire:model="products"></livewire:appointment.add.add-select-products-table>
            <flux:error name="products"></flux:error>

        </flux:field>

        <flux:button class="mt-2" type="submit">Añadir cita</flux:button>
    </form>

</div>