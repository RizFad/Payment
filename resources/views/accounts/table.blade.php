<div class="table-responsive">
    <table class="table" id="accounts-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Balance</th>
                <th>Total Credit</th>
                <th>Total Debit</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accounts as $account)
            <tr>
                @if (Auth::user()->role_id < 4)
                    
                <td>
                <a href="{{ route('accounts.show', [$account->id]) }}">
                    {{ $account->user['name'] }}
                </a>
                </td>
                <td>Rp.{{ number_format($account->balance) }}</td>
                <td>Rp.{{ number_format($account->total_credit) }}</td>
                <td>Rp.{{ number_format($account->total_debit) }}</td>
                <td>
                    <i class="fa fa-check-square text-green"></i>
                </td>
                <td>
                    {!! Form::open(['route' => ['accounts.destroy', $account->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accounts.edit', [$account->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {{-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
                    </div>
                    {!! Form::close() !!}
                </td>

                @elseif(Auth::user()->id == $account->user_id)

                <td>
                <a href="{{ route('accounts.show', [$account->id]) }}">
                    {{ $account->user['name'] }}
                </a>
                </td>
                <td>Rp.{{ number_format($account->balance) }}</td>
                <td>Rp.{{ number_format($account->total_credit) }}</td>
                <td>Rp.{{ number_format($account->total_debit) }}</td>
                <td>
                     @if($account->applied_for_payout == 1)
                     Payment Pending
                     @elseif($account->paid == 1)
                     Paid
                     @endif

                </td>
                <td>
                    {!! Form::open(['route' => ['accounts.destroy', $account->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accounts.edit', [$account->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {{-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} --}}
                    </div>
                    {!! Form::close() !!}
                </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
