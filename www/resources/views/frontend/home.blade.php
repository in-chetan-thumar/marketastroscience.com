@extends('frontend.layouts.master')

@section('title')
    Home
@endsection

@section('css')
    <style>
        .thank-you-message {
            text-align: center;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            /* padding: 20px; */
            /* margin: 50px auto; */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }

        .thank-you-message h5 {
            font-size: 24px;
            color: #4caf50;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .thank-you-message p {
            font-size: 16px;
            color: #6c757d;
        }
    </style>
@endsection

@section('content')
    <section class="banner">
        <div class="container-fluid">
            <div class="banner_info">
                <div class="banner_logo">
                    <a href="index.html">
                        <img src="{{ asset('frontend/images/logo.gif') }}" alt="Market Astro Science"
                            title="Market Astro Science" />
                    </a>
                </div>
                <div class="banner_text">
                    <h1>India's 1st Astro-Analysis Platform</h1>
                    <p>Guiding Traders With The Power Of Astrology!</p>
                    <p>Discover how astrology meets the stock market in a revolutionary approach to trading. Our platform
                        combines
                        the wisdom of planetary movements with market analysis to help traders make informed decisions.</p>
                </div>
                <div class="arrow_sec">
                    <a href="#">
                        <img src="{{ asset('frontend/images/arrow-down.svg') }}" alt="Arrow" title="Arrow" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="blog_sec">
        <div class="container-fluid">
            <h4>Blogs</h4>
            <p class="subtitle">Guidance, expertise, and thought leadership to fuel your growth.</p>
            <ul class="blogs_block owl-carousel">
                @forelse($blogs as $blog)
                    <li>
                        <div class="blog_block blog1" style="background-image: url('../storage/blog/{{ $blog->file }}');">
                            <div class="blog_date">
                                <p>{{ \Carbon\Carbon::parse($blog->blog_date)->format('d F Y') }}</p>
                            </div>
                            <div class="blog_info">
                                <h5>{{ $blog->title }}</h5>
                                <p>{{ $blog->description }}</p>
                            </div>
                        </div>
                    </li>
                @empty
                    <li>Blogs not found</li>
                @endforelse
            </ul>
        </div>
    </section>

    <section class="join_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-6 join_left">
                    <div class="join_img">
                        <img src="{{ asset('frontend/images/join-us.svg') }}" alt="" title="" />
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="join_us_block">
                        <h4>Join Us now! </h4>
                        <p>be the first to explore the fusion of astrology and trading.</p>
                        <div class="row thank-you-message" style="display: none">
                            <div class="col-md-12 col-lg-12">
                                <div class="text-center pt-4 pb-2">
                                    {{-- <div class="mb-4">
                                        <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop"
                                            colors="primary:#0ab39c,secondary:#405189"
                                            style="width:120px;height:120px"></lord-icon>
                                    </div> --}}
                                    <h5>Thank You !</h5>
                                    <p class="text-muted">Your form has been successfully submitted. We truly appreciate
                                        your input!</p>
                                </div>
                            </div>
                        </div>
                        {{ html()->form('POST', route('enquiry.store'))->id('enquiry-form')->open() }}
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="join_form">
                                    {{ html()->input('text', 'name', old('name'))->placeholder('Enter name')->class('form-control ' . ($errors->has('name') ? 'is-invalid' : '')) }}
                                    @error('name')
                                        <span class="invalid-feedback form-text" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="join_form">
                                    {{ html()->input('email', 'email', old('email'))->placeholder('Enter email')->class('form-control ' . ($errors->has('email') ? 'is-invalid' : '')) }}
                                    @error('email')
                                        <span class="invalid-feedback form-text" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="join_form">
                                    {{ html()->input('text', 'number', old('number'))->placeholder('Enter number')->attributes(['oninput' => 'this.value = this.value.replace(/[^0-9]/g, "")', 'maxlength' => '10'])->class('form-control ' . ($errors->has('number') ? 'is-invalid' : '')) }}
                                    @error('number')
                                        <span class="invalid-feedback form-text" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="join_form">
                                    {{ html()->select('master_state_id', $states, old('master_state_id'))->placeholder('Select state')->id('master_state_dropdown')->class('form-control form-select' . ($errors->has('master_state_id') ? 'is-invalid' : '')) }}
                                    @error('master_state_id')
                                        <span class="invalid-feedback form-text" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="join_form">
                                    {{ html()->select('master_tehsil_id', [], old('master_tehsil_id'))->placeholder('Select city')->id('master_tehshil_dropdown')->class('form-control form-select' . ($errors->has('master_tehsil_id') ? 'is-invalid' : '')) }}
                                    @error('master_tehsil_id')
                                        <span class="invalid-feedback form-text" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form_btn">
                            <button type="submit">Sign Up</button>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="video_sec">
        <iframe width="100%" height="700" src="https://www.youtube.com/embed/tgbNymZ7vqY?">
        </iframe>
    </section>

    <section class="testimonial_sec">
        <div class="container">
            <ul class="testimonial_block owl-carousel">
                <li>
                    <div class="row">
                        <div class="col-md-12 col-lg-6 testi_left">
                            <div class="testmonial_left">
                                <h4>J.P.Morgon</h4>
                                <p>Millionaires don't use Astrology billionaires do</p>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 testi_right">
                            <div class="testimonial_right">
                                <img src="{{ asset('frontend/images/john.webp') }}" alt="John" title="John" />
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-md-12 col-lg-6 testi_left">
                            <div class="testmonial_left">
                                <h4>Varahamihira</h4>
                                <p>There is no better boat than a horoscope to help a man cross over the sea of life</p>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 testi_right">
                            <div class="testimonial_right">
                                <img src="{{ asset('frontend/images/varahamihira.jpg') }}" alt="Varahamihira"
                                    title="Varahamihira" />
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <div class="col-md-12 col-lg-6 testi_left">
                            <div class="testmonial_left">
                                <h4>Albert Einstein</h4>
                                <p>Astrology is a science in itself and contains an illuminating body of knowledge. It
                                    taught me many things and I am greatly indebted to it.</p>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 testi_right">
                            <div class="testimonial_right">
                                <img src="{{ asset('frontend/images/albert-einstein.jpg') }}" alt="John"
                                    title="John" />
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section class="trusted_sec">
        <div class="container">
            <h4>Trusted By </h4>
            <p class="subtitle">Trusted by Industry Leaders, Backed by Proven Excellence</p>
            <ul>
                <li>
                    <p>Logo</p>
                </li>
                <li>
                    <p>Logo</p>
                </li>
                <li>
                    <p>Logo</p>
                </li>
                <li>
                    <p>Logo</p>
                </li>
                <li>
                    <p>Logo</p>
                </li>
                <li>
                    <p>Logo</p>
                </li>
                <li>
                    <p>Logo</p>
                </li>
                <li>
                    <p>Logo</p>
                </li>
                <li>
                    <p>Logo</p>
                </li>
            </ul>
        </div>
    </section>
