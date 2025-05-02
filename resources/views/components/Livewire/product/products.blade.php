<div class="flex flex-col items-center justify-center ">
    <div class="container">
        <livewire:navbar></livewire:navbar>
    </div>
    <flux:modal name="add-product" @close="clearAddForm">
        <livewire:product.add-product></livewire:product.add-product>
    </flux:modal>

    <flux:modal name="edit-product" @close="clearEditForm">
        <livewire:product.edit-product :$editedProductId></livewire:product.edit-product>
    </flux:modal>

    <div class="container">
        <livewire:product.product-table></livewire:product.product-table>
    </div>
</div>