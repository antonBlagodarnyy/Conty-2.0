<div>
<form wire:submit="save">
        <flux:field>

            <flux:label>Nombre</flux:label>
            <flux:input name="name" id="name" type="text" placeholder="{{ $this->name }}" wire:model="newName"></flux:input>
            <flux:error name="name">@error('name') {{ 'Debe introducir un nombre' }} @enderror</flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Precio</flux:label>
            <flux:input name="price" id="price" type="number" step="0.01" placeholder="{{ $this->price }}" wire:model="newPrice"></flux:input>
            <flux:error name="price">@error('price') {{ 'Debe introducir un precio valido' }} @enderror</flux:error>
        </flux:field>

        <flux:field>
            <flux:label>Stock en gramos</flux:label>
            <flux:input name="stockInGrams" id="stockInGrams" placeholder="{{ $this->stockInGrams }}" type="number" wire:model="newStockInGrams"></flux:input>
            <flux:error name="stockInGrams">@error('stockInGrams') {{ 'Debe introducir un stock valido' }} @enderror</flux:error>
        </flux:field>

        <flux:button class="mt-2" type="submit">Editar producto</flux:button>
    </form>

    <div>
        @if (session()->has('message'))
            <div class="mt-2">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
