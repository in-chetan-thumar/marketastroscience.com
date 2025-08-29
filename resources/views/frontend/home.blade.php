@extends('frontend.layouts.master')

@section('title')
    Home
@endsection

@section('css')
<style>
/* Services Section */
.service__area-2 {
    background: #f8f9ff;
}

.service__item-2 {
    background: #fff;
    border-radius: 15px;
    padding: 40px 30px;
    margin-bottom: 30px;
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid #e6e6f0;
    height: 100%;
}

.service__item-2:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 40px rgba(106, 69, 234, 0.1);
    border-color: #6a45ea;
}

.service__icon-2 {
    width: 80px;
    height: 80px;
    margin: 0 auto 25px;
    background: linear-gradient(135deg, #6a45ea 0%, #ff6b9d 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.service__icon-2 img {
    width: 40px;
    height: 40px;
    filter: brightness(0) invert(1);
}

.service__title-2 {
    color: #1a1a1a;
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 15px;
}

.service__item-2 p {
    color: #666;
    line-height: 1.6;
    margin-bottom: 25px;
}

.service__btn-2 .btn-common {
    background: transparent;
    color: #6a45ea;
    border: 2px solid #6a45ea;
    padding: 12px 25px;
    border-radius: 30px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
}

.service__btn-2 .btn-common:hover {
    background: #6a45ea;
    color: #fff;
}

/* Counter Section */
.counter__area-2 {
    background: linear-gradient(135deg, #6a45ea 0%, #ff6b9d 100%);
    color: #fff;
}

.counter__item-2 {
    text-align: center;
    padding: 30px 20px;
}

.counter__number {
    font-size: 48px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 10px;
    display: block;
}

.counter__text {
    font-size: 18px;
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
}

.counter__border {
    width: 60px;
    height: 3px;
    background: rgba(255, 255, 255, 0.3);
    margin: 20px auto 0;
    border-radius: 2px;
}

/* Testimonials Section */
.testimonial__area-2 {
    background: #f8f9ff;
}

.testimonial__item-2 {
    background: #fff;
    border-radius: 15px;
    padding: 40px;
    margin: 15px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.testimonial__item-2:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 40px rgba(106, 69, 234, 0.15);
}

.testimonial__rating {
    margin-bottom: 20px;
}

.testimonial__rating i {
    color: #ffa726;
    font-size: 16px;
    margin-right: 2px;
}

.testimonial__text-2 {
    color: #666;
    font-style: italic;
    line-height: 1.6;
    margin-bottom: 30px;
    font-size: 16px;
}

.testimonial__author-2 {
    display: flex;
    align-items: center;
}

.testimonial__avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 15px;
}

.testimonial__avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.testimonial__name {
    color: #1a1a1a;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 5px;
}

.testimonial__designation {
    color: #6a45ea;
    font-size: 14px;
    margin: 0;
}

.testimonial__navigation {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 40px;
}

.testimonial-button-prev,
.testimonial-button-next {
    width: 50px;
    height: 50px;
    background: #6a45ea;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.testimonial-button-prev:hover,
.testimonial-button-next:hover {
    background: #ff6b9d;
    transform: scale(1.1);
}

/* FAQ Section */
.faq__area-2 {
    background: #fff;
}

.faq__wrapper {
    max-width: 800px;
    margin: 0 auto;
}

.faq__item {
    border-bottom: 1px solid #e6e6f0;
    margin-bottom: 0;
}

.faq__question {
    padding: 25px 0;
    cursor: pointer;
    display: flex;
    justify-content: between;
    align-items: center;
    transition: all 0.3s ease;
}

.faq__question:hover {
    color: #6a45ea;
}

.faq__question h3 {
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0;
    flex: 1;
    transition: all 0.3s ease;
}

.faq__icon {
    width: 40px;
    height: 40px;
    background: #f8f9ff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 20px;
    transition: all 0.3s ease;
}

.faq__icon i {
    color: #6a45ea;
    font-size: 16px;
    transition: all 0.3s ease;
}

.faq__answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.faq__answer p {
    color: #666;
    line-height: 1.6;
    padding-bottom: 25px;
    margin: 0;
}

.faq__item.active .faq__question h3 {
    color: #6a45ea;
}

.faq__item.active .faq__icon {
    background: #6a45ea;
}

.faq__item.active .faq__icon i {
    color: #fff;
}

/* Newsletter Section */
.newsletter__area-2 {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    color: #fff;
}

.newsletter__wrapper {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.newsletter__title {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #fff;
}

.newsletter__title span {
    background: linear-gradient(135deg, #6a45ea 0%, #ff6b9d 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.newsletter__text {
    font-size: 18px;
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.6;
    margin-bottom: 40px;
}

.newsletter__input-group {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.newsletter__input-group input[type="email"] {
    flex: 1;
    padding: 15px 20px;
    border: 2px solid #444;
    border-radius: 30px;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    font-size: 16px;
}

.newsletter__input-group input[type="email"]::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.newsletter__input-group input[type="email"]:focus {
    outline: none;
    border-color: #6a45ea;
}

.newsletter__input-group button {
    padding: 15px 30px;
    background: linear-gradient(135deg, #6a45ea 0%, #ff6b9d 100%);
    color: #fff;
    border: none;
    border-radius: 30px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.newsletter__input-group button:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(106, 69, 234, 0.3);
}

.newsletter__checkbox {
    margin-bottom: 30px;
}

.newsletter__checkbox input[type="checkbox"] {
    margin-right: 8px;
}

.newsletter__checkbox label {
    color: rgba(255, 255, 255, 0.8);
    font-size: 14px;
}

.newsletter__features {
    display: flex;
    justify-content: center;
    gap: 40px;
    flex-wrap: wrap;
    margin-top: 40px;
}

.newsletter__feature {
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255, 255, 255, 0.9);
}

.newsletter__feature i {
    color: #6a45ea;
    font-size: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .newsletter__input-group {
        flex-direction: column;
    }
    
    .newsletter__features {
        gap: 20px;
    }
    
    .service__item-2 {
        margin-bottom: 20px;
    }
    
    .testimonial__item-2 {
        margin: 10px;
        padding: 30px;
    }
}
</style>
@endsection

@section('content')
    <main>

        <!-- Hero area start -->
        <section class="hero__area-2">
            <div class="hero__inner-2">
                <div class="sec-title-wrapper">
                    <h2 class="sec-title-3 bg-shape">
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            W</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            e</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            D</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            e</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            c</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            o</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            d</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            e</div> <br>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            T</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            h</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            e</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            S</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            t</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            a</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            r</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            s</div>
                    </h2>
                    <h2 class="sec-title-3">
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            S</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            m</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            a</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            r</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            t</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            e</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            r</div> <br>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            T</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            r</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            a</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            d</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            i</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            n</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            g</div><br>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            D</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            e</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            c</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            i</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            s</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            i</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            o</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            n</div>
                        <div
                            style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            s</div>
                    </h2>
                </div>
                <div class="hero__text-2">
                    <p style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">
                        For centuries, astrology has guided human choices. Now we bring that cosmic wisdom into the world of
                        trading. By blending planetary movements with market trends, we empower traders to make informed,
                        confident, and timely decisions.</p>
                    <div class="hero__button btn_wrapper"
                        style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">
                        <a href="https://www.wealcoder.com/dev/html/axtra/service.html"
                            class="wc-btn-pink btn-hover btn-item"
                            style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px);"><span
                                style="top: 134.383px; left: 169.207px;"></span>
                            Discover & <br> Register for Events <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="hero2-shape">
                <img src="{{ asset('frontend/images/bg/arrow-long.png') }}" alt="BG Shape"
                    style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px);">
            </div>
        </section>
        <!-- Hero area end -->


        <!-- Feature area start -->
        <section class="feature__area-2 pt-130">
            <div class="feature__top">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-6">
                            <div class="sec-title-wrapper">
                                <h2 class="sec-title title-anim" style="perspective: 400px;">
                                    <div style="display: block; text-align: start;">Upcoming Events that Inspire</div>
                                    <div style="display: block; text-align: start;">Learn, Predict & Grow</div>
                                    <div style="display: block; text-align: start;">with Us.</div>
                                </h2>
                            </div>
                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-6">
                            <div class="feature__text text-anim">
                                <p style="perspective: 400px;">
                                <div style="display: block; text-align: start;">
                                    Discover upcoming astrology & market science events designed to
                                    expand your knowledge and sharpen your predictions.
                                </div>
                                <div style="display: block; text-align: start;">
                                    Be part of interactive sessions, get expert insights, and
                                    connect with like-minded learners.
                                </div>
                                <div style="display: block; text-align: start;">
                                    Don’t just watch the future unfold — predict it with us.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="feature__btm">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="feature__list animation__feature2">
                                <div class="feature__item">
                                    <img src="{{ asset('frontend/images/feature/icon/1.png') }}" alt="Feature Icon">
                                    <h3 class="feature__title">Live Webinars</h3>
                                    <p>Join live sessions with experts to understand how astrology and market science merge
                                        to predict trends.</p>
                                </div>
                                <div class="feature__item">
                                    <img src="{{ asset('frontend/images/feature/icon/2.png') }}" alt="Feature Icon">
                                    <h3 class="feature__title">Workshops</h3>
                                    <p>Hands-on learning experiences designed to help you apply predictions in real
                                        scenarios.</p>
                                </div>
                                <div class="feature__item">
                                    <img src="{{ asset('frontend/images/feature/icon/3.png') }}" alt="Feature Icon">
                                    <h3 class="feature__title">Networking</h3>
                                    <p>Connect with a community of learners, researchers, and professionals who share your
                                        passion.</p>
                                </div>
                                <div class="feature__item">
                                    <img src="{{ asset('frontend/images/feature/icon/4.png') }}" alt="Feature Icon">
                                    <h3 class="feature__title">Exclusive Insights</h3>
                                    <p>Get early access to research, predictions, and trend reports before anyone else.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Feature area end -->



        <!-- Roll area start -->
        <section class="roll__area-2">
            <div class="swiper roll__slider swiper-initialized swiper-horizontal swiper-pointer-events">
                <div class="swiper-wrapper roll__wrapper">
                    <!-- Rashi Section -->
                    <div class="swiper-slide roll__slide">
                        <h2>Mesh (Aries)</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Vrishabh (Taurus)</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Mithun (Gemini)</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Kark (Cancer)</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Singh (Leo)</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Kanya (Virgo)</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Tula (Libra)</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Vrischik (Scorpio)</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Dhanu (Sagittarius)</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Makar (Capricorn)</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Kumbh (Aquarius)</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Meen (Pisces)</h2>
                    </div>
                </div>
            </div>
        </section>
        <!-- Roll area end -->


        <!-- Roll area start -->
        <section class="roll__area-3">
            <div dir="rtl"
                class="swiper roll__slider swiper-initialized swiper-horizontal swiper-pointer-events swiper-rtl">
                <div class="swiper-wrapper roll__wrapper">
                    <!-- Nakshatra Section -->
                    <div class="swiper-slide roll__slide">
                        <h2>Ashwini</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Bharani</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Krittika</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Rohini</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Mrigashira</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Ardra</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Punarvasu</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Pushya</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Ashlesha</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Magha</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Purva Phalguni</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Uttara Phalguni</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Hasta</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Chitra</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Swati</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Vishakha</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Anuradha</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Jyeshtha</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Moola</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Purva Ashadha</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Uttara Ashadha</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Shravana</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Dhanishta</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Shatabhisha</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Purva Bhadrapada</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Uttara Bhadrapada</h2>
                    </div>
                    <div class="swiper-slide roll__slide">
                        <h2>Revati</h2>
                    </div>
                </div>
            </div>
        </section>
        <!-- Roll area end -->




        <!-- Portfolio area start -->
        <section class="portfolio__area-2">
            <div class="container g-0 line pt-100 pb-140">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="sec-title-wrapper text-anim">
                            <h2 class="sec-title-3 title-anim" style="perspective: 400px;">
                                <div style="display: block; text-align: center;">Astro Market</div>
                                <div style="display: block; text-align: center;"><span>Insights</span></div>
                            </h2>
                            <p class="sec-text" style="perspective: 400px;">
                            <div style="display: block; text-align: center;">
                                Explore how planetary movements and cosmic patterns align with
                                <br> market cycles, stock predictions, and wealth opportunities.
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper portfolio__slider-2 swiper-fade swiper-initialized">
                <div class="swiper-wrapper">

                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <div class="portfolio__slide-2">
                            <div class="slide-img">
                                <a href="#"><img src="{{ asset('frontend/images/portfolio/2/1.jpg') }}"
                                        alt="Astro Trading Strategy"></a>
                            </div>
                            <div class="slide-content">
                                <h2 class="sec-title">
                                    <a href="#">Astro <span>Trading Strategy</span></a>
                                </h2>
                                <p>Learn how planetary signals shape profitable trading opportunities with precise timing.
                                </p>
                                <div class="btn-common-wrap">
                                    <a href="#" class="btn-common">Explore Strategy <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <div class="portfolio__slide-2">
                            <div class="slide-img">
                                <a href="#"><img src="{{ asset('frontend/images/portfolio/2/2.jpg') }}"
                                        alt="Market Predictions"></a>
                            </div>
                            <div class="slide-content">
                                <h2 class="sec-title"><a href="#">Market <span>Predictions</span></a></h2>
                                <p>Accurate forecasts on stock trends influenced by lunar phases and planetary motion.</p>
                                <div class="btn-common-wrap">
                                    <a href="#" class="btn-common">View Predictions <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="swiper-slide">
                        <div class="portfolio__slide-2">
                            <div class="slide-img">
                                <a href="#"><img src="{{ asset('frontend/images/portfolio/2/3.jpg') }}"
                                        alt="Moon Cycle"></a>
                            </div>
                            <div class="slide-content">
                                <h2 class="sec-title"><a href="#">Moon <span>Cycles</span></a></h2>
                                <p>Discover how new moon & full moon energy impacts global markets & investor behavior.</p>
                                <div class="btn-common-wrap">
                                    <a href="#" class="btn-common">Explore Cycles <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="swiper-slide">
                        <div class="portfolio__slide-2">
                            <div class="slide-img">
                                <a href="#"><img src="{{ asset('frontend/images/portfolio/2/4.jpg') }}"
                                        alt="Backtested Research"></a>
                            </div>
                            <div class="slide-content">
                                <h2 class="sec-title"><a href="#">Backtested <span>Research</span></a></h2>
                                <p>Deep research combining astrology & technicals with backtested data for accuracy.</p>
                                <div class="btn-common-wrap">
                                    <a href="#" class="btn-common">View Research <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 5 -->
                    <div class="swiper-slide">
                        <div class="portfolio__slide-2">
                            <div class="slide-img">
                                <a href="#"><img src="{{ asset('frontend/images/portfolio/2/5.jpg') }}"
                                        alt="Event Calendar"></a>
                            </div>
                            <div class="slide-content">
                                <h2 class="sec-title"><a href="#">Astro <span>Event Calendar</span></a></h2>
                                <p>Stay updated with eclipses, retrogrades & major planetary events influencing markets.</p>
                                <div class="btn-common-wrap">
                                    <a href="#" class="btn-common">Check Events <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Pagination -->
                <div class="portfolio__slider-2-pagination--">
                    <div class="swiper-pagination circle-pagination right"></div>
                </div>
            </div>
        </section>
        <!-- Portfolio area end -->



        <!-- About area start -->
        <section class="about__area-2">
            <div class="container pt-130 pb-110">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="sec-title-wrapper">
                            <h2 class="sec-title title-anim" style="perspective: 400px;">
                                <div style="display: block; text-align: start;">
                                    Empowering Traders with
                                </div>
                                <div style="display: block; text-align: start;">
                                    Astrological Insights
                                </div>
                                <div style="display: block; text-align: start;">
                                    for Smarter Trading Decisions
                                </div>
                                <div style="display: block; text-align: start;">
                                    and Predictive Analytics.
                                </div>
                            </h2>
                        </div>
                        <div class="sec-text-wrapper">
                            <div class="sec-text text-anim">
                                <p>
                                <div style="display: block; text-align: start;">
                                    Our platform combines the ancient wisdom of astrology
                                </div>
                                <div style="display: block; text-align: start;">
                                    with modern trading algorithms to help traders anticipate
                                </div>
                                <div style="display: block; text-align: start;">
                                    market movements and make informed investment decisions.
                                </div>
                                <div style="display: block; text-align: start;">
                                    By analyzing planetary positions and historical trends,
                                </div>
                                <div style="display: block; text-align: start;">
                                    we provide actionable insights that reduce risks and
                                </div>
                                <div style="display: block; text-align: start;">
                                    maximize trading opportunities.
                                </div>
                                </p>
                            </div>
                            <div class="sec-btn btn_wrapper">
                                <a class="wc-btn-pink btn-hover btn-item" href="#">
                                    <span></span> Explore Platform <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about__img-2 pb-130">
                <img src="{{ asset('frontend/images/about/2/1.jpg') }}" alt="About Image" data-speed="0.2"
                    data-lag="0">
            </div>

            <div class="container pb-140">
                <div class="row">
                    <div class="col-xxl-12">
                        <h2 class="brand__title-2 title-anim" style="perspective: 400px;">
                            <div style="display: block; text-align: center;">
                                Trusted by Traders Worldwide
                            </div>
                        </h2>
                        <div class="brand__list-2">
                            <div class="brand__item-2 fade_bottom">
                                <img src="{{ asset('frontend/images/brand/1.png') }}" alt="Brand Logo">
                            </div>
                            <div class="brand__item-2 fade_bottom">
                                <img src="{{ asset('frontend/images/brand/2.png') }}" alt="Brand Logo">
                            </div>
                            <div class="brand__item-2 fade_bottom">
                                <img src="{{ asset('frontend/images/brand/3.png') }}" alt="Brand Logo">
                            </div>
                            <div class="brand__item-2 fade_bottom">
                                <img src="{{ asset('frontend/images/brand/4.png') }}" alt="Brand Logo">
                            </div>
                            <div class="brand__item-2 fade_bottom">
                                <img src="{{ asset('frontend/images/brand/5.png') }}" alt="Brand Logo">
                            </div>
                            <div class="brand__item-2 fade_bottom">
                                <img src="{{ asset('frontend/images/brand/6.png') }}" alt="Brand Logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About area end -->


        <!-- Services area start -->
        <section class="service__area-2 pt-130 pb-140">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="sec-title-wrapper">
                            <h2 class="sec-title title-anim" style="perspective: 400px;">
                                <div style="display: block; text-align: center;">
                                    Our Astro Trading
                                </div>
                                <div style="display: block; text-align: center;">
                                    <span>Services</span>
                                </div>
                            </h2>
                            <p class="sec-text" style="perspective: 400px;">
                                <div style="display: block; text-align: center;">
                                    Comprehensive astrological solutions for modern traders
                                </div>
                                <div style="display: block; text-align: center;">
                                    combining cosmic wisdom with market intelligence.
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                        <div class="service__item-2 fade_bottom">
                            <div class="service__icon-2">
                                <img src="{{ asset('frontend/images/service/chart.png') }}" alt="Daily Predictions">
                            </div>
                            <h3 class="service__title-2">Daily Market Predictions</h3>
                            <p>Get precise daily forecasts based on planetary movements, Nakshatras, and market cycles to optimize your trading timing.</p>
                            <div class="service__btn-2">
                                <a href="#" class="btn-common">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                        <div class="service__item-2 fade_bottom">
                            <div class="service__icon-2">
                                <img src="{{ asset('frontend/images/service/moon.png') }}" alt="Lunar Trading">
                            </div>
                            <h3 class="service__title-2">Lunar Cycle Trading</h3>
                            <p>Harness the power of moon phases for strategic entry and exit points. New moon for accumulation, full moon for profit booking.</p>
                            <div class="service__btn-2">
                                <a href="#" class="btn-common">Explore <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                        <div class="service__item-2 fade_bottom">
                            <div class="service__icon-2">
                                <img src="{{ asset('frontend/images/service/planets.png') }}" alt="Planetary Analysis">
                            </div>
                            <h3 class="service__title-2">Planetary Market Analysis</h3>
                            <p>Deep analysis of how Mars affects volatility, Mercury influences communication stocks, and Venus impacts luxury goods.</p>
                            <div class="service__btn-2">
                                <a href="#" class="btn-common">Discover <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                        <div class="service__item-2 fade_bottom">
                            <div class="service__icon-2">
                                <img src="{{ asset('frontend/images/service/nakshatra.png') }}" alt="Nakshatra Trading">
                            </div>
                            <h3 class="service__title-2">Nakshatra-Based Strategy</h3>
                            <p>Specialized trading strategies based on 27 Nakshatras, each offering unique market opportunities and risk management.</p>
                            <div class="service__btn-2">
                                <a href="#" class="btn-common">Get Started <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                        <div class="service__item-2 fade_bottom">
                            <div class="service__icon-2">
                                <img src="{{ asset('frontend/images/service/eclipse.png') }}" alt="Eclipse Impact">
                            </div>
                            <h3 class="service__title-2">Eclipse Event Trading</h3>
                            <p>Special alerts and strategies for solar/lunar eclipses that historically create significant market movements and opportunities.</p>
                            <div class="service__btn-2">
                                <a href="#" class="btn-common">View Alerts <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                        <div class="service__item-2 fade_bottom">
                            <div class="service__icon-2">
                                <img src="{{ asset('frontend/images/service/personal.png') }}" alt="Personal Astro Trading">
                            </div>
                            <h3 class="service__title-2">Personal Astro Analysis</h3>
                            <p>Customized trading recommendations based on your birth chart, favorable trading days, and personalized risk assessment.</p>
                            <div class="service__btn-2">
                                <a href="#" class="btn-common">Get Personal <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services area end -->


        <!-- Counter area start -->
        <section class="counter__area-2 pt-130 pb-110">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="sec-title-wrapper pb-80">
                            <h2 class="sec-title title-anim" style="perspective: 400px;">
                                <div style="display: block; text-align: center;">
                                    Our Impact in Numbers
                                </div>
                            </h2>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <div class="counter__item-2 fade_bottom">
                            <h3 class="counter__number">15,000+</h3>
                            <p class="counter__text">Active Traders</p>
                            <div class="counter__border"></div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <div class="counter__item-2 fade_bottom">
                            <h3 class="counter__number">87%</h3>
                            <p class="counter__text">Prediction Accuracy</p>
                            <div class="counter__border"></div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <div class="counter__item-2 fade_bottom">
                            <h3 class="counter__number">500+</h3>
                            <p class="counter__text">Daily Predictions</p>
                            <div class="counter__border"></div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <div class="counter__item-2 fade_bottom">
                            <h3 class="counter__number">₹2.5Cr+</h3>
                            <p class="counter__text">Profits Generated</p>
                            <div class="counter__border"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Counter area end -->


        <!-- Award area start -->
        <section class="award__area pt-130 pb-140">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="sec-title-wrapper pb-140">
                            <h2 class="sec-title title-anim" style="perspective: 400px;">
                                <div style="display: block; text-align: start;">
                                    We’re recognized for Excellence in
                                </div>
                                <div style="display: block; text-align: start;">
                                    Astro-Trading Innovation
                                </div>
                                <div style="display: block; text-align: start;">
                                    and Predictive Trading Solutions Worldwide
                                </div>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="award__left">
                            <h4 class="award__text-2" style="transform: rotate(-43deg); opacity: 1;">award</h4>
                            <h3 class="award__text" style="transform: rotate(-43deg); opacity: 1;">award</h3>
                            <img src="{{ asset('frontend/images/shape/3.png') }}" alt="Shape Image" data-speed="1"
                                data-lag="0.2" style="transform: translate(0px, 0px); will-change: transform;">
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="award__right">
                            <p>Our Astro-Trading platform is dedicated to providing traders with astrological insights,
                                predictive market signals, and advanced analytics to make informed trading decisions with
                                confidence.</p>
                            <div class="award__list">
                                <div class="award__item">
                                    <p>AstroTrader</p>
                                    <p>Nominee</p>
                                    <p>2025</p>
                                </div>
                                <div class="award__item">
                                    <p>Market Astrology Awards</p>
                                    <p>Winner</p>
                                    <p>2024</p>
                                </div>
                                <div class="award__item">
                                    <p>Global Trading Innovations</p>
                                    <p>Nominee</p>
                                    <p>2023</p>
                                </div>
                                <div class="award__item">
                                    <p>FinTech Astrology Awards</p>
                                    <p>Winner</p>
                                    <p>2022</p>
                                </div>
                                <div class="award__item">
                                    <p>Predictive Analytics Excellence</p>
                                    <p>Winner</p>
                                    <p>2021</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Award area end -->


        <!-- Testimonials area start -->
        <section class="testimonial__area-2 pt-130 pb-140">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="sec-title-wrapper pb-80">
                            <h2 class="sec-title title-anim" style="perspective: 400px;">
                                <div style="display: block; text-align: center;">
                                    What Our Traders Say
                                </div>
                                <div style="display: block; text-align: center;">
                                    About <span>Astro Trading</span>
                                </div>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="swiper testimonial__slider-2 swiper-initialized">
                    <div class="swiper-wrapper">
                        <!-- Testimonial 1 -->
                        <div class="swiper-slide">
                            <div class="testimonial__item-2">
                                <div class="testimonial__content-2">
                                    <div class="testimonial__rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <p class="testimonial__text-2">"Using Nakshatra-based predictions has completely transformed my trading strategy. The accuracy of market timing based on lunar cycles is remarkable. I've seen 40% improvement in my profits since joining this platform."</p>
                                </div>
                                <div class="testimonial__author-2">
                                    <div class="testimonial__avatar">
                                        <img src="{{ asset('frontend/images/testimonial/user1.jpg') }}" alt="Rajesh Kumar">
                                    </div>
                                    <div class="testimonial__info">
                                        <h4 class="testimonial__name">Rajesh Kumar</h4>
                                        <p class="testimonial__designation">Day Trader, Mumbai</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 2 -->
                        <div class="swiper-slide">
                            <div class="testimonial__item-2">
                                <div class="testimonial__content-2">
                                    <div class="testimonial__rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <p class="testimonial__text-2">"The eclipse event alerts saved me from major losses during market volatility. Their planetary analysis for different sectors is incredibly accurate. As a long-term investor, this has been a game-changer."</p>
                                </div>
                                <div class="testimonial__author-2">
                                    <div class="testimonial__avatar">
                                        <img src="{{ asset('frontend/images/testimonial/user2.jpg') }}" alt="Priya Sharma">
                                    </div>
                                    <div class="testimonial__info">
                                        <h4 class="testimonial__name">Priya Sharma</h4>
                                        <p class="testimonial__designation">Portfolio Manager, Delhi</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="swiper-slide">
                            <div class="testimonial__item-2">
                                <div class="testimonial__content-2">
                                    <div class="testimonial__rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <p class="testimonial__text-2">"Initially skeptical about astrology in trading, but their data-driven approach with backtested results convinced me. The personal astro analysis based on my birth chart provides insights I never imagined."</p>
                                </div>
                                <div class="testimonial__author-2">
                                    <div class="testimonial__avatar">
                                        <img src="{{ asset('frontend/images/testimonial/user3.jpg') }}" alt="Amit Patel">
                                    </div>
                                    <div class="testimonial__info">
                                        <h4 class="testimonial__name">Amit Patel</h4>
                                        <p class="testimonial__designation">Swing Trader, Ahmedabad</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 4 -->
                        <div class="swiper-slide">
                            <div class="testimonial__item-2">
                                <div class="testimonial__content-2">
                                    <div class="testimonial__rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <p class="testimonial__text-2">"The daily predictions help me plan my trades in advance. Mercury retrograde warnings and Mars aspects on market volatility are spot-on. This platform bridges ancient wisdom with modern finance perfectly."</p>
                                </div>
                                <div class="testimonial__author-2">
                                    <div class="testimonial__avatar">
                                        <img src="{{ asset('frontend/images/testimonial/user4.jpg') }}" alt="Neha Gupta">
                                    </div>
                                    <div class="testimonial__info">
                                        <h4 class="testimonial__name">Neha Gupta</h4>
                                        <p class="testimonial__designation">Options Trader, Bangalore</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="testimonial__navigation">
                        <div class="testimonial-button-prev"><i class="fa-solid fa-arrow-left"></i></div>
                        <div class="testimonial-button-next"><i class="fa-solid fa-arrow-right"></i></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonials area end -->



        <!-- CTA area start -->
        <section class="cta__area-2">
            <div class="container line pt-130 pb-120">
                <div class="line-3"></div>
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="cta__content-2">
                            <p class="cta__sub-title-2 title-anim" style="perspective: 400px;">
                            <div style="display: block; text-align: center;">
                                Want to Predict Market Trends?
                            </div>
                            </p>
                            <h2 class="cta__title-2 title-anim" style="perspective: 400px;">
                                <div style="display: block; text-align: center;">
                                    Leverage Astrology for Smarter
                                </div>
                                <div style="display: block; text-align: center;">
                                    Trading Decisions Today!
                                </div>
                            </h2>
                            <div class="btn_wrapper" style="transform: translate(0px, 0px); opacity: 1;">
                                <a href="https://www.wealcoder.com/dev/html/axtra/contact.html"
                                    class="wc-btn-pink btn-hover btn-item" style="transform: translate(0px, 0px);">
                                    <span style="top: -25px; left: 190px;"></span>
                                    Get Started Now <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- CTA area end -->



       <!-- Blog area start -->
<section class="blog__area-2 blog__animation">
    <div class="container g-0 pt-150 pb-110">
        <div class="row ">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4">
                <div class="sec-title-wrapper">
                    <h2 class="sec-title title-anim" style="perspective: 400px;">
                        <div style="display: block; text-align: start;">Latest</div>
                        <div style="display: block; text-align: start;">Astro-Trading Insights</div>
                    </h2>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-4">
                <div class="sec-text text-anim">
                    <p style="perspective: 400px;">
                        <div style="display: block; text-align: start;">
                            Stay ahead in trading with our daily astrological predictions, market trends, and insights.
                        </div>
                        <div style="display: block; text-align: start;">
                            Our analyses combine ancient Nakshatra wisdom with modern market strategies.
                        </div>
                        <div style="display: block; text-align: start;">
                            Make informed decisions and maximize your trading potential.
                        </div>
                    </p>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-3 col-md-4">
                <div class="sec-btn btn_wrapper">
                    <a href="https://www.wealcoder.com/dev/html/axtra/blog.html"
                       class="wc-btn-pink btn-hover btn-item"><span></span> Read <br>All Insights <i
                            class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4">
                <article class="blog__item-2">
                    <div class="blog__img-wrapper">
                        <a href="#">
                            <div class="img-box">
                                <img class="image-box__item" src="{{ asset('frontend/images/blog/astro1.jpg') }}" alt="Astro Insight">
                                <img class="image-box__item" src="{{ asset('frontend/images/blog/astro1.jpg') }}" alt="Astro Insight">
                            </div>
                        </a>
                    </div>
                    <h4 class="blog__meta-2"><a href="#">Market Astrology</a> . 28 Aug 2025</h4>
                    <h5><a href="#" class="blog__title-2">How Nakshatras Influence Daily Trading Decisions</a></h5>
                </article>
            </div>

            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4">
                <article class="blog__item-2">
                    <div class="blog__img-wrapper">
                        <a href="#">
                            <div class="img-box">
                                <img class="image-box__item" src="{{ asset('frontend/images/blog/astro2.jpg') }}" alt="Astro Insight">
                                <img class="image-box__item" src="{{ asset('frontend/images/blog/astro2.jpg') }}" alt="Astro Insight">
                            </div>
                        </a>
                    </div>
                    <h4 class="blog__meta-2"><a href="#">Trading Strategies</a> . 27 Aug 2025</h4>
                    <h5><a href="#" class="blog__title-2">Using Astrology to Predict Market Volatility</a></h5>
                </article>
            </div>

            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4">
                <article class="blog__item-2">
                    <div class="blog__img-wrapper">
                        <a href="#">
                            <div class="img-box">
                                <img class="image-box__item" src="{{ asset('frontend/images/blog/astro3.jpg') }}" alt="Astro Insight">
                                <img class="image-box__item" src="{{ asset('frontend/images/blog/astro3.jpg') }}" alt="Astro Insight">
                            </div>
                        </a>
                    </div>
                    <h4 class="blog__meta-2"><a href="#">Nakshatra Forecasts</a> . 26 Aug 2025</h4>
                    <h5><a href="#" class="blog__title-2">Top Nakshatra-Based Tips for Traders This Week</a></h5>
                </article>
            </div>
        </div>
    </div>
</section>
<!-- Blog area end -->


        <!-- FAQ area start -->
        <section class="faq__area-2 pt-130 pb-140">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="sec-title-wrapper pb-80">
                            <h2 class="sec-title title-anim" style="perspective: 400px;">
                                <div style="display: block; text-align: center;">
                                    Frequently Asked
                                </div>
                                <div style="display: block; text-align: center;">
                                    <span>Questions</span>
                                </div>
                            </h2>
                            <p class="sec-text" style="perspective: 400px;">
                                <div style="display: block; text-align: center;">
                                    Get answers to common questions about astro trading
                                </div>
                                <div style="display: block; text-align: center;">
                                    and how cosmic patterns influence market movements.
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xxl-8 col-xl-8 col-lg-8 offset-xxl-2 offset-xl-2 offset-lg-2">
                        <div class="faq__wrapper">
                            <!-- FAQ Item 1 -->
                            <div class="faq__item">
                                <div class="faq__question">
                                    <h3>How does astrology help in trading decisions?</h3>
                                    <span class="faq__icon"><i class="fa-solid fa-plus"></i></span>
                                </div>
                                <div class="faq__answer">
                                    <p>Astrology provides timing insights through planetary movements, lunar cycles, and Nakshatra positions. These cosmic patterns have historically aligned with market cycles, helping traders identify optimal entry and exit points. Our system combines traditional astrological knowledge with modern backtested data to provide accurate predictions.</p>
                                </div>
                            </div>
                            
                            <!-- FAQ Item 2 -->
                            <div class="faq__item">
                                <div class="faq__question">
                                    <h3>What is the accuracy rate of your predictions?</h3>
                                    <span class="faq__icon"><i class="fa-solid fa-plus"></i></span>
                                </div>
                                <div class="faq__answer">
                                    <p>Our predictions have an average accuracy rate of 87% based on historical backtesting over the last 10 years. We track major planetary transits, eclipse events, and Nakshatra changes that correlate with significant market movements. Results vary based on market conditions and the type of prediction (short-term vs long-term).</p>
                                </div>
                            </div>
                            
                            <!-- FAQ Item 3 -->
                            <div class="faq__item">
                                <div class="faq__question">
                                    <h3>Do I need to know astrology to use your platform?</h3>
                                    <span class="faq__icon"><i class="fa-solid fa-plus"></i></span>
                                </div>
                                <div class="faq__answer">
                                    <p>No, you don't need any prior knowledge of astrology. Our platform provides simplified, actionable trading insights without complex astrological jargon. We translate cosmic patterns into clear buy/sell signals, market timing advice, and risk management strategies that any trader can understand and implement.</p>
                                </div>
                            </div>
                            
                            <!-- FAQ Item 4 -->
                            <div class="faq__item">
                                <div class="faq__question">
                                    <h3>What makes your approach different from technical analysis?</h3>
                                    <span class="faq__icon"><i class="fa-solid fa-plus"></i></span>
                                </div>
                                <div class="faq__answer">
                                    <p>While technical analysis focuses on past price movements, astro trading anticipates future market behavior through predictable cosmic cycles. We combine both approaches - using planetary movements to time entries and technical indicators to confirm signals. This dual approach often provides earlier warning signals than traditional methods alone.</p>
                                </div>
                            </div>
                            
                            <!-- FAQ Item 5 -->
                            <div class="faq__item">
                                <div class="faq__question">
                                    <h3>How often do you provide trading recommendations?</h3>
                                    <span class="faq__icon"><i class="fa-solid fa-plus"></i></span>
                                </div>
                                <div class="faq__answer">
                                    <p>We provide daily market outlook based on current planetary positions, weekly Nakshatra forecasts, and special alerts for major cosmic events like eclipses or planetary retrogrades. Subscribers receive morning briefings, intraday updates during significant planetary aspects, and monthly long-term trend analysis.</p>
                                </div>
                            </div>
                            
                            <!-- FAQ Item 6 -->
                            <div class="faq__item">
                                <div class="faq__question">
                                    <h3>Can this approach work for all types of trading?</h3>
                                    <span class="faq__icon"><i class="fa-solid fa-plus"></i></span>
                                </div>
                                <div class="faq__answer">
                                    <p>Yes, astro trading works across different trading styles. Day traders benefit from lunar phases and daily planetary aspects, swing traders use weekly Nakshatra cycles, and long-term investors leverage major planetary transits. We provide specific strategies tailored for stocks, commodities, forex, and cryptocurrency markets.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FAQ area end -->


        <!-- Newsletter area start -->
        <section class="newsletter__area-2 pt-130 pb-140">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="newsletter__wrapper">
                            <div class="newsletter__content">
                                <h2 class="newsletter__title title-anim" style="perspective: 400px;">
                                    <div style="display: block; text-align: center;">
                                        Stay Updated with
                                    </div>
                                    <div style="display: block; text-align: center;">
                                        <span>Cosmic Trading Signals</span>
                                    </div>
                                </h2>
                                <p class="newsletter__text">
                                    Get daily astro predictions, eclipse alerts, and Nakshatra-based trading insights delivered to your inbox. Never miss a cosmic trading opportunity again.
                                </p>
                            </div>
                            
                            <div class="newsletter__form">
                                <form action="#" method="POST">
                                    <div class="newsletter__input-group">
                                        <input type="email" placeholder="Enter your email address" required>
                                        <button type="submit" class="wc-btn-pink btn-hover">
                                            Subscribe Now <i class="fa-solid fa-arrow-right"></i>
                                        </button>
                                    </div>
                                    <div class="newsletter__checkbox">
                                        <input type="checkbox" id="newsletter-agree" required>
                                        <label for="newsletter-agree">I agree to receive astrological trading insights and market predictions via email.</label>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="newsletter__features">
                                <div class="newsletter__feature">
                                    <i class="fa-solid fa-moon"></i>
                                    <span>Daily Lunar Insights</span>
                                </div>
                                <div class="newsletter__feature">
                                    <i class="fa-solid fa-star"></i>
                                    <span>Nakshatra Forecasts</span>
                                </div>
                                <div class="newsletter__feature">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <span>Market Predictions</span>
                                </div>
                                <div class="newsletter__feature">
                                    <i class="fa-solid fa-bell"></i>
                                    <span>Eclipse Alerts</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Newsletter area end -->

    </main>
@endsection

@section('script-bottom')
<script>
// FAQ Accordion Functionality
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq__item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq__question');
        const answer = item.querySelector('.faq__answer');
        const icon = item.querySelector('.faq__icon i');
        
        question.addEventListener('click', function() {
            const isActive = item.classList.contains('active');
            
            // Close all FAQ items
            faqItems.forEach(otherItem => {
                otherItem.classList.remove('active');
                otherItem.querySelector('.faq__answer').style.maxHeight = null;
                otherItem.querySelector('.faq__icon i').classList.remove('fa-minus');
                otherItem.querySelector('.faq__icon i').classList.add('fa-plus');
            });
            
            // If item wasn't active, open it
            if (!isActive) {
                item.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px';
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            }
        });
    });
});

