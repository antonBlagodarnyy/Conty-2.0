<flux:navbar>
    <flux:navbar.item href="/dashboard" wire:navigate>Resumen</flux:navbar.item>
    <flux:navbar.item href="/dashboard/calendar" wire:navigate>Calendario</flux:navbar.item>
    <flux:navbar.item href="/dashboard/appointments" wire:navigate>Citas</flux:navbar.item>
    <flux:navbar.item href="/dashboard/clients" wire:navigate>Clientes</flux:navbar.item>
    <flux:navbar.item href="/dashboard/products" wire:navigate>Productos</flux:navbar.item>
    <flux:navbar.item href="/dashboard/services" wire:navigate>Servicios</flux:navbar.item>
    <flux:spacer></flux:spacer>
    <flux:button wire:click="logout" class="mr-5">Cerrar sesion</flux:button>
</flux:navbar>