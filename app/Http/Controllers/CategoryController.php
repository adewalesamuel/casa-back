<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$categories = Category::where('id', '>', -1)
        ->orderBy('created_at', 'desc');

        if ($request->input('page') == null ||
            $request->input('page') == '') {
            $categories = $categories->get();
        } else {
            $categories = $categories->paginate();
        }

        $data = [
            'success' => true,
            'categories' => $categories
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = new Category;

        $category->nom = $validated['nom'] ?? null;
		$category->slug = Str::slug($validated['nom']);
		$category->description = $validated['description'] ?? null;
		$category->icon_img_url = $validated['icon_img_url'] ?? null;
		$category->display_img_url = $validated['display_img_url'] ?? null;
		$category->quantite = $validated['quantite'] ?? null;
		$category->category_id = $validated['category_id'] ?? null;

        $category->save();

        $data = [
            'success'       => true,
            'category'   => $category
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $data = [
            'success' => true,
            'category' => $category
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $category->nom = $validated['nom'] ?? null;
		$category->slug = Str::slug($validated['nom']);
		$category->description = $validated['description'] ?? null;
		$category->icon_img_url = $validated['icon_img_url'] ?? null;
		$category->display_img_url = $validated['display_img_url'] ?? null;
		$category->quantite = $validated['quantite'] ?? null;
		$category->category_id = $validated['category_id'] ?? null;

        $category->save();

        $data = [
            'success'       => true,
            'category'   => $category
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        $data = [
            'success' => true,
            'category' => $category
        ];

        return response()->json($data);
    }
}
