<div class="sidebar shadow" style="background-color:#d5f7f5">
    <div class="section-top">
        <div class="logo">
            <img src="{{ url('static/images/logo.png')}}" class="img-fluid">
        </div>

        <div class="user">
            <div class="name" style="color:#4f62fa">
                {{Auth::user()->name}}
            </div>
            <div class="email" style="color:#4f62fa">{{Auth::user()->email}}</div>
        </div>
    </div>

    <div class="main">
        <ul>
            <li>
                <a href="{{route('dashboard.index')}}" style="color:#02ccc6"" class="lk-dashboard.index">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home</a>
            </li>

            @can('role-create')
            <li>
                <a href="{{url('/admin/categories/0')}}" class="lk-categories.home lk-categories.add lk-categories.edit lk-categories.delete" style="color:#02ccc6"">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                    Categories</a>
            </li>

            <li><a class="nav-link" href="{{ route('users.index') }}" style="color:#02ccc6"">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                    Manage Users</a>
            </li>

            <li><a class="nav-link" href="{{ route('roles.index') }}" style="color:#02ccc6"">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    Manage Roles</a>
            </li>
            @endcan

            <li>
                <a href="{{url('/admin/libros')}}" class="lk-libros.index lk-libros.create lk-libros.edit lk-libros.destroy " style="color:#02ccc6"">
                    <i class="fa fa-file-text" aria-hidden="true"></i>
                    </i>Documents</a>
            </li>

            <li>
                <a href="{{ route('web.logout') }}" style="color:#02ccc6""><i class="fa fa-sign-out" aria-hidden="true" style="color:#02ccc6""></i>Sign out</a>
            </li>
        </ul>
    </div>
</div>