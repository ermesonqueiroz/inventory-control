<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\AmountUpdate;

class ProductController extends Controller
{
    public function get_all() {
        $products = Product::all();

        return view('app', ['products' => $products]);
    }

    public function create() {
        return view('create');
    }

    public function save(Request $request) {
        $code = [];
        for ($i = 0; $i <= 13; $i++) {
            array_push($code, rand(0, 9));
        }
        $code = implode('', $code);

        Product::create([
            'code' => $code,
            'name' => $request->input('name'),
            'amount' => $request->input('amount'),
            'weight' => $request->input('weight'),
            'currency' => 'BRL',
            'active' => True
        ]);
        return Redirect::to('/');
    }

    public function update(Request $request) {
        $code = $request->input('code');
        $product = Product::where('code', $code)->first();
        $product->name = $request->input('name');
        $product->weight = $request->input('weight');
        $product->save();

        $amount_update = AmountUpdate::where('code', $code)->first();
        if ($amount_update) {
            $amount_update->amount = $request->input('amount');
            $amount_update->done = FALSE;
            $amount_update->save();
        } else {
            AmountUpdate::create([
                'code' => $request->input('code'),
                'amount' => $request->input('amount'),
                'done' => FALSE
            ]);
        }

        return Redirect::to("/");
    }

    public function read(Request $request, string $code) {
        $product = Product::where('code', $code)->first();
        return view('product', ['product' => $product]);
    }

    public function disable(Request $request, string $code) {
        $product = Product::where('code', $code)->first();
        $product->active = FALSE;
        $product->save();
        return Redirect::to("/");
    }

    public function enable(Request $request, string $code) {
        $product = Product::where('code', $code)->first();
        $product->active = TRUE;
        $product->save();
        return Redirect::to("/");
    }

    public function delete(Request $request, string $code) {
        Product::where('code', $code)->first()->delete();
        return Redirect::to("/");
    }

    public function disable_many(Request $request) {
        $codes = explode(',', $request->input("products"));
        foreach ($codes as $code) {
            $product = Product::where('code', $code)->first();
            $product->active = FALSE;
            $product->save();
        }
        return Redirect::to("/");
    }

    public function enable_many(Request $request) {
        $codes = explode(',', $request->input("products"));
        foreach ($codes as $code) {
            $product = Product::where('code', $code)->first();
            $product->active = TRUE;
            $product->save();
        }
        return Redirect::to("/");
    }

    public function delete_many(Request $request) {
        $codes = explode(',', $request->input("products"));
        foreach ($codes as $code) {
            Product::where('code', $code)->first()->delete();
        }
        return Redirect::to("/");
    }
}
