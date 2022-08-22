@extends('welcome', ['title' => $data->title])
@section('main_content')

{{-- Video view start --}}

<div class="page_subheader py-3 py-md-5 text-center text-white" style="background-image: url('{{asset('uploads/aboutus/'.$data->image)}}');background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    position: relative;">
	<div class="container-fluid">
		<h2>{{$data->title}}</h2>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb justify-content-center m-0">
		    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
		    <li class="breadcrumb-item active" aria-current="page">DCMA</li>
		  </ol>
		</nav>
	</div>
</div>
<div class="container pt-4">
    {!!$data->description!!}
</div>
@endsection