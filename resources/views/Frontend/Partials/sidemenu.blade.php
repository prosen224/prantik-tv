<nav class="pcoded-navbar menupos-fixed menu-dark menu-item-icon-style6 ">
    <div class="navbar-wrapper ">
        <div class="navbar-brand header-logo">
            <a href="{{route('admin.home')}}" class="b-brand">
                <img width="55" src="{{asset('assets/frontend/img/PrantikTvLogo.png')}}" alt="" class="logo images" width="60%">
                <img width="35" src="{{asset('assets/frontend/img/PrantikTvLogo.png')}}" alt="" class="logo-thumb images" alt="Prantik" width="60%">
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:void(0)"><span></span></a>
        </div>
        <div class="navbar-content scroll-div" >
            <ul class="nav pcoded-inner-navbar">
                <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project" class="nav-item ">
                    <a href="{{route('admin.home')}}" class="nav-link"><span class="pcoded-micon">
                        <i class="fa-solid fa-home"></i>
                    </span>
                    <span class="pcoded-mtext">{{__('Dashboard')}}</span></a>
                </li>
                <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project" class="nav-item ">
                    <a href="{{route('admin.category')}}" class="nav-link"><span class="pcoded-micon"><i class="fa-solid fa-folder-tree"></i></span><span class="pcoded-mtext">{{__('Category')}}</span></a>
                </li>
                <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project" class="nav-item ">
                    <a href="{{route('admin.videos')}}" class="nav-link"><span class="pcoded-micon"><i class="fa-solid fa-play"></i></span><span class="pcoded-mtext">{{__('Videos')}}</span></a>
                </li>
                <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project" class="nav-item ">
                    <a href="{{route('admin.about-us')}}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="fa-solid fa-address-card"></i>
                        </span>
                        <span class="pcoded-mtext">{{__('About Us')}}</span>
                    </a>
                </li>
                <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project" class="nav-item ">
                    <a href="{{route('admin.dcma')}}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="fa-solid fa-landmark-dome"></i>
                        </span>
                        <span class="pcoded-mtext">{{__('DCMA')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
