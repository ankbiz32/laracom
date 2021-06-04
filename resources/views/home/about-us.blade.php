
@extends('layouts.app')

@section ('content')
<style>
    .short-desc{
        font-size:18px !important;
        line-height:25px !important;
        color:#555;
    }
    
</style>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>About Us</h2>
                <ul>
                    <li><a href="{{URL('/')}}">Home</a></li>
                    <li class="active">About us</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-content_area about-us">
        <div class="banner-with_text about overflow-hidden pt-5 pt-sm-5 pb-5">
            <div class="container-fluid p-0">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="banner-area pt-md-0">
                            <img class="w-100" src="assets/images/about-us/about.png" alt="Banner">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-area">
                            <span class="mb-0 pb-3">The word</span>
                            <h2 class="heading pb-5">What Bhukyra means?</h2>
                            <p class="short-desc pb-3">
                                The word "Bhukyra" is a compound name, derived from "Bhu" ("Earth, Land, Soil") and “Kyra" ("Sun"). <br>
                                Bhukyra believes that the Earth is wowed by sun, the heavenly body. The Earth spins and swaggers, trying frantically to capture the Sun’s attention. It stirs up ferocious weather patterns on its marble-like surface, it shows off its sparkling seas, it flaunts its marvelous mountain ranges. With every passing moment, the Earth falls for the Sun anew: plunging through space, it is constantly tripping over itself in a desperate attempt to get just a little closer to that captivating personality.
                            </p>
                            <p class="h6"><small><cite>" True medicine comes from Earth, not from a Lab "</cite></small></p>
                            <p class="short-desc pb-0 pt-3">
                                Bhukyra believes in maintaining balance by cohering together - body, mind and consciousness. They are simply viewed as different facets of one’s being. <br>
                                Bhukyra ‘s insights towards Ayurveda , is a qualitative, holistic science of health and longevity, a philosophy and system of healing the whole person, body and mind.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="banner-with_text legacy banner-with_text-3 overflow-hidden">
            <div class="container-fluid p-0">
                <div class="banner-nav bg-black bg-green">
                    <div class="row align-items-center">
                        <div class="col-lg-7 order-sm-0 order-1">
                            <div class="text-area">
                                <span class="white-text_color pb-3 pt-0">The Legacy</span>
                                <h2 class="heading white-text_color pb-5">Unveiling of the Secret Ancient Remedies</h2>
                                <p class="short-desc">
                                    From the legacy of medicine since her maternal grandfather’s days, she wasengaged in Ayurveda from childhood and thus became the <strong>first Vaidya of Vadodara. </strong>She served & adviced President of Vadodara District Vaidya's Association & later succeeded as President of Vadodara District Vaidya's Association.
                                </p>
                                <p class="short-desc pb-0 pb-md-150">
                                    She authored the book <strong>"Ayurveda Kalpana"</strong>. Medicines and remedies described in this book are very simple and routine. How materials in our culinary cultures and practices can be useful to achieve wellbeing and how it can be used to abolish any disease, are described in simple and good language like churna, swaras, gutika, kavath, oil, dhrut, murabba and other materials in our own kitchen can be used as medicine. To produce medicines based on her experience, she started ‘Bilva Patra Pharmacy’ in 1944.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-5 order-sm-1 order-0">
                            <div class="banner-area pb-100 pt-100">
                                <img class="w-100 px-5 pt-3 pt-sm-5 pb-3" src="assets/images/about-us/kamlabai-bhukyra.png" alt="">
                                <p class="text-center h6 text-white pt-2 font-lg mb-0">
                                    <strong>Vaidya Kamlabai Vishnupant Joshi (1904-1981)</strong>
                                </p>
                                <span class="pt-1 d-block text-center text-white" style="opacity:0.9">Ayurvedabhiskek B.M.P</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="banner-with_text why_us banner-with_text-2 overflow-hidden pt-sm-50 pt-100">
            <div class="container-fluid p-0">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="banner-area text-center">
                            <img class="w-75 pl-sm-5 pl-0" src="photo/emblem.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="text-area pt-5 pt-sm-0">
                            <span class="pb-4">Why bhukyra?</span>
                            <p class="h6">
                                ★ Ancient remedial products Preventive & Curative. <br>
                                ★ We believe, In Ayurveda. The secret to good health lies in two simple steps - doing less and being more <br>
                                ★ Based on The Saptha Dhatu / The Science of Seven tissues in the Ancient Indian Ayurvedic Medicine. <br>
                                ★ Trust - legendary formulations. <br>
                                ★ Quality - Be assured with thoughtfully built process driven from sourcing to manufacturingto your wellbeing.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
      

        <!-- <div class="newsletter-with_testimonial pt-150">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="newsletter-area bg-wisp-pink">
                            <div class="newsletter-wrap">
                                <span>Subscribe our</span>
                                <h2 class="heading">Newsletter Now</h2>
                                <div class="newsletter-form_wrap">
                                    <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="newsletters-form validate" target="_blank" novalidate>
                                        <div id="mc_embed_signup_scroll">
                                            <div id="mc-form" class="mc-form subscribe-form">
                                                <input id="mc-email" class="newsletter-input" type="email" autocomplete="off" placeholder="Enter email address" />
                                                <button class="newsletter-btn" id="mc-submit">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <p class="short-desc">Get the latest update of our new products,
                                    offers and promotions</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="testimonial-area">
                            <div class="client-review_area">
                                <span>Clients <strong>Review</strong></span>
                                <h2>What they say</h2>
                            </div>
                            <div class="quicky-element-carousel testimonial-slider mousewheel-slider custom-dots custom-dots-2" data-slick-options='{
                        "slidesToShow": 1,
                        "slidesToScroll": 1,
                        "infinite": true,
                        "dots": true,
                        "spaceBetween": 30,
                        "fade": true
                        }' ]'>

                                <div class="testimonial-item">
                                    <div class="testimonial-img text-center">
                                        <img src="assets/images/testimonial/client/1.png" alt="Quicky's Client">
                                    </div>
                                    <div class="testimonial-content">
                                        <p class="comment"><strong>Quicky</strong> is one of the best online site that
                                            serves best service and best product, I really love them.
                                        </p>
                                        <h3 class="client-name"><span>Kallu Robert</span></h3>
                                    </div>
                                </div>
                                <div class="testimonial-item">
                                    <div class="testimonial-img text-center">
                                        <img src="assets/images/testimonial/client/2.png" alt="Quicky's Client">
                                    </div>
                                    <div class="testimonial-content">
                                        <p class="comment"><strong>Quicky</strong> is one of the best Lorem ipsum, dolor sit amet consectetur adipisicing elit fugit tempore.
                                        </p>
                                        <h3 class="client-name"><span>Douglas Robert</span></h3>
                                    </div>
                                </div>
                                <div class="testimonial-item">
                                    <div class="testimonial-img text-center">
                                        <img src="assets/images/testimonial/client/1.png" alt="Quicky's Client">
                                    </div>
                                    <div class="testimonial-content">
                                        <p class="comment"><strong>Quicky</strong> is one of the best online site that
                                            serves best service and best product, I really love them.
                                        </p>
                                        <h3 class="client-name"><span>Kallu Robert</span></h3>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        
    </div>



@endsection


    
      
