<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Paystack;
use Flash;
use App\Models\Transaction;
use App\Models\Qrcode as QrcodeModel;
use App\Models\User;
use App\Models\Account;
use App\Models\AccountHistory;
use Auth;


class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        if ($paymentDetails['data']['status'] != 'success') {
            Flash::error('Maaf, Pembayaran Gagal');

            return redirect()->route('qrcodes.show', ['id' =>$paymentDetails['data']['metadata']['qrcode_id'] ]);
        }

        $qrcode = QrcodeModel::find($paymentDetails['data']['metadata']['qrcode_id']);
        
        if ($qrcode->amount != ($paymentDetails['data']['amount']/100) ) {
            Flash::success('Maaf, Pembayaran Gagal. Tolong Hubungi Admin');

            return redirect()->route('qrcodes.show', ['id' =>$paymentDetails['data']['metadata']['qrcode_id'] ]);
        }

        $transaction = Transaction::where('id',$paymentDetails['data']['metadata']['transaction_id'])->first();

        Transaction::where('id',$paymentDetails['data']['metadata']['transaction_id'])
        ->update(['status'=>'completed']);

        $buyer = User::find($paymentDetails['data']['metadata']['buyer_user_id']);
        $qrcode = User::find($paymentDetails['data']['metadata']['buyer_user_id']);

        $qrCodeOwnerAccount = Account::where('user_id',$qrcode->user_id)->first();
        
        Account::where('user_id',$qrcode->user_id)->update([
            'balance' => ($qrCodeOwnerAccount->balance + $qrcode->amount),
            'total_credit' => ($qrCodeOwnerAccount->total_credit + $qrcode->amount)
        ]);

        AccountHistory::create([
            'user_id' => $qrcode->user_id,
            'account_id' => $qrCodeOwnerAccount->id,
            'message' => 'Menerima '.$transaction->payment_method.' Pembayaran Untuk '. $buyer->email . 'Dari Qrcode: '.$qrcode->product_name 

        ]);

        $buyerAccount = Account::where('user_id',$paymentDetails['data']['metadata']['buyer_user_id'])->first();
        
        Account::where('user_id',$paymentDetails['data']['metadata']['buyer_user_id'])->update([            
            'total_debit' => ($qrCodeOwnerAccount->total_credit + $qrcode->amount)
        ]);

        AccountHistory::create([
            'user_id' => $paymentDetails['data']['metadata']['buyer_user_id'],
            'account_id' => $buyerAccount->id,
            'message' => 'Membayar '.$transaction->payment_method.' Pembayaran Untuk '. $qrcode->user['email'] . 'Dari Qrcode: '.$qrcode->product_name 

        ]);

        Flash::success('Pembayaran Berhasil');
        return redirect(route('transaction.show', ['id'=> $transaction->id]));

    }
}