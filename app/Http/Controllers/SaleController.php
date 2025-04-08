<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
        $title = "Realizar Venta";
        $items = Product::all();
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->where('country_id', 1)->get();
        $cities = DB::table('cities')->where('state_id', $states->first()->id ?? 0)->get();

        // Calcular total del carrito
        $total = 0;
        if (session('cartItems')) {
            foreach (session('cartItems') as $item) {
                $total += $item['quantity'] * $item['price'];
            }
        }

        return view('modules.sales.index', compact(
            'title',
            'items',
            'countries',
            'states',
            'cities',
            'total'
        ));
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

    // public function makeSale(Request $request)
    // {
    //     $cartItems = Session::get('cartItems', []);

    //     if (empty($cartItems)) {
    //         return to_route('new-sale')->with('error', 'El carrito esta vacio!');
    //     }

    //     DB::beginTransaction();
    //     try {
    //         $total = 0;

    //         foreach ($cartItems as $item) {
    //             $total += $item['quantity'] * $item['price'];
    //         }

    //         try {
    //             if (!empty($request->customer_id)) {
    //                 $response = Customer::find($request->customer_document);

    //                 if ($response) {
    //                     $customerId = $response->id;
    //                 } else {
    //                     $newCustomer = new Customer();
    //                     $newCustomer->document = $request->customer_document;
    //                     $newCustomer->name = 'Cliente';
    //                     $newCustomer->type = 'minorista';
    //                     $newCustomer->city_id = 1;
    //                     $customerId = $newCustomer->id;
    //                     $newCustomer->save();
    //                 }
    //             } else {
    //                 $customerId = "1";
    //             }
    //         } catch (\Throwable $th) {
    //             DB::rollBack();
    //             return to_route('new-sale')->with('error', 'Error al tratar de crear el cliente!' . $th->getMessage());
    //         }

    //         $sale = new Sale();
    //         $sale->user_id = Auth::id();
    //         $sale->city_id = $request->city_id;
    //         $sale->customer_id = $customerId;
    //         $sale->total = $total;
    //         $sale->save();

    //         foreach ($cartItems as $item) {
    //             $product = Product::find($item['id']);
    //             if ($product->quantity < $item['quantity']) {
    //                 DB::rollback();
    //                 return to_route('new-sale')->with('error', 'No hay stock suficiente para ' . $product->name);
    //             }

    //             $detail = new Sale_Detail();
    //             $detail->sale_id = $sale->id;
    //             $detail->product_id = $item['id'];
    //             $detail->quantity = $item['quantity'];
    //             $detail->unit_price = $item['price'];
    //             $detail->subtotal = $item['quantity'] * $item['price'];
    //             $detail->save();

    //             $product->quantity -= $item['quantity'];
    //             $product->save();
    //         }
    //         Session::forget('cartItems');
    //         DB::commit();
    //         return to_route('new-sale')->with('success', 'Venta realizada con exito!');
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         return to_route('new-sale')->with('error', 'Error al procesar la venta!' . $th->getMessage());
    //     }
    // }

    public function makeSale(Request $request)
    {
        $cartItems = Session::get('cartItems', []);

        if (empty($cartItems)) {
            return to_route('new-sale')->with('error', 'El carrito está vacío!');
        }

        DB::beginTransaction();
        try {
            $total = 0;
            $customerId = 1;

            foreach ($cartItems as $item) {
                $product = Product::findOrFail($item['id']);
                if ($product->quantity < $item['quantity']) {
                    DB::rollback();
                    return to_route('new-sale')->with('error', 'No hay stock suficiente para ' . $product->name);
                }
                $total += $item['quantity'] * $item['price'];
            }

            if (!empty($request->customer_document)) {
                $customer = Customer::where('document', $request->customer_document)->first();

                if (!$customer) {
                    $newCustomer = Customer::create([
                        'document' => $request->customer_document,
                        'name' => 'Cliente Temporal',
                        'type' => 'minorista',
                        'city_id' => 1
                    ]);

                    $customerId = $newCustomer->id;
                } else {
                    $customerId = $customer->id;
                }
            }

            $sale = new Sale();
            $sale->user_id = Auth::id();
            $sale->city_id = $request->city_id;
            $sale->customer_id = $customerId;
            $sale->total = $total;
            $sale->save();

            foreach ($cartItems as $item) {
                $detail = new Sale_Detail();
                $detail->sale_id = $sale->id;
                $detail->product_id = $item['id'];
                $detail->quantity = $item['quantity'];
                $detail->unit_price = $item['price'];
                $detail->subtotal = $item['quantity'] * $item['price'];
                $detail->save();

                $product = Product::find($item['id']);
                $product->quantity -= $item['quantity'];
                $product->save();
            }

            Session::forget('cartItems');
            DB::commit();
            return to_route('new-sale', $sale->id)->with('success', 'Venta realizada con éxito!');
            // return to_route('detail.ticket', $sale->id)->with('success', 'Venta realizada con éxito!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('new-sale')->with('error', 'Error al procesar la venta: ' . $th->getMessage());
        }
    }

    // public function makeSale(Request $request)
    // {
    //     $cartItems = Session::get('cartItems', []);

    //     if (empty($cartItems)) {
    //         return to_route('new-sale')->with('error', 'El carrito está vacío!');
    //     }

    //     DB::beginTransaction();
    //     try {
    //         $total = 0;
    //         $customerId = null; // Inicializamos como null

    //         foreach ($cartItems as $item) {
    //             $product = Product::findOrFail($item['id']);
    //             if ($product->quantity < $item['quantity']) {
    //                 DB::rollback();
    //                 return to_route('new-sale')->with('error', 'No hay stock suficiente para ' . $product->name);
    //             }
    //             $total += $item['quantity'] * $item['price'];
    //         }

    //         if (!empty($request->customer_document)) {
    //             $customer = Customer::where('document', $request->customer_document)->first();

    //             if (!$customer) {
    //                 $newCustomer = new Customer();
    //                 $newCustomer->document = $request->customer_document;
    //                 $newCustomer->name = 'Cliente Temporal';
    //                 $newCustomer->type = 'minorista';
    //                 $newCustomer->city_id = 1;
    //                 $newCustomer->save(); // PRIMERO guardamos
    //                 $customerId = $newCustomer->id; // LUEGO obtenemos el ID
    //             } else {
    //                 $customerId = $customer->id;
    //             }
    //         }

    //         // Si no se proporcionó documento o no se encontró cliente
    //         if (empty($customerId)) {
    //             $customerId = 1; // Solo como último recurso
    //         }

    //         $sale = new Sale();
    //         $sale->user_id = Auth::id();
    //         $sale->city_id = $request->city_id;
    //         $sale->customer_id = $customerId;
    //         $sale->total = $total;
    //         $sale->save();

    //         foreach ($cartItems as $item) {
    //             $detail = new Sale_Detail();
    //             $detail->sale_id = $sale->id;
    //             $detail->product_id = $item['id'];
    //             $detail->quantity = $item['quantity'];
    //             $detail->unit_price = $item['price'];
    //             $detail->subtotal = $item['quantity'] * $item['price'];
    //             $detail->save();

    //             $product = Product::find($item['id']);
    //             $product->quantity -= $item['quantity'];
    //             $product->save();
    //         }

    //         Session::forget('cartItems');
    //         DB::commit();
    //         return to_route('new-sale')->with('success', 'Venta realizada con éxito!');
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         return to_route('new-sale')->with('error', 'Error al procesar la venta: ' . $th->getMessage());
    //     }
    // }
}
