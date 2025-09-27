<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->input('q'));

        $products = Product::query()
            ->with('category')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('name', 'like', "%{$q}%")
                      ->orWhere('sku', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('products.index', compact('products', 'q'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get(['id','name']);
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required','integer','exists:TB_categorias,id'],
            'name'        => ['required','string','max:150'],
            'sku'         => ['required','string','max:60','unique:TB_productos,sku'],
            'price'       => ['required','numeric','min:0'],
        ]);

        Product::create($data);
        return redirect()->route('products.index')->with('ok', 'Producto creado.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get(['id','name']);
        return view('products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => ['required','integer','exists:TB_categorias,id'],
            'name'        => ['required','string','max:150'],
            'sku'         => [
                'required','string','max:60',
                Rule::unique('TB_productos','sku')->ignore($product->id, 'id')
            ],
            'price'       => ['required','numeric','min:0'],
        ]);

        $product->update($data);
        return redirect()->route('products.index')->with('ok', 'Producto actualizado.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('ok', 'Producto eliminado.');
    }
}
