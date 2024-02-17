<nav>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-lg "data-bs-theme="light">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-danger text-decoration-none" href="">Laravel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Users
                            </a>
                            <ul class="dropdown-menu ">
                                <li><a class="dropdown-item" href="{{ url('users') }}">Users List</a></li>
                                <li><a class="dropdown-item" href="{{ url('users/create') }}">Create User</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Posts
                            </a>
                            <ul class="dropdown-menu ">
                                <li><a class="dropdown-item" href="{{ url('posts') }}">Posts List</a></li>
                                <li><a class="dropdown-item" href="{{ url('posts/create') }}">Create Post</a></li>
                            </ul>
                        </li>
                        </div>
                        @guest
    <!-- Display login and registration buttons for guests -->
    <div>
    <a href="{{ route('login') }}" class="btn btn-link me-1">Login</a>
    <a href="{{ route('register') }}"   class="btn btn-link">Register</a>
    </div>
@endguest

@auth
    <!-- Display logout button for authenticated users -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-link">Logout</button>
    </form>
@endauth
                    </ul>
                </div>
           
        </nav>
    </nav>