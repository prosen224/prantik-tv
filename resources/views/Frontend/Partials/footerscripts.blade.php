<script src="{{asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{asset('assets/js/pcoded.min.js') }}"></script>
<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
{{-- Change password modal start--}}
<div class="modal fade" id="changepass_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><strong>Change Password</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <!--/.modal-header-->
            <div class="modal-body">
                <form method="post" id="change_password_form" action="javascript:void(0)">
                    <div class="form-group" id="currentPass-group">
                        <label for="current_pass">Current Password :</label>
                        <input class="form-control" type="password" name="current_pass" id="current_pass">
                        <span class="text-danger error_current_pass"></span>
                    </div>

                    <div class="form-group">
                        <label for="new_pass">New Password :</label>
                        <input class="form-control" type="password" name="new_pass" id="new_pass">
                        <span class="text-danger error_new_pass"></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_pass">Confirm Password :</label>
                        <input class="form-control" type="password" name="confirm_pass" id="confirm_pass">
                        <span class="text-danger error_confirm_pass"></span>
                    </div>

                    <span class="not_match_error text-danger"></span>
                    <div class="modal-footer">
                        <button type="button" name="submit" class="btn btn-success" id="submitchange_pass_btn" value="Save changes">Save Changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- Change password modal end--}}
<style>
    .invalid-feedback{
        display: block;
    }
</style>
@push('scripts')
<script src="{{ asset('assets/plugins/sweetalert/sweetalert2.min.js') }}"></script>
<script src="{{asset('assets/js/custom/loading.js')}}"></script>


<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on("click",".change-password-btn",function(){
        $("#changepass_modal").modal("show");
    });

    $(document).on("click","#submitchange_pass_btn",function(){
        $("#change_password_form").submit();
    })

    $(document).on("submit","#change_password_form",function(){
        $.ajax({
            type: "post",
            url: "{{route('admin.change-password')}}",
            data: $("#change_password_form").serialize(),
            success: function (response) {
                let {status,message} = response;
                if(status == "error"){
                    console.log(message);
                    $.each(response['errors'], function (key, value) {
                        $('.error_'+key).html(value);
                    });
                }
                if(status == "success"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Welcome',
                        text: `${message}`,
                    });
                    $("#changepass_modal").modal("hide");
                }
                if(status == "error" && message != '' && message !=undefined){
                    $(".not_match_error").html(message);
                }
            }
        });
    });

    $(document).on("click",".delete-btn",function(){
        // confirm delete
        Swal.fire({
            title: 'Are you sure want to delete?',
            text: "If delete you could't recover this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = $(this).attr("data-href");
            }
        });
    });

    
})

  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
</script>
@endpush
