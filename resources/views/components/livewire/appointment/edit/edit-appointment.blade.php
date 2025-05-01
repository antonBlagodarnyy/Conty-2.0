<div class="flex flex-col items-center justify-center ">
    <form wire:submit="save">
        <flux:field>
            <flux:label>Fecha: {{$this->date}}</flux:label>
            <flux:input name="newDate" id="date" type="date" wire:model="newDate" ></flux:input>
            <flux:error name="newDate"></flux:error>
        </flux:field>

        <flux:field class="mt-10">
            <flux:label>Servicio</flux:label>
            <livewire:appointment.edit.edit-select-service-table wire:model="newServiceSelection" :$serviceSelection></livewire:appointment.edit.edit-select-service-table>
            <flux:error name="newServiceSelection"></flux:error>
        </flux:field>

        <flux:field class="mt-10">
            <flux:label>Cliente</flux:label>
            <livewire:appointment.edit.edit-select-client-table wire:model="newClientSelection" :$clientSelection></livewire:appointment.edit.edit-select-client-table>
            <flux:error name="newClientSelection"></flux:error>
        </flux:field>

        <flux:field class="mt-10">
            <flux:label>Productos</flux:label>
            <livewire:appointment.edit.edit-select-products-table wire:model="newProductsSelection" :$productsSelection></livewire:appointment.edit.edit-select-products-table>
            <flux:error name="newProductsSelection"></flux:error>

        </flux:field>

        <flux:button class="mt-2" type="submit">Añadir cita</flux:button>
    </form>
</div>