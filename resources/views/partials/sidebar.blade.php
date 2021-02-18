<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header" style="background-color: #171717;">
        <div class="sidebar-title">
            <p style = "color:white!important;">Navigation</p>
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
    <!-- sidebar navigation -->
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">

                    <li>
                        <a href="{{route('main.index')}}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @if(Auth::user()->role->name == "Administrator")
                        <li class="nav-parent">
                            <a>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>User Management</span>
                            </a>
                            <ul class="nav nav-children">
                                    <li>
                                        <a href="{{route('roles.index')}}">Roles</a>
                                    </li>
                                <li>
                                    <a href="{{route('users.index')}}">Users</a>
                                </li>
                            </ul>
                        </li>
                    <li class="nav-parent">
                        <a>
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <span>Expense Management</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="{{route('categories.index')}}">Expense Categories</a>
                            </li>
                            <li>
                                <a href="{{route('expenses.index')}}">Expenses</a>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-parent">
                        <a>
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <span>Expense Management</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="{{route('expenses.index')}}">Expenses</a>
                            </li>
                        </ul>
                    </li>
                    @endif


                </ul>
            </nav>
        </div>
    </div>
    <!-- end sidebar navigation -->


</aside>
<!-- end: sidebar -->



