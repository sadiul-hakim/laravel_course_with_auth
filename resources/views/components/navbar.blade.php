<nav style="display: flex;background-color: #44404094;color:white; padding:10px;">
    {{-- @props(['type'=>'error']) to add some default values to attribute. This value could be overridden while calling component --}}
    <a href="/" style="margin-right: 100px;">Logo</a>
    <div>

        <a href="/">Home</a>
        @auth
            <a href="/dashboard">Dashboard</a>
            <a href="/profile">Profile</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth
        @guest
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        @endguest
    </div>
</nav>
