@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pembayaranmu Berhasil Dilakukan
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row container-fluid">                    

                    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" 
                    class="form-horizontal" role="form">
                        <div class="row" style="margin-bottom:40px;">
                            <div class="col-md-8">

                                <p>
                                    <h3> {{ $qrcode->product_name }} <br>
                                        <small> Rp.{{ $qrcode->amount }} </small> </h3>
                                </p>

                                <input type="hidden" name="email" value="acmilrizqy17@gmail.com"> {{-- required --}}
                                <input type="hidden" name="orderID" value="{{ $transaction->id }}">
                                <input type="hidden" name="amount" value="{{ $qrcode->amount*1000 }}"> {{-- required in kobo --}}
                                <input type="hidden" name="quantity" value="1">
                                
                                <input type="hidden" name="metadata" value="{{ json_encode($array = [
                                 'buyer_user_id' => $user->id,
                                 'buyer_user_email' => $user->email,
                                 'qrcode_id'=> $qrcode->id,
                                 'transaction_id'=> $transaction->id
                                 ]) }}" >
                                
                                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}">{{-- required --}}                                       
                                {{ csrf_field() }}                            

                                <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}

                                <p>
                                    <button class="btn btn-success btn-lg" type="submit" value="Pay Now!">
                                        <i class="fa fa-plus-circle fa-lg"></i> Bayar Dengan Paystack!
                                    </button>
                                </p>
                            </div>
                        </div>
                    </form>   
                    
                </div>
            </div>
        </div>
    </div>
@endsection