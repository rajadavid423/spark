{{--Header--}}

<div class="header_nav">
    <nav class="navbar navbar-expand-md navbar-dark fixed-topnav shadow p-2" style="background-color: #f9f9f9">
        <div class="border border-top-0 border-bottom-0 border-left-0" style="padding-right: 0.3rem!important;">
        </div>

        <div class="navbar-collapse  justify-content-stretch text-dark" id="navbar7">
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="container">
                        <div class="dropdown">
                            <input class="form-control dropdown-toggle" onkeyup="globalSearch();" style="width: 500px !important;" id="dropdownMenu2" data-toggle="dropdown" type="text" placeholder="Search" aria-label="Search">
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2" id="search_menu_list" style="width: 500px !important;">
{{--                                append data--}}
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <div class="btn-group float-right">
                        <button type="button" class="btn btn-sm d-flex" data-toggle="dropdown" aria-expanded="false">
                            <span class="d-md-block d-none pt-2 pr-3"
                                  style="font-size: 17px;font-weight: 500;">{{ auth()->user()->name ?? '-' }}</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right position-absolute">
                            <a href="{{ route('change-password') }}" class="dropdown-item" type="button">Change Password</a>
                            <a onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="dropdown-item" type="button">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>

            </ul>

        </div>

        <!-- Toggle button -->
        <button id="sidebarCollapse" type="button"
                class="btn button_side_nav rounded-0 shadow-sm px-3 ml-3 d-lg-none d-md-block">
            <i class="fa-solid fa-bars"></i>
        </button>
    </nav>
</div>

{{--Header End--}}
