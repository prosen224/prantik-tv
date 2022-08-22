@extends('Frontend.mainlayout',['title'=>'About Us'])
@section('content-wrapper')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Update About Us
                </h5>
            </div>

            <div class="card-body">
                <div class="dt-responsive">
                    <form method="POST" action="{{route('admin.about.update',$aboutus->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="info1">Title</label>
                            <input type="text" name="title" class="form-control" id="info1" aria-describedby="emailHelp" value="{{$aboutus->title}}" placeholder="" >
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="tox-target">{!! $aboutus->description !!}</textarea>
                            {{-- <textarea name="description" id="description" ></textarea> --}}
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            @if($aboutus->image && File::exists('uploads/aboutus/'.$aboutus->image))
                                <img src="{{asset('uploads/aboutus/'.$aboutus->image)}}" alt="{{$aboutus->image}}" width="100px" height="100px">
                            @endif
                            <input type="file" name="image" class="form-control" id="image" aria-describedby="emailHelp" placeholder="" >
                            @error('image')
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
@push('scripts')
<script src="{{asset('assets/js/plugins/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
     tinymce.init({
        height: "400",
        selector: '#description',
        content_style: 'body { font-family: "Roboto", sans-serif; }',
        menubar: false,
        toolbar: ['styleselect fontselect fontsizeselect',
            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
            'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'
        ],
        plugins: 'advlist autolink link image lists charmap print preview code'
    });
</script>
@endpush