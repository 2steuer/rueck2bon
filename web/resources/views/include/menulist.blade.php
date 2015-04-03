<ul class="{{ $nav_classes }}">
    @if(Auth::guest())
        <li class="active"><a href="{{ route('users.login') }}">Login</a></li>
    @else
            <li class="{{ Request::segment(1) == 'persons' ? 'active' : false }}"><a href="{{ route('persons.index') }}">Personen</a></li>
            <li class="{{ Request::segment(1) == 'users' ? 'active' : false }}"><a href="{{ route('users.index') }}">Benutzer</a> </li>
        <li><a href="{{ route('users.logout') }}">Ausloggen</a></li>
    @endif
</ul>