<flux:navbar>
    <flux:navbar.item href="/dashboard" wire:navigate>Summary</flux:navbar.item>
    <flux:navbar.item href="/dashboard/calendar" wire:navigate>Calendar</flux:navbar.item>
    <flux:navbar.item href="/dashboard/appointments" wire:navigate>Appointments</flux:navbar.item>
    <flux:navbar.item href="/dashboard/clients" wire:navigate>Clients</flux:navbar.item>
    <flux:navbar.item href="/dashboard/products" wire:navigate>Products</flux:navbar.item>
    <flux:spacer></flux:spacer>
    <flux:button wire:click="logout" class="mr-5">Cerrar sesion</flux:button>
</flux:navbar>