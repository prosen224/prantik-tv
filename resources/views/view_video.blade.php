@extends('welcome', ['title' => $slug !="all"?$video->title:"All Videos"])
@section('css')
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.12/plyr.css" />
@endsection
@section('main_content')

{{-- Video view start --}}

<div class="page_subheader py-3 py-md-5 text-center text-white">
	<div class="container-fluid">
		<h2>{{$slug !="all"?$video->title:"All Videos"}}</h2>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb justify-content-center m-0">
		    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Videos</li>
		  </ol>
		</nav>
	</div>
</div>

<div class="page_content details_page container-fluid" style="padding:40px 0 0;">
	@if($slug !="all")
	<div class="container-fluid video_sec">
		@php
			$url = @$video->video_url;
			$regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
		@endphp
		@if($video->video_url && preg_match($regex_pattern, $url))
		<div class="row">
			{{-- <div class="col-12 text-center pt-5">
				<div class="ratio ratio-21x9">
				  <iframe src="https://www.youtube.com/embed/bJwgZg484oo" title="মুমিনের কবর কেমন হবে?" allowfullscreen></iframe>
				</div>
			</div> --}}
			<div class="col-12 text-center pt-5">
				<div class="ratio ratio-21x9 plyr__video-embed" id="video_player">
					<iframe
					src="{{$video->video_url}}"
					allowfullscreen
					allowtransparency
					allow="autoplay"
					></iframe>
				</div>
			</div>
		</div>
		@else
			<h4 class="text-center text-danger" style="display: flex;
			justify-content: center;">Video Not Found</h4>
		@endif
		<div class="row py-5 video_content">
			<div class="col-12 col-md-9 video_details_content">
				<div class="card mb-3 border-0">
					<div class="row mb-3">
						<div class="col-md-9">
							<h5 class="card-title">{{$video->title}}</h5>
							<p class="card-text"><small class="text-muted"><span class="text-primary">{{$video->view_count}} Views</span></small> | <small class="text-muted">{{$video->created_at->diffForHumans()}}</small></p>
						</div>
						<div class="col-md-3 text-md-end mt-3 mt-md-0">
							<div class="social-networks"></div>
						</div>
					</div>
				  <div class="row">
				    <div class="col-md-12">
				      <div class="card-body">
						@if ($video->thumb_image && File::exists(public_path('uploads/thumb_image/'.$video->thumb_image)))
							<img src="{{asset('uploads/thumb_image/'.$video->thumb_image)}}" alt="{{$video->title}}" class="card-image text-start me-3 mb-2 float-start" alt="">
						@else
							<img src="{{asset('assets/frontend/img/not_found.png')}}" alt="{{$video->title}}" class="card-image text-start me-3 mb-2 float-start" alt="">
						@endif
				        <div class="card-right">
					        <p class="card-text">{{$video->description }}</p>
					        <p class="card-text"><small class="text-muted"><a href="{{route('view_category',$video->r_category->slug)}}" class="bg-light text-dark p-1 mt-4 me-2 d-inline-block meta_tag">{{$video->r_category->name}}</a></small><small class="text-muted"><a href="{{route('view_category',"most-popular")}}" class="bg-light text-dark p-1 mt-4 me-2 d-inline-block meta_tag">Most Popular</a></small></p>
					    </div>
				      </div>
				    </div>
				    <div class="col-md-2 d-none d-md-block text-end">
				    	<!-- <ul class="list-inline d-flex justify-content-end">
				    		<li class="text-center"><i class="fas fa-share-alt text-primary"></i><br>Share</li>

				    	</ul> -->
				    	
				    </div>
				  </div>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="related_sidebar">
					<h3>Related Videos</h3>
					<div class="related_sidebar_content">
						@if ($videos->count()>0)
						@foreach($videos as $v)
						<div class="card mb-3 border-0">
						  <div class="row g-0">
						    <a href="{{route('view_video',$v->slug)}}" class="col-md-6 d-md-flex">
						    	<div class="video_thumb">
								  @if ($v->thumb_image && File::exists(public_path('uploads/thumb_image/'.$v->thumb_image)))
										<img src="{{asset('uploads/thumb_image/'.$v->thumb_image)}}" alt="{{$v->title}}"  class="img-fluid mb-2" alt="">
									@else
										<img src="{{asset('assets/frontend/img/not_found.png')}}" alt="{{$v->title}}"  class="img-fluid mb-2" alt="">
									@endif
							      <i class="fas fa-play"></i>
							    </div>
								
						    </a>
						    <div class="col-md-6">
						      <div class="card-body">
						        <h5 class="card-title"><a href="{{route('view_video',$v->slug)}}">{{$v->title}}</a></h5>
						        <p class="card-text"><small class="text-muted"><span class="text-primary"> {{($v->view_count != 'null')?$v->view_count:0}} Views</span></small> | <small class="text-muted">{{$v->created_at->diffForHumans()}}</small><br><small class="text-muted"><a href="{{route('view_category',$v->r_category->slug)}}" class="bg-light text-dark p-1 mt-1 d-inline-block meta_tag">{{$v->r_category->name}}</a></small></p>
						      </div>
						    </div>
						  </div>
						</div>
						@endforeach
						@else
						<div class="card mb-3 border-0">
						  <div class="row g-0">
						    <div class="col-md-12">
						      <div class="card-body">
						        <h5 class="card-title">No Related Videos found</h5>
						      </div>
						    </div>
						  </div>
						</div> 
						@endif
					</div>
	            </div>
			</div>
			</div>
		</div>
	</div>
	@else
	<div class="row" style="padding: 0 10px;">
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
</div>
@endif
</div>
{{-- Video view end --}}
<div class="mt-4"></div>
@endsection
@push('scripts')
<script src="https://cdn.plyr.io/3.6.12/plyr.polyfilled.js"></script>
<script>
  const player = new Plyr('#video_player');
  function actualResizeHandler2() {
	var e = document.querySelector(".plyr__video-wrapper"); // the video INSIDE plyr div
	if (!e) return;
	var h = e.offsetHeight;
	var w = (h * 21) / 9;
	document.querySelector("div.plyr").style.width = w + "px";
	document.querySelector("div.plyr").style.height = h + "px";
  }
  
  setTimeout(() => {
	actualResizeHandler2();
  }, 1000);
</script>
<style type="text/css">

</style>
@endpush