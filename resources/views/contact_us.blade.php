@extends('welcome', ['title' => 'Contuct Us'])
@section('main_content')

{{-- Video view start --}}

<div class="py-3 py-md-5 text-center text-white page_subheader" >
	<div class="container-fluid">
		<h2>Contuct Us</h2>
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb justify-content-center m-0">
		    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Contuct Us</li>
		  </ol>
		</nav>
	</div>
</div>
<div class="container pt-4">
    @if (\Session::has('msg'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('msg') !!}</li>
            </ul>
        </div>
    @endif
    <div class="row contact-form">
        <div class="col-md-12">
            <h4 class="contact-form-title mt_50 mb_20">Contact Form</h4>
            <form action="" method="post" id="contact-usform" >
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name (Required)</label>
                            <input type="text" class="form-control" name="visitor_name" autocomplete="off" required value={{old('visitor_name')}}>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email Address (Required)</label>
                            <input type="email" class="form-control" name="visitor_email" required value={{old('visitor_email')}}>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="visitor_phone" value={{old('visitor_phone')}}>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Message (Required)</label>
                    <textarea name="visitor_message" class="form-control h-200" cols="30" rows="10" required>
                        {{old('visitor_message')}}
                    </textarea>
                </div>
                <input type="hidden" name="recaptcha" id="recaptcha">
                
                <button type="submit" class="btn btn-primary mt_10">Send Message</button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.sitekey') }}"></script>
<script>
     $(document).on("submit",'#contact-usform',function(e){
            e.preventDefault();
            var formData = new FormData(this);

            // $("#profile-submit-btn").attr("disabled", "disabled");
            // $("#profile-submit-btn").prepend('<div class="spinner-grow text-light"></div> ');

            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config('services.recaptcha.sitekey') }}', {action: 'submit'}).then(function(token) {
                    if (token) {
                        document.getElementById('recaptcha').value = token;

                        $.ajax({
                        type: "post",
                        url: "{{ route('contact-us') }}",
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            //alert(JSON.stringify(response));
                            const {status,message} = response;
                            if(status=="success"){
                                alert(message);
                                // $('#profile-form')[0].reset();
                                // swal({
                                //     title: "Congrats!",
                                //     text: message,
                                //     icon: "success",
                                // })
                                // .then(()=>{
                                //     formTouch=0;
                                //     window.location = "{{ route('home') }}";
                                // });

                            }else{
                                alert(message);
                                // var errMsg = '';
                                // var ii = 0;
                                // $.each(response['errors'], function (key, value) {
                                //     $('.error_'+key).html(value);
                                //     ii++;
                                //     errMsg += ii+". "+value + '\n';
                                // });

                                // swal({
                                //     title: "Opps!",
                                //     text: (message)?message:errMsg,
                                //     icon: "error",
                                // });

                            }

                            // $("#profile-submit-btn").removeAttr("disabled");
                            // $("#profile-submit-btn").find("div").remove();
                        },
                        error: function(){
                            // $("#profile-submit-btn").removeAttr("disabled");
                            // $("#profile-submit-btn").find("div").remove();
                        }
                    });
                    }
                });
            });

            
        });
</script>
@endpush