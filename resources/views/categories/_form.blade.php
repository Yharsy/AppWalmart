@csrf
<div style="display:grid; gap:12px; max-width:520px;">
  <input class="input" name="name" value="{{ old('name', $category->name ?? '') }}" placeholder="Nombre" required>
  @error('name')<div class="err">{{ $message }}</div>@enderror
</div>
