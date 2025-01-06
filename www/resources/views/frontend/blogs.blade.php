@extends('frontend.layouts.master')

@section('title')
    Blogs
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
    @if ($blog)
        <section class="blog_detail">
            <div class="container-fluid">
                <h3>{{ $blog->title }}</h3>
                <span>{{ \Carbon\Carbon::parse($blog->blog_date)->format('d F Y') }}</span>
                <div class="blog_detail_block">
                    <div class="blog_img"
                        style="background-image: url('{{ asset('storage/blog/' . $blog->file) }}'); background-repeat: no-repeat; background-position: left center;">
                    </div>
                    <div class="blog_info">
                        <p>{{ $blog->description }}</p>
                    </div>
                </div>
            </div>
        </section>
    @else
        @forelse($other_blogs as $other_blog)
            @if ($loop->first)
                <section class="blog_detail">
                    <div class="container-fluid">
                        <h3>{{ $other_blog->title }}</h3>
                        <span>{{ \Carbon\Carbon::parse($other_blog->blog_date)->format('d F Y') }}</span>
                        <div class="blog_detail_block">
                            <div class="blog_img"
                                style="background-image: url('{{ asset('storage/blog/' . $other_blog->file) }}'); background-repeat: no-repeat; background-position: left center;">
                            </div>

                            <div class="blog_info">
                                <p>{{ $other_blog->description }}</p>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @empty
            <p>No blog found</p>
        @endforelse
    @endif
    <section class="blog_list">
        <div class="container-fluid">
            @forelse($other_blogs as $other_blog)
                <div class="blog_list_block">
                    <div class="blog_list_img">
                        <img src="{{ asset('storage/blog/' . $other_blog->file) }}" alt="{{ $other_blog->title }}"
                            title="Trading Psychology" />
                        <div class="blog_date">
                            <p>{{ \Carbon\Carbon::parse($other_blog->blog_date)->format('d F Y') }}</p>
                        </div>
                    </div>
                    <div class="blog_list_info">
                        <h3>{{ $other_blog->title }}</h3>
                        <p>{{ $other_blog->description }}</p>

                        {{-- <p>Common emotions that traders experience:</p>

                        <p>Traders Typically experience a multitude of emotions du...</p> --}}
                    </div>
                    <div class="blog_list_more">
                        <a href="{{ route('blog.view', $other_blog->slug) }}"><img
                                src="{{ asset('frontend/images/arrow-right.svg') }}" alt="Arrow" title="Arrow" /></a>
                    </div>
                </div>
            @empty
                <p>No blogs found</p>
            @endforelse
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
@endsection
