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

