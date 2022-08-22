@extends('welcome', ['title' => $category_name])
@section('main_content')

<div class="page_subheader py-3 py-md-5 text-center text-white">
	<div class="container-fluid">
		<h2>{{$category_name}}</h2>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb justify-content-center m-0">
		    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Category</li>
		  </ol>
		</nav>
	</div>
</div>
<!-- Video Section Starts -->
<section class="section_holder has_bg video_section" style="padding:40px 0 0;">
        <div class="container-fluid">
          {{-- <div class="row">
            <div class="col-md-12 text-center">
              <div class="section_heading_holder">
                <h2 class="section_heading">{{$category_name}}</h2>
                <!-- <a href="route" class="view_link">view All<i class="fas fa-arrow-right"></i></a> -->
              </div>
            </div>
          </div> --}}

          <div class="row">
            @if($videos->count() > 0)
            @foreach($videos as $video)
              <div class="col-sm-3 mb-4 col-12">
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
            <div class="row mt-4">
              {{$videos->links()}}
            </div>
            @else
            <div class="col-md-12 text-center">
              <h2>No Video Found</h2>
          </div>
          @endif
        </div>
      </section>
      <!-- Video Section Ends -->

@endsection