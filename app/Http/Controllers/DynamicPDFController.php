<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use App\Models\Transaction;
use App\Http\Controllers\DynamicPDFController;


class DynamicPDFController extends Controller
{
    public function index()
    {
        $transaksi = $this->get_transaction_data();
        return view('transactions.cetak-transaksi')->with('transaksi', $transaksi);
    }

    public function get_transaction_data()
    {
        $transaksi = DB::table('transactions')
            ->limit(10)
            ->get();
        
        return $transaksi;
    }

    public function cetakPdf()
    {
        $pdf =Transaction::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_transaksi_to_html());
        return $pdf->stream();
    }
}
