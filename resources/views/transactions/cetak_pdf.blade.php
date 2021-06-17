<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <title>Kelompok Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


</head>
    <body>
        {{-- <p>Hello World</p> --}}



    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table" id="transactions-table">
                    <thead>
                        <tr>                
                            <th>Qrcode</th>
                            <th>Pembeli</th>
                            <th>Metode Pembayaran</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>                
                            <td>
                                <a href="{!! route('transactions.show', [$transaction->id]) !!}">
                                    {!! $transaction->qrcode['product_name'] !!}
                                </a>
                                <small>| {{ $transaction->created_at->format('D d, M, Y h:i') }} </small>
                            </td>
                            <td>{!! $transaction->user['name'] !!}</td>
                            <td>{!! $transaction->payment_method !!}</td>
                            <td>Rp.{!! $transaction->amount !!}</td>
                            <td>Completed<br/> 
                                <small>| {{ $transaction->updated_at->format('D d, M, Y h:i') }} </small>
                            </td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
    </body>
</html>




