<div class="header">


    <ul class="nav nav-pills pull-right">
        @if ($currentUser)
            <li class="active">
                <a href="{{ route('posts.create') }}">
                    <i class="fa fa-pencil-square-o"></i>New Post
                </a>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" href="#">
                <i class="fa fa-user"></i>{{ $currentUser->display_name }}
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                @if ($currentUser->can("manage_contents"))
                    <li><a href="{{ URL::to('admin') }}"><i class="fa fa-tachometer"></i> Admin Panel</a></li>
                @endif
                 <li><a href="{{ route('users.settings') }}"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>

        @else
            <li ><a href="{{ route('signup') }}">SignUp</a></li>
            <li class="active"><a href="{{ route('login') }}">Login</a></li>
        @endif

    </ul>
    <a href="{{ route('home') }}">
        <h2 class="text-muted brand">Laravel</h2>
    </a>

</div>
