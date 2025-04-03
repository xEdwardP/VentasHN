<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Sale_Detail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleDetailController extends Controller
{
    public function index()
    {
        $title = "Detalles de Ventas";
        $items = Sale::select(
            'sales.*',
            'users.name as user_name'
        )
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->orderBy('sales.created_at', 'desc')
            ->get();
        return view('modules.sales_details.index', compact('title', "items"));
    }

    public function view_details($id)
    {
        $title = "Detalle de venta";
        $sale = Sale::select(
            'sales.*',
            'users.name as user_name'
        )
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->where('sales.id', $id)
            ->firstOrFail();

        $details = Sale_Detail::select(
            'sale_details.*',
            'products.name as product_name'
        )
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->where('sale_id', $id)
            ->get();

        return view('modules.sales_details.sale_details', compact('title', 'sale', 'details'));
    }

    public function revokeSale($id)
    {
        DB::beginTransaction();
        try {
            $details = Sale_Detail::select(
                'product_id',
                'quantity'
            )
                ->where('sale_id', $id)
                ->get();

            foreach ($details as $detail) {
                Product::where('id', $detail->product_id)
                    ->increment('quantity', $detail->quantity);
            }

            Sale_Detail::where('sale_id', $id)->delete();
            Sale::where('id', $id)->delete();

            DB::commit();
            return to_route('sale-details')->with('success', 'Revocacion de venta exitosa!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('sale-details')->with('error', 'No se pudo revocar la venta!');
        }
    }

    public function createTicket($id){
        $sale = Sale::select(
            'sales.*',
            'users.name as user_name'
        )
        ->join('users', 'sales.user_id', '=', 'users.id')
        ->where('sales.id', $id)
        ->firstOrFail();

        $details = Sale_Detail::select(
            'sale_details.*',
            'products.name as product_name'
        )
        ->join('products', 'sale_details.product_id', '=', 'products.id')
        ->where('sale_id', $id)
        ->get();

        //genrara el pdf
        $pdf = Pdf::loadView("modules.sales_details.ticket", compact('sale','details'));
        //descargar el pdf
        return $pdf->stream("ticket_compra_{$sale->id}.pdf");
    }
}
