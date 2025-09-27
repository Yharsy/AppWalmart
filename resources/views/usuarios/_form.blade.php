@csrf
<div style="display:grid; gap:12px; max-width:640px;">
  <input class="input" name="name"  value="{{ old('name', $usuario->name ?? '') }}"  placeholder="Nombre" required>
  <input class="input" name="email" type="email" value="{{ old('email', $usuario->email ?? '') }}" placeholder="Email" required>

  @isset($usuario)
    <input class="input" name="password" type="password" placeholder="Nueva contraseña (opcional)">
    <input class="input" name="password_confirmation" type="password" placeholder="Confirmar contraseña (opcional)">
  @else
    <input class="input" name="password" type="password" placeholder="Contraseña" required>
    <input class="input" name="password_confirmation" type="password" placeholder="Confirmar contraseña" required>
  @endisset

  @foreach (['name','email','password'] as $f)
    @error($f)<div class="err">{{ $message }}</div>@enderror
  @endforeach
</div>
