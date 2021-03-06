{{-- All Users --}}

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{{ route('users.show',['id' => Auth::user()->id]) }}"><i class="fa fa-address-card"></i>
        <span>My Profile</span></a>
</li>

{{-- User --}}
@if (Auth::user()->role_id == 4)
    <li class="{{ Request::is('accounts*') ? 'active' : '' }}">
        <a href="{{ route('accounts.show') }}">
        <i class="fa fa-user-circle"></i><span>My Account</span></a>
    </li>    
@endif
 
<li class="{{ Request::is('qrcodes*') ? 'active' : '' }}">
    <a href="{{ route('qrcodes.index') }}"><i class="fa fa-qrcode"></i><span>Qrcodes</span></a>
</li>

<li class="{{ Request::is('transactions*') ? 'active' : '' }}">
    <a href="{{ route('transactions.index') }}"><i class="fa fa-archive"></i><span>Transactions</span></a>
</li>



{{-- Webmasters --}}
@if (Auth::user()->role_id < 4)
    <li class="{{ Request::is('accounts*') ? 'active' : '' }}">
        <a href="{{ route('accounts.index') }}"><i class="fa fa-credit-card"></i><span>Accounts</span></a>
    </li>

    <li class="{{ Request::is('accountHistories*') ? 'active' : '' }}">
        <a href="{{ route('accountHistories.index') }}"><i class="fa fa-book"></i><span>Account Histories</span></a>
    </li>
@endif

{{-- Supervisor --}}
@if (Auth::user()->role_id < 3)
    <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}"><i class="fa fa-users"></i><span>Users</span></a>
    </li>
    
@endif
    
{{-- Admin --}}
@if (Auth::user()->role_id == 1)
    <li class="{{ Request::is('roles*') ? 'active' : '' }}">
        <a href="{{ route('roles.index') }}"><i class="fa fa-address-book"></i><span>Roles</span></a>
    </li>    
@endif





