<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categories_read')->only('index');
        $this->middleware('permission:categories_update')->only('edit');
        $this->middleware('permission:categories_create')->only('create');
        $this->middleware('permission:categories_delete')->only('destroy');
    }

    public function index(Request $request)
    {

        $categories = Category::when($request->search, function ($query) use ($request) {
            return $query->whereTranslationLike('name', '%' . $request->search . '%');
        })->latest()->paginate(10);


        return view('dashboard.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'image' => 'image',
            'ar.*' => 'required|unique:category_translations,name',
            'en.*' => 'required|unique:category_translations,name',

        ]);
        $data = $request->except([ 'image']);
        if ($request->image) {
            $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/categories/' . $request->image->hashName()));

            $data['image'] = $request->image->hashName();
        }

        $category = Category::create($data);

        Alert::toast('You\'ve Successfully created', 'success');

        return redirect()->route('categories.index');
    }

    public
    function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }


    public
    function update(Request $request, Category $category)
    {
        $rule = [];
        foreach(config('translatable.locales') as $local)
        {
            $rule +=[$local.'.name'=>['required',Rule::unique('category_translations','name')->ignore($category->id,'category_id')]];
        }
        $request->validate($rule);
        $data = $request->except(['image']);
        if ($request->image) {
            if ($category->image != 'default.jpg') {
                Storage::disk('public_uploads')->delete('/categories/' . $category->image);
            }
            $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/categories/' . $request->image->hashName()));

            $data['image'] = $request->image->hashName();
            $category->update($data);

        } else {
            $data['image'] = $category->image;

            $category->update($data);
        }

        Alert::toast('You\'ve Successfully updated', 'success');
        return redirect()->route('categories.index');
    }


    public
    function destroy(Category $category)
    {
        if ($category->image != 'default.jpg') {
            Storage::disk('public_uploads')->delete('/categories/' . $category->image);
        }

        $category->delete();
        Alert::toast('You\'ve Successfully deleted', 'success');

        return redirect()->route('categories.index');
    }
}
