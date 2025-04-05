<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Sale_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SaleController extends Controller
{
    public function index()
    {
        $title = "Ventas";
        $items = Product::all();
        return view('modules.sales.index', compact('title', 'items'));
    }

    public function addCart($idproduct)
    {
        $item = Product::find($idproduct);
        $stock = $item->quantity;

        $cartItems = Session::get('cartItems', []);

        $response = false;

        foreach ($cartItems as $key => $cart) {
            if ($cart['id'] == $idproduct) {
                if ($cart['quantity'] >= $stock) {
                    return to_route('new-sale')->with('error', 'No hay stock suficiente!!!');
                }
                $cartItems[$key]['quantity'] += 1;
                $response = true;
                break;
            }
        }

        if (!$response) {
            $cartItems[] = [
                'id' => $item->id,
                'code' => $item->code,
                'name' => $item->name,
                'quantity' => 1,
                'price' => $item->selling_price
            ];
        }

        Session::put('cartItems', $cartItems);


        return to_route('new-sale');
    }

    public function deleteCart()
    {
        Session::forget('cartItems');
        return to_route('new-sale');
    }


    public function removeCart($idproduct)
    {
        $cartItems = Session::get('cartItems', []);
        foreach ($cartItems as $key => $cart) {
            if ($cart['id'] == $idproduct) {
                if ($cart['quantity'] > 1) {
                    $cartItems[$key]['quantity'] -= 1;
                } else {
                    unset($cartItems[$key]);
                }
                break;
            }
        }
        Session::put('cartItems', $cartItems);
        return to_route('new-sale');
    }

    public function makeSale()
    {
        $cartItems = Session::get('cartItems', []);

        if (empty($cartItems)) {
            return to_route('new-sale')->with('error', 'El carrito esta vacio!');
        }

        DB::beginTransaction();
        try {
            $total = 0;

            foreach ($cartItems as $item) {
                $total += $item['quantity'] * $item['price'];
            }

            $sale = new Sale();
            $sale->user_id = Auth::id();
            $sale->total = $total;
            $sale->save();

            foreach ($cartItems as $item) {
                $product = Product::find($item['id']);
                if ($product->quantity < $item['quantity']) {
                    DB::rollback();
                    return to_route('new-sale')->with('error', 'No hay stock suficiente para ' . $product->name);
                }

                $detail = new Sale_Detail();
                $detail->sale_id = $sale->id;
                $detail->product_id = $item['id'];
                $detail->quantity = $item['quantity'];
                $detail->unit_price = $item['price'];
                $detail->subtotal = $item['quantity'] * $item['price'];
                $detail->save();

                $product->quantity -= $item['quantity'];
                $product->save();
            }
            Session::forget('cartItems');
            DB::commit();
            return to_route('new-sale')->with('success', 'Venta realizada con exito!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('new-sale')->with('error', 'Error al procesar la venta!' . $th->getMessage());
        }
    }
}
