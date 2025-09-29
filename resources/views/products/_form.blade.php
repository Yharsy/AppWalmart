@csrf
<div style="display:grid; gap:12px; max-width:640px;">
  <label>
    <span>Categoría</span>
    <select class="input" name="category_id" required>
      <option value="">-- Selecciona --</option>
      @foreach ($categories as $c)
        <option value="{{ $c->id }}"
          @selected(old('category_id', $product->category_id ?? null) == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
  </label>

  <input class="input" name="name"  value="{{ old('name', $product->name ?? '') }}"  placeholder="Nombre" required>
  <input class="input" name="sku"   value="{{ old('sku',  $product->sku  ?? '') }}"  placeholder="SKU" required>
  <input class="input" name="price" value="{{ old('price',$product->price?? '') }}" type="number" step="0.01" min="0" placeholder="Precio" required>

  @foreach (['category_id','name','sku','price'] as $f)
    @error($f)<div class="err">{{ $message }}</div>@enderror
  @endforeach
</div>
