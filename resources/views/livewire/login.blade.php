<form wire:submit="save">
    <label for="email">Email</label>
    <input name="email" id="email" type="text" wire:model="email" />
    <div>@error('email') {{ 'Ese correo no es valido' }} @enderror</div>

    <label for="password">Contraseña</label>
    <input name="password" id="password" type="text" wire:model="password" />
    <div>@error('password') {{ 'Esa contraseña no es valida' }} @enderror</div>

    <button type="submit">Enviar</button>

</form>