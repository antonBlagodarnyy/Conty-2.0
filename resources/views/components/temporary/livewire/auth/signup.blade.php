<div class="container">


    <form wire:submit="save">
        <flux:field>
            <flux:label for="name">Nombre</flux:label>
            <flux:input name="name" id="name" type="text" wire:model="name" />
            <flux:error name="name">@error('name') {{ 'Ese nombre no es valido' }} @enderror</flux:error>
        </flux:field>

        <flux:field>
            <flux:label for="email">Email</flux:label>
            <flux:input name="email" id="email" type="text" wire:model="email" />
            <flux:error>@error('email') {{ 'Ese correo no es valido' }} @enderror</flux:error>
        </flux:field>

        <flux:field>
            <flux:label for="password">Contraseña</flux:label>
            <flux:input name="password" id="password" type="password" wire:model="password" />
            <flux:error>@error('password') {{ 'Esa contraseña no es valida' }} @enderror</flux:error>
        </flux:field>

        <flux:field>
            <flux:label for="password_confirmation">Confirmar contraseña</flux:label>
            <flux:input name="password_confirmation" id="password_confirmation" type="password" wire:model="password_confirmation" />
            <flux:error>@error('password_confirmation') {{ 'Las contraseñas deben de coincidir' }} @enderror</flux:error>
        </flux:field>

        <flux:button class="mt-2" type="submit">Registrarse</flux:button>

    </form>
</div>