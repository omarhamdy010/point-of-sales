<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:products_read')->only('index');
        $this->middleware('permission:products_update')->only('edit');
        $this->middleware('permission:products_create')->only('create');
        $this->middleware('permission:products_delete')->only('destroy');
    }

    public function index(Request $request)
    {

        $products = Product::when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(10);


        return view('dashboard.products.index', compact('products',));
    }


    public function create()
    {
        $categories = Category::all();

        return view('dashboard.products.create',compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image',
            'name' => 'required',
        ]);
        $data = $request->except([ 'image']);
        if ($request->image) {
            $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/products/' . $request->image->hashName()));

            $data['image'] = $request->image->hashName();
        }

        $product = Product::create($data);

        Alert::toast('You\'ve Successfully created', 'success');

        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        return view('dashboard.products.edit', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image',
        ]);
        $data = $request->except(['image']);

        if($request->image) {
            if ($product->image != 'default.jpg') {
                Storage::disk('public_uploads')->delete('/products/' . $product->image);
            }
           Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/products/' . $request->image->hashName()));

            $data['image'] = $request->image->hashName();
            $product->update($data);
        }else{
            $data['image'] = $product->image;
            $product->update($data);
        }
        Alert::toast('You\'ve Successfully updated', 'success');
        return redirect()->route('products.index');
    }


    public function destroy(Product $product)
    {
        if ($product->image != 'default.jpg') {
            Storage::disk('public_uploads')->delete('/products/' . $product->image);
        }

        $product->delete();
        Alert::toast('You\'ve Successfully deleted', 'success');

        return redirect()->route('products.index');
    }
}
