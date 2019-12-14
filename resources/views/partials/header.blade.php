 <!-- start: header -->
 <header class="header">
    <div class="logo-container">
        <a href="/" class="logo text-danger">
            <img src="{{asset('assets/images/device.png')}}" height="35" alt="TUP Logo" />
            <b class="hidden-xs">Expense Manager</b>
            <b class="visible-xs" style="float:right;">E-Manager</b>
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="header-right">


        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="{{asset('assets/images/group.png')}}" alt="Profile Image" class="img-circle" data-lock-picture="{{asset('assets/images/device.jpg')}}" />
                </figure>
                
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                    @if(Auth::check())
                        <span class="name">{{Auth::user()->full_name}}</span>
                        <span class="role">{{Auth::user()->role->name}}</span>
                    @endif
                </div>
                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
                    <li>
                        <a role="menuitem" a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off"></i> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>

</div>
<!-- end: notification & user box -->
</header>
<!-- end: header -->
