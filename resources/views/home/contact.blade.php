
@extends('layouts.app')

@section ('content')

    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Contact Us</h2>
                <ul>
                    <li><a href="{{URL('/')}}">Home</a></li>
                    <li class="active">Contact us</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="contact-main-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-page-side-content">
                        <h3 class="contact-page-title">Contact Us</h3>
                        <p class="contact-page-message">Fill this form for any queries or suggestions regarding our products and services. We will provide you with 100% assistance happily. Alternatively you can call or mail us on the information given below.</p>
                        <div class="single-contact-block">
                            <h4><i class="fa fa-phone"></i> Phone</h4>
                            <p>Mobile: (08) 123 456 789</p>
                            <p>Hotline: 1009 678 456</p>
                        </div>
                        <div class="single-contact-block last-child">
                            <h4><i class="fa fa-envelope"></i> Email</h4>
                            <p>yourmail@domain.com</p>
                            <p>support@hastech.company</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form-content">
                        <h3 class="contact-page-title">Tell Us Your Message</h3>
                        <div class="contact-form">
                            <form id="contact-form" action="{{route('home.enquire')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Your Name <span class="required">*</span></label>
                                    <input type="text" name="con_name" value="{{ old('con_name') }}" class="@error('con_name')form-control is-invalid @enderror" id="con_name" required>
                                    @error('con_name')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Your Email <span class="required">*</span></label>
                                    <input type="email" name="con_email" value="{{ old('con_email') }}" class="@error('con_email')form-control is-invalid @enderror"  id="con_email" required>
                                    @error('con_email')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" name="con_subject" value="{{ old('con_subject') }}" class="@error('con_subject')form-control is-invalid @enderror" id="con_subject">
                                    @error('con_subject')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group form-group-2">
                                    <label>Your Message</label>
                                    <textarea name="con_message" id="con_message" maxlength="300" style="resize: none;"></textarea>
                                    <small class="text-right d-block">*Max. 300 characters</small>
                                    @error('con_message')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" value="submit" id="submit" class="contact-form_btn" name="submit">send</button>
                                </div>
                            </form>
                        </div>
                        <p class="form-messege mb-0"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

