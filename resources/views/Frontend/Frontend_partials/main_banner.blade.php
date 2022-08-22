<section class="banner_sec" id="banner_sec">

  {{-- @foreach($featured as $v)
    <div class="banner_image">
      <img src="{{asset('uploads/thumb_image/'.$v->thumb_image)}}" class="img-fluid banner_static_image" alt="PrantikTV Banner">
    </div>
    <div class="banner_text text-white">
      <h1 class="banner_heading">{{$v->title}}</h1>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
      <button class="btn btn-primary">Play Now<i class="fa-solid fa-play"></i></button>
    </div>
    @endforeach --}}
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        @php
          $i=1;
        @endphp
        @foreach($featured as $v)
        <div class='carousel-item  <?=($i == 1)?"active":"" ?>' >
          @if($v->banner_image && file_exists(public_path('uploads/banner_image/'.$v->banner_image)))
          <img class="d-block w-100" src="{{asset('uploads/banner_image/'.$v->banner_image)}}" style="height: 500px" alt="First slide">
          @else
          <img class="d-block w-100" src="{{asset('assets/frontend/img/not_found.png')}}" style="height: 500px" alt="First slide">
          @endif
          <div class="banner_text text-white">
            <h1 class="banner_heading">{{$v->title}}</h1>
            <?php //dd(substr($v->description, 0, 100)); ?>
            <p> {!! (strlen($v->description)>250)? substr($v->description, 0, 250):$v->description !!} </p>
            {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p> --}}
            <a class="btn btn-primary" href="{{route("view_video",$v->slug)}}" >Play Now<i class="fa-solid fa-play"></i></a>
          </div>
        </div>
        @php
          $i++;
        @endphp
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon " aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</section>

