@extends('Frontend.mainlayout',['title'=>'Admin Dashbord'])
@section('content-wrapper')
<div class="row">
    <div class="col-md-4 p-1">
        <a href="{{route('admin.category')}}">
            <div class="card table-card widget-purple-card bg-c-yellow mb-2">
                <div class="row-table">
                    <div class="col-sm-4 card-body-big">
                        <i class="fa-solid fa-folder-tree"></i>
                    </div>
                    <div class="col-sm-8">
                        <h4>{{@$category}}</h4>
                        <h6>Categories</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-4 p-1">
        <a href="{{route('admin.videos')}}">
            <div class="card table-card widget-primary-card bg-c-blue mb-2">
                <div class="row-table">
                    <div class="col-sm-4 card-body-big">
                        <i class="fa-solid fa-play"></i>
                    </div>
                    <div class="col-sm-8">
                        <h4>{{@$videos}}</h4>
                        <h6>Videos</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4 p-1">
        <a href="javascript:void(0)">
            <div class="card table-card widget-purple-card bg-success mb-2">
                <div class="row-table">
                    <div class="col-sm-4 card-body-big">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                    <div class="col-sm-8">
                        <h4>{{@$total_view}}</h4>
                        <h6>Total Views</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

@endsection
