<div class="flex flex-col items-center justify-center ">
    <div class="container">
    <livewire:navbar></livewire:navbar>
</div>
<flux:modal name="add-client" @close="clearAddForm">
    <livewire:client.add-client></livewire:client.add-client>
</flux:modal>

<flux:modal name="edit-client" @close="clearEditForm">
    <livewire:client.edit-client :$editedClientId></livewire:client.edit-client>
</flux:modal>

<div class="container">
    <livewire:client.client-table></livewire:client.client-table>
</div>
</div>