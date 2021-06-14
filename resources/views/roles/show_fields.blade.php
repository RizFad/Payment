
<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $role->created_at->format('D d, M, Y') }}</p>
</div>

<h3 class="text-center">User Memiliki Peran Berikut Ini</h3>
@include('users.table')