<div class="table-responsive">
    <table class="table" id="accountHistories-table">
        <thead>
            <tr>
                
                <th>User</th>
                <th>Account Id</th>
                <th>Message</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accountHistories as $accountHistory)
            <tr>
                <td>{{ $accountHistory->user['email'] }}</td>
                <td>{{ $accountHistory->account_id }}</td>
                <td>{{ $accountHistory->message }}</td>
                <td>
                    {!! Form::open(['route' => ['accountHistories.destroy', $accountHistory->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accountHistories.show', [$accountHistory->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('accountHistories.edit', [$accountHistory->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
