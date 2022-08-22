@extends('Frontend.mainlayout',['title'=>'Add Category'])
@section('content-wrapper')



<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Add Category
                </h5>
                <a class="btn btn-sm btn-dark float-right" href="{{route('admin.category')}}">Back</a>
            </div>

            <div class="card-body">
                <div class="dt-responsive">
                    

            <form method="POST" action="{{route('admin.category.store')}}">
                @csrf
                <div class="form-group">
                    <label for="info1">Category Name</label>
                    <input type="text" name="name" class="form-control" id="info1" aria-describedby="emailHelp" placeholder="" value="{{old('name')}}" />
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                

                <div class="form-group">
                    <label for="info2">Status</label>
                    <select name="status" class="form-control" id="info2">
                        <option value="1">Enable</option>
                        <option value="0">Disable</option>
                    </select>
                    @error('status')
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
