<div class="auth-container">
    <form wire:submit="save">
        <flux:field>
            <flux:label for="email">Email</flux:label>
            <flux:input name="email" id="email" type="text" wire:model="email" />
            <flux:error name="email">@error('email') {{ 'Ese correo no es valido' }} @enderror</flux:error>


            <flux:label for="password">Contraseña</flux:label>
            <flux:input name="password" id="password" type="text" wire:model="password" />
            <flux:error>@error('password') {{ 'Esa contraseña no es valida' }} @enderror</flux:error>

            <flux:button type="submit">Enviar</flux:button>
        </flux:field>
    </form>
</div>