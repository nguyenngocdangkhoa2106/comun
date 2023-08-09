@extends('Layout_user')
@section('content')

    @include('User.sample')

    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3 titlesign">Sign
                In</span></h2>
        <div class="row px-xl-5" style="justify-content: center;">
            <div class="col-lg-5 mb-5 sign_in">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form id="signinForm" action="post">
                        <div class="form-group">
                            <input type="email" class="form-control" id="email_in" name="email_in" placeholder="Your Email"
                                required="required" style="height: 58px !important;" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password_in" name="password_in"
                                placeholder="Your Password" required="required" style="height: 58px !important;" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <input type="hidden" class="hidden_action" value="In">
                            <button class="btn btn-block btn-primary font-weight-bold py-3 submit" type="submit">Sign
                                In</button>
                            <p></p>
                            <a href="#" class="clicksign" data-status="signUp">Create an Account?</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5 sign_up display">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form id="signupForm" action="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your Name"
                                required="required" style="height: 58px !important;" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control input_email" id="email_up" name="email_up"
                                placeholder="Your Email" required="required" style="height: 58px !important;"/>
                            <p class="help-block text-danger checkemail" style="list-style-type: none;
                            font-size: 0.9em;
                            line-height: 0.9em; margin: 2px 0 3px;
                            color: red !important;"></p>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password_up" name="password_up"
                                placeholder="Your Password" required="required" style="height: 58px !important;" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="re_password_up"
                                data-parsley-equalto="#password_up" data-parsley-trigger="keyup"
                                placeholder="Your Confirm Password" required="required" style="height: 58px !important;" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <input type="hidden" class="hidden_action" value="Up">
                            <button class="btn btn-block btn-primary font-weight-bold py-3 submit" type="submit">Sign
                                Up</button>
                            <p></p>
                            <a href="#" class="clicksign" data-status="signIn">
                                << Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <style>
        .display {
            display: none;
        }

    </style>

@endsection
@section('css')
    <link href="{{ asset('frontend/parsley.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script>
        $(document).ready(function() {
            // Check Form
            $('#signinForm').parsley();
            $('#signupForm').parsley();
            $('.clicksign').click(function(e) {
                e.preventDefault();
                var status = $(this).data('status');

                if (status == 'signUp') {
                    $('.titlesign').text('Sign Up');
                    $('.sign_up').removeClass('display');
                    $('.sign_in').addClass('display');
                }
                if (status == 'signIn') {
                    $('.titlesign').text('Sign In');
                    $('.sign_in').removeClass('display');
                    $('.sign_up').addClass('display');
                }
            });
            // Submit Form Sign In
            $(document).on('submit', '#signinForm', function(e) {
                e.preventDefault();

                var action = 'In';
                var email = $('#email_in').val();
                var password = $('#password_in').val();

                if ($('#signinForm').parsley().isValid()) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('sign.store') }}',
                        data: {
                            action: action,
                            email: email,
                            password: password
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.status == 200 || res.status == 400) {
                                $('#success').html(
                                    '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Notification. </strong>' +
                                    res.message + '</div>');
                                setTimeout(function() {
                                    $('.submit').attr('disabled', false);
                                    location.replace(res.url);
                                }, 1000);
                            }else{
                                $('#success').html(
                                    '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Notification. </strong>' +
                                    res.message + '</div>');
                                $('#password_in').val('');
                            }
                        }
                    });
                }
            });
            // Submit Form Sign Up
            $(document).on('submit', '#signupForm', function(e) {
                e.preventDefault();

                var action = 'Up';
                var email = $('#email_up').val();
                var password = $('#password_up').val();
                var name = $('#fullname').val();

                if ($('#signupForm').parsley().isValid()) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('sign.store') }}',
                        data: {
                            action: action,
                            name: name,
                            email: email,
                            password: password
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.status == 200) {
                                $('#success').html(
                                    '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Notification. </strong>' +
                                    res.message + '</div>');
                                setTimeout(function() {
                                    $('.submit').attr('disabled', false);
                                    location.replace(res.url);
                                }, 1000);
                            }else{
                                $('#success').html(
                                    '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Notification. </strong>' +
                                    res.message + '</div>');
                                $('.checkemail').text(res.message);
                                $('.input_email').addClass('parsley-error');
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
