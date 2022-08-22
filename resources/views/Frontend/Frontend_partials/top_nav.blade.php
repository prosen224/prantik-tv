    <!-- Nav Section Start -->
    <nav class="navbar navbar-expand-lg navbar-white bg-white mobile_no_x_padding">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('assets/frontend/img/PrantikTvLogo.png')}}" alt="Prantik TV Logo"></a>
        <form class="search_form d-md-none" id="header_search" action="{{route('search')}}" method="get">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Videos" aria-label="Recipient's username" aria-describedby="basic-addon2" name="search_with" value="<?= (isset($_GET["search_with"]))?$_GET["search_with"]:"" ?>">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
          </div>
        </form>
        <button class="navbar-toggler menu-tab" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"><i class="fa-solid fa-bars-staggered"></i></span>
        </button>

          <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fa-solid fa-bars-staggered"></i></span>
          </button> -->
          
          <div class="main_menu">
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
              <button class="menu-close"><i class="fas fa-times"></i></button>
              <form class="search_form" id="header_search" action="{{route('search')}}" method="get">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search Videos" aria-label="Recipient's username" aria-describedby="basic-addon2" name="search_with" value="<?= (isset($_GET["search_with"]))?$_GET["search_with"]:"" ?>">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
              </form>
              <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" href="{{url('/')}}" data-item='Home'>Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('view_video','all')}}" data-item='Videos'>Videos</a>
                  <ul class="dropdown_menu">
                    @php
                      $categories = \App\Models\Category::where('status',1)->get();
                    @endphp
                    @foreach($categories as $category)
                      <li><a href="{{route('view_category',$category->slug)}}">{{$category->name}}</a></li>
                    @endforeach
                    {{-- <li>
                      <a href="">Haddish</a>
                    </li> --}}
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('about')}}" data-item='About Us'>About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('contact-us')}}" data-item='Contact Us'>Contact Us</a>
                </li>
              </ul>
              <a class="btn btn-primary subscribe_btn" href="https://www.youtube.com/channel/UCkOCB0IaR9mRKP5wR8ROTGw" target="_blank">
                Subscribe Us <i class="fab fa-youtube"></i>
              </a>
            </div>
          </div>
      </div>
    </nav>
    <!-- Nav Section End -->