<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('web.index') }}">Giftme.com</a>
</nav>

<div class="nav-scroller bg-white box-shadow">
    <nav class="nav nav-underline">
        <a class="nav-link @if($selected == 'dashboard') active @endif" href="{{ route('web.index') }}">Dashboard</a>
        <a class="nav-link @if($selected == 'gift') active @endif" href="{{ route('web.gift') }}">Gifts</a>
        <a class="nav-link @if($selected == 'pending_gift') active @endif" href="{{ route('web.pending_gift') }}">Pending Gifts</a>
        <a class="nav-link @if($selected == 'send_gift') active @endif" href="{{ route('web.send_gift') }}">Send Gift</a>
    </nav>
</div>