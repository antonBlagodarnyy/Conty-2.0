<div class="container">
    <form wire:submit="save">
        <flux:field>
            <flux:label for="email">Email</flux:label>
            <flux:input name="email" id="email" type="text" wire:model="email" />
            <flux:error name="email">@error('email') {{ 'Ese correo no es valido' }} @enderror</flux:error>
        </flux:field>

        <flux:field>
            <flux:label for="password">Contraseña</flux:label>
            <flux:input name="password" id="password" type="password" wire:model="password" />
            <flux:error name="password">@error('password') {{ 'Esa contraseña no es valida' }} @enderror</flux:error>
        </flux:field>

        <flux:field class="mt-2">
            <flux:checkbox wire:model="remember" label="Mantener la sesion iniciada"></flux:checkbox> 
        </flux:field>
        <flux:error name="noUser">@error('noUser') {{ 'Ese usuario no existe' }} @enderror</flux:error>
       
        <flux:button class="mt-2" type="submit">Iniciar sesion</flux:button>
   
    </form>
</div>