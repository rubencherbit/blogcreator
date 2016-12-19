<div id="main-header-holder">
    <header id="main-header">
        <h1 id="main-title">my_blog_creator</h1>
        <nav id="main-nav">
            <ul id="main-nav-list">
                @if (Auth::check())
                    <li>{{ link_to_route('logout', 'Logout')}}</li>
                @else
                    <li>{{ link_to_route('register', 'Register')}}</li>
                    <li>{{ link_to_route('login', 'Login')}}</li>
                @endif
            </ul>
        </nav>
    </header>
</div>