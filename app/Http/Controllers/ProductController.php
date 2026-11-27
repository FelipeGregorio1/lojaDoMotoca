<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $data = $this->prepareProductData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect('/product');
    }

    public function index()
    {
        return view('product.index', ['products' => Product::with('Category')->get()]);
    }

    public function edit(Product $product)
    {
        return view('product.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->prepareProductData($request);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect('/product');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect('/product');
    }

    private function prepareProductData(Request $request): array
    {
        // Converte preço com vírgula (ex: 1.299,90) para formato decimal
        $rawPrice = (string) $request->input('price', '0');
        if (str_contains($rawPrice, ',')) {
            $rawPrice = str_replace('.', '', $rawPrice);
            $rawPrice = str_replace(',', '.', $rawPrice);
        }
        $cleanPrice = (float) preg_replace('/[^0-9.]/', '', $rawPrice);

        $hasSizes = $request->boolean('has_sizes');
        $sizes = null;
        $totalStock = max(0, (int) $request->input('stock', 0));

        if ($hasSizes) {
            $sizeNames = $request->input('size_names', []);
            $sizeStocks = $request->input('size_stocks', []);
            $parsedSizes = [];
            $totalStock = 0;

            foreach ($sizeNames as $index => $sizeName) {
                $trimmedName = trim((string) $sizeName);
                if ($trimmedName === '') {
                    continue;
                }
                $qty = max(0, (int) ($sizeStocks[$index] ?? 0));
                $parsedSizes[] = [
                    'size' => $trimmedName,
                    'stock' => $qty,
                ];
                $totalStock += $qty;
            }

            $sizes = $parsedSizes;
        }

        return [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'price' => $cleanPrice,
            'stock' => $totalStock,
            'has_sizes' => $hasSizes,
            'sizes' => $sizes,
            'brand' => $request->input('brand'),
            'warranty' => $request->input('warranty'),
            'availability' => $request->input('availability'),
            'origin' => $request->input('origin'),
        ];
    }
}