@extends('Frontend.mainlayout',['title'=>'Edit Video'])
@section('content-wrapper')



<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Edit Video
                </h5>
                <a class="btn btn-sm btn-dark float-right" href="{{route('admin.videos')}}">Back</a>
            </div>

            <div class="card-body">
                <div class="dt-responsive">
                    

            <form method="POST" action="{{route('admin.videos.update', $videos->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="info1">Title</label>
                    <input type="text" value="<?php echo $videos->title; ?>" name="title" class="form-control" id="info1" aria-describedby="emailHelp" placeholder="" >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="form-group">
                    <label for="info2">Video Url</label>
                    <input type="text" value="<?php echo $videos->video_url; ?>" name="video_url" class="form-control" id="info2" aria-describedby="emailHelp" placeholder="" >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror               
                </div>
                

                <div class="form-group">
                    <label for="info3">Description</label>
                    <textarea id="info3" class="form-control" name="description"><?php echo $videos->description; ?></textarea>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror               
                </div>




                <div class="form-group">
                    <label for="info4">Status</label>
                    <select name="status" class="form-control" id="info4">
                        
                    <option
                        <?php
                        if ($videos->status == 1){
                        ?>
                        selected
                        <?php }?>
                        value="1">Enable</option>


                        <option
                        <?php
                        if ($videos->status == 0){
                        ?>
                        selected
                        <?php }?>
                        value="0">Disable</option>
                        
                    </select>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="form-group">
                    <label for="info5">Category</label>
                    <select name="category_id" class="form-control" id="info5">
                        @foreach($category as $v)
                        <option

                        <?php
                            if($videos->category_id == $v->id){
                        ?>
                        selected
                        <?php
                            }
                        ?>
                        value="{{$v->id}}">{{$v->name}}</option>
                        @endforeach
                    </select>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>



                <div class="form-group">
                    <label for="info6">Featured</label>
                    <select name="featured" class="form-control" id="info6">
                        
                    <option
                        <?php
                        if ($videos->featured == 1){
                        ?>
                        selected
                        <?php }?>
                        value="1">Yes</option>


                        <option
                        <?php
                        if ($videos->featured == 0){
                        ?>
                        selected
                        <?php }?>
                        value="0">No</option>
                        
                    </select>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


                <div class="form-group">
                    @if ($videos->thumb_image && file_exists(public_path('uploads/thumb_image/'.$videos->thumb_image)))
                    <img width="40" style="margin:auto;display:block" src="{{asset('uploads/thumb_image/'.$videos->thumb_image)}}">
                    @endif
                    <label for="info7" class="form-label">Thumb Image</label>
                    <input class="form-control" name="thumb_image" type="file" id="info7">                   
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="form-group">
                    @if ($videos->banner_image && file_exists(public_path('uploads/banner_image/'.$videos->banner_image)))
                    <img width="100" style="margin:auto;display:block" src="{{asset('uploads/banner_image/'.$videos->banner_image)}}">
                    @endif
                    <label for="info8" class="form-label">Banner Image</label>
                    <input class="form-control" name="banner_image" type="file" id="info8">                   
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>

            </form>



                </div>
            </div>
        </div>
    </div>
</div>

@endsection
