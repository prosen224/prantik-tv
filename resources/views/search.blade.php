@extends('welcome', ['title' => $search_with])
@section('main_content')

{{-- Video view start --}}

<div class="py-3 py-md-5 text-center text-white page_subheader" >
	<div class="container-fluid">
		<h2>{{$search_with}}</h2>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb justify-content-center m-0">
		    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Search</li>
		  </ol>
		</nav>
	</div>
</div>
<div class="page_content details_page">
	<div class="row container-fluid pt-3">
        @if($videos->count() > 0)
        @foreach($videos as $video)
        <div class="col-sm-3 mb-3 col-12">
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
        @else
        <h3>No Vedio Found</h3>
        @endif
    </div>
</div>
@endsection