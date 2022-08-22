    <!-- Footer Section Start -->
    <footer class="footer_sction">
        <div class="footer_top">
          <div class="container-fluid">
              <div class="row clearfix">
                  <div class="col-md-4 footer_widget">
                      <img src="{{asset('assets/frontend/img/footer_logo.png')}}" >
                      <p>
                          @php
                              $content = preg_replace("/<img[^>]+\>/i", " ", \App\Models\Aboutus::find(1)->description);
                              $result = strip_tags($content);
                          @endphp
                          {!! substr($result, 0, 20) !!} <a href="{{route('about')}}" title="About Us"> .... </a>
                        </p>
                      <div class="footer_widget_content">
                          <div class="footer_social">
                              <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                              <a href="https://www.youtube.com/channel/UCkOCB0IaR9mRKP5wR8ROTGw" target="_blank"><i class="fab fa-youtube"></i></a>
                              <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                              <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                          </div>
                      </div>
                  </div>
                  <div class="col-6 col-md-3 footer_widget">
                      <h4 class="footer_widget_title">Explore Categories</h4>
                      <div class="footer_widget_content">
                          <ul class="footer-menu-items">
                              @php
                                $categories = \App\Models\Category::where('status',1)->get();
                              @endphp
                              @foreach($categories as $item)
                              <li class="menu-item"><a href="{{route('view_category',$item->slug)}}" class="menu-link">{{$item->name}}</a></li>
                              @endforeach
                              {{-- <li class="menu-item"><a href="" class="menu-link">Haddish</a></li>
                              <li class="menu-item"><a href="" class="menu-link">Jumar Biaan</a></li>
                              <li class="menu-item"><a href="" class="menu-link">Masque</a></li> --}}
                          </ul>
                      </div>
                  </div>
                  <div class="col-6 col-md-3 footer_widget">
                      <h4 class="footer_widget_title">Informations</h4>
                      <div class="footer_widget_content">
                          <ul class="footer-menu-items">
                              <li class="menu-item"><a href="{{route('about')}}" class="menu-link">About Us</a></li>
                              <li class="menu-item"><a href="{{route('contact-us')}}" class="menu-link">Contact us</a></li>
                              <li class="menu-item"><a href="https://www.youtube.com/channel/UCkOCB0IaR9mRKP5wR8ROTGw" class="menu-link">Subscribe Us</a></li>
                              <li class="menu-item"><a href="{{route('dcma')}}" class="menu-link">DMCA</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="copyright">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-6">
                    <p> Copyright {{date("Y")}} PRANTIK TV All Rights Reserved.</p>
                </div>
                <div class="col-md-6">
                    <p class="copyright_right">Designed & Developed by <a href="http://coder71.com/" target="_blank"><img src="{{asset('assets/frontend/img/coder71Logo.png')}}" alt="Coder71"></a></p>
                </div>
                </div>
            </div>
        </div>
    </footer>


      <!-- Footer Section End -->
  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Optional JavaScript; choose one of the two! -->
  
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="{{asset('assets/frontend/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  
      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
      -->
  
      <!-- Slick Slider -->
      <script type="text/javascript" src="{{asset('assets/frontend/slick/slick.min.js')}}"></script>
  
      <script type="text/javascript" src="{{asset('assets/frontend/js/main.js')}}"></script>

      