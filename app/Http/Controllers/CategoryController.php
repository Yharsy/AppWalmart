<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->input('q'));
        $categories = Category::when($q, fn($qr) =>
                $qr->where('name', 'like', "%{$q}%")
            )
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('categories.index', compact('categories','q'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:100','unique:TB_categorias,name'],
        ]);

        Category::create($data);
        return redirect()->route('categories.index')->with('ok','Categoría creada.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => [
                'required','string','max:100',
                Rule::unique('TB_categorias','name')->ignore($category->id, 'id')
            ],
        ]);

        $category->update($data);
        return redirect()->route('categories.index')->with('ok','Categoría actualizada.');
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete(); // tu FK en productos es ON DELETE RESTRICT
            return back()->with('ok','Categoría eliminada.');
        } catch (QueryException $e) {
            // si hay productos asociados, MySQL lanza error por restricción
            return back()->with('err','No se puede eliminar: hay productos asociados a esta categoría.');
        }
    }
}
