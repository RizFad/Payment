<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Transaction;


class PrintController extends Controller
{
    public function print()
    {
        $transactions = Transaction::all();
        $pdf = PDF::loadview('transactions.cetak_pdf', ['transactions'=>$transactions]);
        return $pdf->stream();
    }

}
