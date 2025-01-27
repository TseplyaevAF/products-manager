<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Jobs\SendNewProductInfoJob;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\Facades\Gate;

class MainController extends Controller
{
    private $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index() {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function show(Product $product) {
        $statuses = config('products.statuses');
        $product->data = json_decode($product->data);
        return view('product.show', compact('product', 'statuses'));
    }

    public function create() {
        return view('product.create');
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();

        try {
            $product = $this->service->store($data);
            $this->dispatch(new SendNewProductInfoJob($product));
        } catch (\Exception $exception) {
            return redirect()->back()->with(['msg' => 'При добавлении записи произошла ошибка!']);
            // TO-DO: save messages from $exception to logs.txt
        }

        return redirect()->back()->withSuccess('Запись успешно добавлена!');
    }

    public function edit(Product $product) {
        $statuses = config('products.statuses');
        $product->data = json_decode($product->data);
        $product->status = $statuses[$product->status]['value'];
        return view('product.edit', compact('product'));
    }

    public function update(UpdateRequest $request, Product $product) {
        $data = $request->validated();
        Gate::authorize('update-article', [$data, $product]);

        try {
            $this->service->update($data, $product);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['msg' => 'При обновлении записи произошла ошибка!']);
            // TO-DO: save messages from $exception to logs.txt
        }

        return redirect()->back()->withSuccess('Запись успешно обновлена!');
    }

    public function delete(Product $product) {
        $product->delete();
        return redirect()->route('product.index');
    }
}