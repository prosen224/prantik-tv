@extends('Frontend.mainlayout',['title'=>'Add Video'])
@section('content-wrapper')



<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Add Video
                </h5>
                <a class="btn btn-sm btn-dark float-right" href="{{route('admin.videos')}}">Back</a>
            </div>

            <div class="card-body">
                <div class="dt-responsive">
                    <form method="POST" action="{{route('admin.videos.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="info1">Title</label>
                            <input type="text" name="title" class="form-control" id="info1" aria-describedby="emailHelp" value="{{old('title')}}" placeholder="" >
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="info2">Video Url</label>
                            <input type="text" name="video_url" value="{{old('video_url')}}" class="form-control" id="info2" aria-describedby="emailHelp" placeholder="" >
                            @error('video_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    
                        <div class="form-group">
                            <label for="info3">Description</label>
                            <textarea id="info3" class="form-control" {{old('description')}} name="description"></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>

                        <div class="form-group">
                            <label for="info4">Status</label>
                            <select name="status" class="form-control" id="info4">
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="info5">Category</label>
                            <select name="category_id" class="form-control" id="info5">
                                @foreach($category as $v)
                                <option value="{{$v->id}}">{{$v->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="info6">Featured</label>
                            <select name="featured" class="form-control" id="info6">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('featured')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="info7" class="form-label">Thumb Image</label>
                            <input class="form-control" name="thumb_image" type="file" id="info7">                   
                            @error('thumb_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="info8" class="form-label">Banner Image</label>
                            <input class="form-control" name="banner_image" type="file" id="info8" multiple>                   
                            @error('banner_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
