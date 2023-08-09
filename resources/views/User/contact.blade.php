@extends('Layout_user')
@section('content')

    @include('User.sample')

    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact
                Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form id="submit_contact" method="POST">
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" placeholder="Your Name" required="required"
                                data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" placeholder="Your Email"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject" placeholder="Subject" readonly
                                required="required" data-validation-required-message="Please enter a subject"
                                value="Contact Us" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="8" id="message" placeholder="Message" required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4 submit" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d501000.4874080593!2d106.37079345487204!3d11.18272642219485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174b66a8ef92879%3A0x339fda891c8d1473!2zQsOsbmggRMawxqFuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1638429059218!5m2!1svi!2s"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York,
                        USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
@section('css')
    <link href="{{ asset('frontend/parsley.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script>
        $('#submit_contact').parsley();
        $(document).on('submit','#submit_contact',function(e){
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '{{ route('contact.store') }}',
                data: {
                    name:$('#name').val(),
                    email:$('#email').val(),
                    subject:$('#subject').val(),
                    message:$('#message').val(),
                },
                dataType: 'json',
                beforeSend: function() {
                    $('.submit').attr('disabled',true);
                    $('.submit').text('Submitting...');
                },
                success:function(res){
                    if(res.status == 200){
                        $('#success').html('<div class="alert alert-success">\
                            <button type="button" class="close" data-dismiss="alert"\
                                aria-hidden="true">×</button><strong>'+res.message+'</strong>\
                        </div>');
                        setTimeout(function() {
                            $('.submit').attr('disabled', false);
                            $('.submit').text('Send Message');
                        }, 2000);
                    }
                }
            });
        })
    </script>
@endsection
