<div class="flex flex-col items-center justify-center ">
    <div class="container">
        <livewire:navbar></livewire:navbar>
    </div>

    <flux:modal name="add-service">
    <livewire:service.add-service></livewire:service.add-service>
</flux:modal>

<flux:modal name="edit-service">
    <livewire:service.edit-service :$editedServiceId></livewire:service.edit-service>
</flux:modal>

    <div class="container">
        <livewire:service.service-table></livewire:service.service-table>
    </div>
</div>