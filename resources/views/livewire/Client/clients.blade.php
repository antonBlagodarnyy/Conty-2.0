<div class="container">
<livewire:navbar></livewire:navbar>

<flux:modal name="add-client">
    <livewire:client.add-client></livewire:client.add-client>
</flux:modal>

<flux:modal name="edit-client">
    <livewire:client.edit-client :$editedClientId></livewire:client.edit-client>
</flux:modal>

<livewire:client.client-table></livewire:client.client-table>
</div>