// Testimonial Slider
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper !== 'undefined') {
        var testimonialSlider = new Swiper('.testimonial__slider-2', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.testimonial-button-next',
                prevEl: '.testimonial-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 50,
                }
            }
        });
    }
});

// Newsletter Form Handling
document.addEventListener('DOMContentLoaded', function() {
    const newsletterForm = document.querySelector('.newsletter__form form');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = this.querySelector('input[type="email"]').value;
            const checkbox = this.querySelector('input[type="checkbox"]').checked;
            
            if (!email) {
                alert('Please enter your email address.');
                return;
            }
            
            if (!checkbox) {
                alert('Please agree to receive astrological trading insights.');
                return;
            }
            
            // Show success message
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            
            button.innerHTML = 'Subscribed! <i class="fa-solid fa-check"></i>';
            button.style.background = '#28a745';
            
            setTimeout(() => {
                button.innerHTML = originalText;
                button.style.background = '';
                this.reset();
            }, 3000);
        });
    }
});

// Counter Animation
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.counter__number');
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = counter.textContent;
                const numTarget = parseInt(target.replace(/[^\d]/g, ''));
                const suffix = target.replace(/[\d,]/g, '');
                
                let count = 0;
                const increment = numTarget / 100;
                
                const timer = setInterval(() => {
                    count += increment;
                    if (count >= numTarget) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        const displayNum = Math.floor(count);
                        counter.textContent = displayNum.toLocaleString() + suffix;
                    }
                }, 20);
                
                observer.unobserve(counter);
            }
        });
    }, observerOptions);

    counters.forEach(counter => {
        observer.observe(counter);
    });
});
</script>
@endsection
