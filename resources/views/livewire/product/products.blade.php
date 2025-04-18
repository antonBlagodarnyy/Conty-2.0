<div class="container">
    <livewire:navbar></livewire:navbar>

    <flux:modal name="add-product">
    <livewire:product.add-product></livewire:product.add-product>
</flux:modal>

<flux:modal name="edit-product">
    <livewire:product.edit-product :$editedProductId></livewire:product.edit-product>
</flux:modal>


    <livewire:product.product-table></livewire:product.product-table>
</div>