@endsection

@section('script-bottom')
    <script type="text/javascript" src="{{ asset('assets/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\EnquiryRequest', '#enquiry-form') !!}
    <script>
        $(document).ready(function() {
            $('#enquiry-form').submit(function(e) {
                e.preventDefault(); // Prevent normal form submission

                var formData = $(this).serialize(); // Serialize the form data

                $.ajax({
                    url: $(this).attr('action'), // Form action URL
                    method: 'POST', // Request method
                    data: formData, // Serialized form data
                    success: function(response) {
                        if (!response.error) {
                            // Hide the form and show the thank you message
                            $('#enquiry-form').hide();
                            $('.thank-you-message').show();
                        } else {
                            // If there are validation errors, show them
                            if (response.errors) {
                                $.each(response.errors, function(field, message) {
                                    $('#' + field).addClass('is-invalid');
                                    $('#' + field).next('.invalid-feedback').html(
                                        message);
                                });
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.error('AJAX Error: ' + error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#master_state_dropdown').change(function() {
                var stateId = $(this).val(); // Get the selected state ID

                if (stateId) {
                    // Clear and disable the tehsil dropdown while loading
                    $('#master_tehshil_dropdown').html('<option value="">Loading...</option>').prop(
                        'disabled', true);

                    // Make the AJAX call
                    $.ajax({
                        url: '/get-districts', // The URL for your route
                        method: 'GET',
                        data: {
                            state_id: stateId
                        },
                        success: function(response) {
                            if (response.success) {
                                var options =
                                    '<option value="">Select city</option>'; // Default placeholder
                                $.each(response.data, function(index, district) {
                                    options += '<option value="' + index + '">' +
                                        district + '</option>';
                                });

                                $('#master_tehshil_dropdown').html(options).prop('disabled',
                                    false); // Populate and enable
                            } else {
                                toastr.error(response.message);
                                $('#master_tehshil_dropdown').html(
                                    '<option value="">No cities found</option>').prop(
                                    'disabled', true);
                            }
                        },
                        error: function() {
                            alert('Error fetching districts. Please try again.');
                        }
                    });
                } else {
                    // Reset tehsil dropdown if no state is selected
                    $('#master_tehshil_dropdown').html('<option value="">Select city</option>').prop(
                        'disabled', true);
                }
            });
        });
    </script>
    <script>
        $('.testimonial_block.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 1,
                    nav: true
                },
                1000: {
                    items: 1,
                    nav: true
                }
            }
        })

        $('.blogs_block.owl-carousel').owlCarousel({
            loop: true,
            margin: 20,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 2,
                    nav: true
                },
                1000: {
                    items: 3,
                    nav: true
                }
            }
        })
    </script>
@endsection
