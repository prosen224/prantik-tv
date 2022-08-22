@extends('Frontend.mainlayout',['title'=>'Videos'])
@section('content-wrapper')



<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Videos
                </h5>
                <a class="btn btn-dark btn-sm float-right" href="{{route('admin.videos.new')}}"><i class="fa-solid fa-plus"></i> &nbsp;Add New</a>
            </div>

            <div class="card-body">
                <div class="search pb-3">
                    <form action="">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="info1">Title</label>
                                    <input type="text" name="title" class="form-control" id="info1" aria-describedby="emailHelp" value="{{ (isset($_GET["title"]))?$_GET["title"]:''}}" placeholder="">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="info1">Category</label>
                                    <select class="form-control" name="category">
                                        <option value="">Select Category</option>
                                        @foreach($category as $v)
                                            <option value="{{$v->id}}" {{ (isset($_GET['category']) && $_GET['category'] == $v->id )?"selected":'' }}>{{$v->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="info1">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Select Status</option>
                                        <option value="1" {{ (isset($_GET['status']) && $_GET['status'] == 1)?"selected":'' }}>Enable</option>
                                        <option value="0" {{ (isset($_GET['status']) && $_GET['status'] == 0)?"selected":'' }}>Disable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group pt-4 mb-0">
                                    <label for=""> </label>
                                    <button type="submit" class="btn btn-info">Search</button>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="dt-responsive table-responsive ">
                    <table class="table table-striped table-bordered nowrap" id="videos_table" style="max-width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Create Date</th>
                                <th>Banner Image</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Feautured</th>
                                <th>View Count</th>
                                <th style="width:10%">Action</th>
                                
                            </tr>
                            <?php $i=0; ?>  
                            @foreach($videos as $v)
                            <?php $i++?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$v->title}}</td>
                                <td>{{ date("Y-m-d", strtotime($v->created_at)) }}</td>
                                <td>
                                    @if (($v->thumb_image && File::exists(public_path('uploads/banner_image/'.$v->banner_image))))
                                    <img width="100" style="margin:auto;display:block" src="{{asset('uploads/banner_image/'.$v->banner_image)}}">
                                    @else
                                    <img width="100" style="margin:auto;display:block" src="{{asset('assets/frontend/img/not_found.png')}}">
                                    @endif
                                </td>
                                <td>{{$v->r_category->name}}</td>
                                <td>
                                    {!! ($v->status == 1)?'<span class="badge badge-success">Enable</span>':'<span class="badge badge-danger">Disable</span>' !!}
                                </td>
                                <td>
                                    {!! ($v->featured == 1)?'<span class="badge badge-success">Yes</span>':'<span class="badge badge-warning">NO</span>' !!}

                                </td>
                                <td>{{$v->view_count}}</td>
                                <td><a class="btn btn-sm btn-dark" href="{{route('admin.videos.edit', [$v->id])}}"><i class="fa-solid fa-pen"></i></a>
                                <a class="btn btn-sm btn-danger delete-btn" href="javascript:void(0)" data-href="{{route('admin.videos.delete', [$v->id])}}"><i class="fa-solid fa-trash-can"></i></i></a></td>
                                
                            </tr>
                            @endforeach
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
.btn > i {
    margin-right: 0px!important;
}
</style>

@endsection
