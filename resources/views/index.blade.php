@extends('welcome', ['title' => 'Home'])
@section('main_content')
@include('Frontend.Frontend_partials.main_banner')
    <!-- Categories Boxes Starts -->
      <div class="container-fluid category_sec" id="category_sec">
        <div class="cat_slider">
            @foreach($category as $v)
              <a href="{{route('view_category',$v->slug)}}">
                <div class="">
                  <div class="category_box card text-center py-5 px-1">
                    <p>{{$v->name}}</p>
                  </div>
                </div>
              </a>
            @endforeach
        </div>
      </div>
  
      <!-- Categories Boxes Starts -->
  
      <!-- Popular Section Starts -->
      <section class="section_holder has_bg popular_section" id="popular_sec">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center text-white">
              <div class="section_heading_holder">
                <h2 class="section_heading">Most Popular</h2>
                <a href="{{route('view_category', 'most-popular')}}" class="view_link text-white">view All<i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
          <div class="row most_popular_slider video_box_holder">
            @foreach ($most_popular as $item)
            <div class="col-md-4">
              <div class="video_box">
                <a href="{{route('view_video',$item->slug)}}">
                  <div class="video_thumb">
                    <img src="{{asset('uploads/thumb_image/'.$item->thumb_image)}}" class="video_thum_img img-fluid" alt="{{$item->title}}">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="{{route('view_video',$item->slug)}}">{{$item->title}}</a></h2>
                </div>
                <div class="video_share_option">
                  {{-- <span><i class="fas fa-share-alt"></i></span> --}}
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </section>
      <!-- Popular Section Ends -->

      @foreach($category_video as $k=>$v)

      @if($v->count() > 0)
      <!-- Video Section Starts -->
      <section class="section_holder has_bg video_section video_box_holder">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="section_heading_holder">
                <h2 class="section_heading">{{$k}}</h2>
                <a href="{{route('view_category', $category_model->getSlugbyId($v[0]->category_id))}}" class="view_link">view All<i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
          <div class="row video_grid_slider">
            @foreach($v as $video)
              <div class="col-sm-3 col-6">
                <div class="video_box">
                  <a href="{{route('view_video',$video->slug)}}">
                    <div class="video_thumb">
                      <img src="{{asset('uploads/thumb_image/'.$video->thumb_image)}}" class="video_thum_img img-fluid" alt="Video Thumb">
                    </div>
                  </a>
                  <div class="video_title">
                    <h2><a href="{{route('view_video',$video->slug)}}">{{$video->title}}</a></h2>
                  </div>
                  <div class="video_share_option">
                    {{-- <span><i class="fas fa-share-alt"></i></span> --}}
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
      <!-- Video Section Ends -->
      @endif
      @endforeach


      <!-- Video Section Starts -->
      <!-- <section class="section_holder has_bg video_section">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="section_heading_holder">
                <h2 class="section_heading">Haddish</h2>
                <a href="" class="view_link">view All<i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
          <div class="row gx-2 gy-2 reveal fade-bottom">
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> -->
      <!-- Video Section Ends -->
  
      <!-- Video Section Starts -->
      <!-- <section class="section_holder has_bg video_section">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="section_heading_holder">
                <h2 class="section_heading">Jumar Biaan</h2>
                <a href="" class="view_link">view All<i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
          <div class="row gx-2 gy-2 reveal fade-bottom">
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-3 col-6">
              <div class="video_box">
                <a href="">
                  <div class="video_thumb">
                    <img src="{{asset('assets/frontend/img/thumb1.jpg')}}" class="video_thum_img img-fluid" alt="Video Thumb">
                  </div>
                </a>
                <div class="video_title">
                  <h2><a href="">আপনিই আমাকে মাফ করে দিন || হযরত ওমর (রাঃ)</a></h2>
                </div>
                <div class="video_share_option">
                  <span><i class="fas fa-share-alt"></i></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> -->
      <!-- Video Section Ends -->

      <div class="for_home_footer" style="margin-top: 100px;"></div>
      @endsection