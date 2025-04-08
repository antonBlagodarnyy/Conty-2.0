<form wire:submit="save">
    <label for="name">Nombre</label>
    <input name="name" id="name" type="text" wire:model="name" />
    <div>@error('name') {{ 'Ese nombre no es valido' }} @enderror</div>

    <label for="email">Email</label>
    <input name="email" id="email" type="text" wire:model="email" />
    <div>@error('email') {{ 'Ese correo no es valido' }} @enderror</div>

    <label for="password">Contraseña</label>
    <input name="password" id="password" type="text" wire:model="password" />
    <div>@error('password') {{ 'Esa contraseña no es valida' }} @enderror</div>

    <label for="password_confirmation">Confirmar contraseña</label>
    <input name="password_confirmation" id="password_confirmation" type="text" wire:model="password_confirmation" />
    <div>@error('password_confirmation') {{ 'Las contraseñas deben de coincidir' }} @enderror</div>

    <button type="submit">Enviar</button>

</form>