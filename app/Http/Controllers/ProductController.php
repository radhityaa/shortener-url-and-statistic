<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\Shortener;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:super admin'])->except(['index', 'show']);
    }

    public function index()
    {
        $products = Product::query()->latest()->paginate(9);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update([
            'name'          => $name = $request->name,
            'slug'          => str($name)->slug(),
            'description'   => $request->description,
            'price'         => $request->price
        ]);

        $uniqueKey = $request->short_url_key ?? str()->random(5) . $product->id;

        if ($request->is_short || $request->short_url_key) {
            if ($product->short_url_key) {
                Shortener::where('unique_key', $product->short_url_key)->update([
                    'unique_key'    => $uniqueKey,
                    'short'         => config('app.domain_shortener') . '/' . $uniqueKey
                ]);

                $product->forceFill(['short_url_key' => $uniqueKey])->save();
            } else {
                tap(Shortener::create([
                    'original'      => route('products.show', $product),
                    'unique_key'    => $uniqueKey,
                    'short'         => config('app.domain_shortener') . '/' . $uniqueKey,
                ]), fn ($shortener) => $product->forceFill(['short_url_key' => $uniqueKey])->save());
            }
        }

        return to_route('products.show', $product);
    }

    public function destroy(Product $product)
    {
        //
    }
}
