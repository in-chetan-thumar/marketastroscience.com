<header class="header  {{ Request::routeIs('blog.view') ? 'inner-header' : '' }}">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('frontend/images/logo.gif') }}" alt="Market Astro Science"
                    title="Market Astro Science" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('blog.view') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('blog.view') }}">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link 
                        {{-- {{ Request::routeIs('videos') ? 'active' : '' }} --}}
                         "
                            href="#">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link 
                        {{-- {{ Request::routeIs('contact') ? 'active' : '' }} --}}
                         "
                            href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
