<div class="left-sidebar">
    <!-- LOGO -->
    <div class="brand">
        <a href="{{route('dashboard')}}" class="logo">
                    <span>
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="logo-small" class="logo-sm">
                    </span>
            <span>
                        <img src="{{asset('assets/images/logo.png')}}" alt="logo-large" class="logo-lg logo-light">
                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo-large" class="logo-lg logo-dark">
                    </span>
        </a>
    </div>
    <div class="sidebar-user-pro media border-end">
        <div class="position-relative mx-auto">
            <img src="{{asset('assets/images/users\\').auth()->user()->image}}" alt="کاربر"
                 class="rounded-circle thumb-md">
            <span class="online-icon position-absolute end-0"><i class="mdi mdi-record text-success"></i></span>
        </div>
        <div class="media-body ms-2 user-detail align-self-center">
            <h5 class="font-14 m-0 fw-bold">{{auth()->user()->getFullNameAttribute()}}</h5>
            <p class="opacity-50 mb-0 font-10">{{auth()->user()->email}}</p>
        </div>
    </div>

    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <div class="menu-body navbar-vertical">
            <div class="collapse navbar-collapse tab-content" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav tab-pane active" id="Main">
                    @php
                        $menu = auth()->user()->role->available_menu();
                    @endphp
                    @foreach ($menu as $item)
                        @if($item->children->count() == 0)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route($item->route_name)}}">
                                    @if($item->icon)
                                        <i class="ti ti-{{$item->icon}} menu-icon"></i><span> {{$item->name}}</span>
                                    @else
                                        {{$item->name}}
                                    @endif
                                </a>
                            </li><!--end nav-item-->
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="#sidebar{{$item->id}}" data-bs-toggle="collapse" role="button"
                                   aria-expanded="false" aria-controls="sidebar{{$item->id}}">
                                    <i class="ti ti-{{$item->icon}} menu-icon"></i>
                                    <span> {{$item->name}} </span>
                                </a>
                                <div class="collapse" id="sidebar{{$item->id}}">
                                    <ul class="nav flex-column">
                                        @foreach ($item->children as $child)
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route($child->route_name)}}"> {{$child->name}}</a>
                                            </li><!--end nav-item-->
                                        @endforeach
                                    </ul><!--end nav-->
                                </div><!--end sidebarAnalytics-->
                            </li><!--end nav-item-->
                        @endif
                    @endforeach
                </ul>
            </div><!--end sidebarCollapse-->
        </div>
    </div>
</div>
