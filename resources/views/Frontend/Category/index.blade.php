@extends('Frontend.mainlayout',['title'=>'Category'])
@section('content-wrapper')
{{-- {!! Toastr::message() !!} --}}
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Category
                </h5>
                <a class="btn btn-dark btn-sm float-right" href="{{route('admin.category.new')}}"><i class="fa-solid fa-plus"></i> &nbsp;Add New</a>
            </div>

            <div class="card-body">
                <div class="dt-responsive table-responsive ">
                    <table class="table table-striped table-bordered nowrap" id="trips_table" style="max-width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th style="width:10%">Action</th>
                                
                            </tr>
                            <?php
                            $y=1;
                            if(isset($_GET['page'])){
                                $page_no = $_GET['page'];
                                $x = ($page_no - 1) * 10;
                                $y = $x + 1; 
                            }
                            ?>
                                @foreach($category as $v)
                            
                            <tr>
                                <td>{{@$y++}}</td>
                                <td>{{$v->name}}</td>
                                <td>
                                    <?php
                                        if($v->status == 1){
                                            echo "Enable";
                                        }else{
                                            echo "Disable";
                                        }
                                    ?>
                                    
                                </td>
                                <td><a class="btn btn-sm btn-dark" href="{{route('admin.category.edit', [$v->id])}}"><i class="fa-solid fa-pen"></i></a>
                                <a class="btn btn-sm btn-danger delete-btn" href="javascript:void(0)" data-href="{{route('admin.category.delete', [$v->id])}}"><i class="fa-solid fa-trash-can"></i></i></a></td>
                                
                            </tr>
                            @endforeach
                        </thead>
                    </table>
                    {{$category->onEachSide(2)->links()}}
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
