<div class="topbar">
    <!-- Navbar -->
    <nav class="navbar-custom" id="navbar-custom">
        <ul class="list-unstyled topbar-nav float-end mb-0">

            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user" data-bs-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <img src="{{asset('assets/images/users\\').auth()->user()->image}}" alt="profile-user" class="rounded-circle me-2 thumb-sm" />
                        <div>
                            <span class="d-none d-md-block fw-semibold font-12">{{auth()->user()->getFullNameAttribute()}}<i class="mdi mdi-chevron-down"></i></span>
                            <small class="d-none d-md-block font-11">{{auth()->user()->role->description}}</small>

                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#"><i class="ti ti-user font-16 me-1 align-text-bottom"></i> نمایه</a>
                    <a class="dropdown-item" href="#"><i class="ti ti-settings font-16 me-1 align-text-bottom"></i> تنظیمات</a>
                    <div class="dropdown-divider mb-0"></div>
                    <button class="dropdown-item" id="logout" type="button" ><i class="ti ti-power font-16 me-1 align-text-bottom"></i> خروج </button>
                </div>
            </li><!--end topbar-profile-->
{{--            <li class="notification-list">--}}
{{--                <a class="nav-link arrow-none nav-icon offcanvas-btn" href="#" data-bs-toggle="offcanvas" data-bs-target="#Appearance" role="button" aria-controls="Rightbar">--}}
{{--                    <i class="ti ti-settings ti-spin"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul><!--end topbar-nav-->

        <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button class="nav-link button-menu-mobile nav-icon" id="togglemenu">
                    <i class="ti ti-menu-2"></i>
                </button>
            </li>
        </ul>
    </nav>
    <!-- end navbar-->
</div>

<form id="logoutForm" method="post" action="{{route('logout')}}">
    @csrf
</form>
<script>
    $(document).ready(function (){
        $("#logout").click(function (){
            document.getElementById('logoutForm').submit();
        })
    })
</script>
