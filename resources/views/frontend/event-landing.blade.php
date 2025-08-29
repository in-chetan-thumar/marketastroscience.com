@extends('frontend.layouts.master')

@section('title')
Astro Trading Masterclass 2025 - FREE Registration | Market Astro Science
@endsection

@section('meta')
<meta name="description" content="Join the Astro Trading Masterclass 2025! Learn financial astrology trading techniques. FREE registration for limited seats. Get personalized birth chart insights.">
<meta name="keywords" content="astro trading, financial astrology, trading masterclass, market astrology">
<meta property="og:title" content="Astro Trading Masterclass 2025 - FREE Registration">
<meta property="og:description" content="Join the exclusive Astro Trading Masterclass 2025. Learn how planetary movements affect financial markets. Limited seats available!">
<meta property="og:image" content="{{ asset('frontend/images/event-banner.jpg') }}">
@endsection

@section('content')
<main>
    <!-- Event Header Section -->
    <section class="hero__area-3" style="background: linear-gradient(135deg, #051536 0%, #1a2332 100%);">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="hero__content-3 text-center">
                        <h1 class="hero__title-3 title-anim fade_bottom" style="color: #fff; margin-bottom: 20px;">
                            🌟 Astro Trading Masterclass 2025
                        </h1>
                        
                        <p class="hero__text-3 fade_bottom_2" style="color: rgba(255,255,255,0.9); font-size: 18px; margin-bottom: 30px;">
                            Discover the Ancient Secrets of Financial Astrology<br>
                            <span style="color: #F18603; font-weight: 600;">Master the Art of Planetary Trading Strategies</span>
                        </p>
                        
                        <!-- Event Details -->
                        <div class="event-details fade_bottom_3" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 20px; padding: 30px; margin: 40px auto; max-width: 600px;">
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; text-align: left;">
                                <div>
                                    <h4 style="color: #F18603; margin-bottom: 10px; font-size: 16px;">📅 Event Date</h4>
                                    <p style="color: #fff; margin: 0;">January 15, 2025</p>
                                    <p style="color: rgba(255,255,255,0.8); margin: 0; font-size: 14px;">Thursday, 7:00 PM IST</p>
                                </div>
                                <div>
                                    <h4 style="color: #F18603; margin-bottom: 10px; font-size: 16px;">🎯 What You'll Learn</h4>
                                    <p style="color: #fff; margin: 0; font-size: 14px;">✨ Planetary market cycles</p>
                                    <p style="color: #fff; margin: 0; font-size: 14px;">📈 Astrological timing strategies</p>
                                    <p style="color: #fff; margin: 0; font-size: 14px;">💫 Personalized chart insights</p>
                                </div>
                            </div>
                            
                            <div style="text-align: center; margin-top: 25px;">
                                <p style="color: #F18603; font-size: 18px; font-weight: 700; margin: 0;">💯 Completely FREE Event</p>
                                <p style="color: rgba(255,255,255,0.9); font-size: 14px; margin: 5px 0 0 0;">Limited to 50 participants only</p>
                            </div>
                        </div>
                        
                        <div class="btn_wrapper fade_bottom_4">
                            <a href="#registration" class="wc-btn-pink btn-hover btn-item">
                                <span></span>Register Now - FREE
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What You'll Learn Section -->
    <section class="feature__area-2 section-padding-140">
        <div class="container">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="sec-title-wrapper fade_bottom">
                        <h2 class="sec-title-2 title-anim">What You'll Discover</h2>
                        <p class="sec-text">Unlock the secrets of financial astrology that professional traders use to predict market movements.</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                    <div class="feature__item-2 fade_bottom">
                        <div class="feature__icon-2">
                            <span style="font-size: 2rem;">🪐</span>
                        </div>
                        <div class="feature__content-2">
                            <h3 class="feature__title-2">Planetary Cycles</h3>
                            <p class="feature__text-2">Learn how planetary movements create predictable patterns in financial markets and trading opportunities.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                    <div class="feature__item-2 fade_bottom_2">
                        <div class="feature__icon-2">
                            <span style="font-size: 2rem;">⏰</span>
                        </div>
                        <div class="feature__content-2">
                            <h3 class="feature__title-2">Perfect Timing</h3>
                            <p class="feature__text-2">Master the art of timing your trades using astrological calculations and cosmic events.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                    <div class="feature__item-2 fade_bottom_3">
                        <div class="feature__icon-2">
                            <span style="font-size: 2rem;">📊</span>
                        </div>
                        <div class="feature__content-2">
                            <h3 class="feature__title-2">Personal Chart Analysis</h3>
                            <p class="feature__text-2">Get personalized insights based on your birth chart to enhance your trading strategy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Speakers Section -->
    <section class="speakers__area section-padding-140">
        <div class="container">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 offset-xxl-3 offset-xl-3 offset-lg-3">
                    <div class="sec-title-wrapper text-center fade_bottom">
                        <h2 class="sec-title-2 title-anim">Meet Your Expert Speakers</h2>
                        <p class="sec-text">Learn from renowned experts in financial astrology and market analysis</p>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-xxl-10 col-xl-10 col-lg-12">
                    <div class="speakers-grid">
                        <div class="speaker-card fade_bottom">
                            <div class="speaker-avatar">
                                <img src="{{ asset('frontend/images/speakers/dr-astro.jpg') }}" alt="Dr. Rajesh Astro" class="speaker-img">
                                <div class="speaker-badge">Lead Expert</div>
                            </div>
                            <div class="speaker-info">
                                <h4 class="speaker-name">Dr. Rajesh Kumar</h4>
                                <p class="speaker-title">Financial Astrologer & Market Analyst</p>
                                <p class="speaker-experience">20+ years experience in Vedic astrology and stock market prediction</p>
                            </div>
                        </div>
                        
                        <div class="speaker-card fade_bottom_2">
                            <div class="speaker-avatar">
                                <img src="{{ asset('frontend/images/speakers/trading-expert.jpg') }}" alt="Priya Sharma" class="speaker-img">
                                <div class="speaker-badge">Trading Expert</div>
                            </div>
                            <div class="speaker-info">
                                <h4 class="speaker-name">Priya Sharma</h4>
                                <p class="speaker-title">Professional Day Trader</p>
                                <p class="speaker-experience">15+ years in equity markets with astrological timing strategies</p>
                            </div>
                        </div>
                        
                        <div class="speaker-card fade_bottom_3">
                            <div class="speaker-avatar">
                                <img src="{{ asset('frontend/images/speakers/vedic-expert.jpg') }}" alt="Acharya Vishnu" class="speaker-img">
                                <div class="speaker-badge">Vedic Expert</div>
                            </div>
                            <div class="speaker-info">
                                <h4 class="speaker-name">Acharya Vishnu</h4>
                                <p class="speaker-title">Vedic Astrology Master</p>
                                <p class="speaker-experience">25+ years in traditional astrology and market predictions</p>
                            </div>
                        </div>
                        
                        <div class="speaker-card fade_bottom">
                            <div class="speaker-avatar">
                                <img src="{{ asset('frontend/images/speakers/market-analyst.jpg') }}" alt="Rohit Gupta" class="speaker-img">
                                <div class="speaker-badge">Market Analyst</div>
                            </div>
                            <div class="speaker-info">
                                <h4 class="speaker-name">Rohit Gupta</h4>
                                <p class="speaker-title">Senior Market Researcher</p>
                                <p class="speaker-experience">12+ years analyzing market trends and planetary correlations</p>
                            </div>
                        </div>
                        
                        <div class="speaker-card fade_bottom_2">
                            <div class="speaker-avatar">
                                <img src="{{ asset('frontend/images/speakers/options-expert.jpg') }}" alt="Meera Singh" class="speaker-img">
                                <div class="speaker-badge">Options Specialist</div>
                            </div>
                            <div class="speaker-info">
                                <h4 class="speaker-name">Meera Singh</h4>
                                <p class="speaker-title">Options Trading Specialist</p>
                                <p class="speaker-experience">10+ years in derivatives trading with lunar cycle strategies</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Registration Wizard Section -->
    <section id="registration" class="contact__area-3 section-padding-140" style="background: linear-gradient(135deg, #051536 0%, #1a2332 100%);">
        <div class="container">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 offset-xxl-3 offset-xl-3 offset-lg-3">
                    <div class="sec-title-wrapper text-center fade_bottom">
                        <h2 class="sec-title-3 title-anim" style="color: #fff;">Secure Your Spot</h2>
                        <p class="sec-text" style="color: rgba(255,255,255,0.9);">Join the exclusive Astro Trading Masterclass 2025. Only 50 seats available!</p>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-xl-8 col-lg-10">
                    <!-- Wizard Container -->
                    <div class="wizard-container">
                        <!-- Progress Steps -->
                        <div class="wizard-steps">
                            <div class="step active" id="step1">
                                <div class="step-number">1</div>
                                <div class="step-label">Registration</div>
                            </div>
                            <div class="step-line"></div>
                            <div class="step" id="step2">
                                <div class="step-number">2</div>
                                <div class="step-label">Verification</div>
                            </div>
                            <div class="step-line"></div>
                            <div class="step" id="step3">
                                <div class="step-number">3</div>
                                <div class="step-label">Complete</div>
                            </div>
                        </div>
                        
                        <!-- Step 1: Registration Form -->
                        <div class="wizard-step" id="wizardStep1">
                            <div class="registration-form">
                                <h3 class="step-title">Event Registration</h3>
                                <p class="step-subtitle">Please fill in your details to register for the masterclass</p>
                                
                                <form id="registrationForm" method="POST">
                                    @csrf
                                    
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label" for="first_name">First Name *</label>
                                            <input type="text" id="first_name" name="first_name" class="form-input" required>
                                            <div class="error-message" id="first_name_error"></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label" for="last_name">Last Name *</label>
                                            <input type="text" id="last_name" name="last_name" class="form-input" required>
                                            <div class="error-message" id="last_name_error"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email Address *</label>
                                        <input type="email" id="email" name="email" class="form-input" required>
                                        <div class="error-message" id="email_error"></div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label" for="mobile_number">Mobile Number *</label>
                                            <input type="tel" id="mobile_number" name="mobile_number" class="form-input" required pattern="[0-9]{10}" placeholder="10-digit mobile number">
                                            <div class="error-message" id="mobile_number_error"></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label" for="whatsapp_number">WhatsApp Number *</label>
                                            <input type="tel" id="whatsapp_number" name="whatsapp_number" class="form-input" required pattern="[0-9]{10}" placeholder="10-digit WhatsApp number">
                                            <div class="error-message" id="whatsapp_number_error"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label" for="trading_experience">Trading Experience</label>
                                        <select id="trading_experience" name="trading_experience" class="form-input">
                                            <option value="">Select your experience level</option>
                                            <option value="beginner">Beginner (0-1 year)</option>
                                            <option value="intermediate">Intermediate (1-3 years)</option>
                                            <option value="advanced">Advanced (3+ years)</option>
                                            <option value="professional">Professional Trader</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label" for="birth_date">Date of Birth (for personalized chart)</label>
                                        <input type="date" id="birth_date" name="birth_date" class="form-input">
                                        <small style="color: #666; font-size: 13px;">Optional - helps us prepare personalized insights for you</small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label style="display: flex; align-items: center; cursor: pointer;">
                                            <input type="checkbox" id="agree_terms" name="agree_terms" required style="margin-right: 10px;">
                                            I agree to the <a href="#" style="color: #F18603;">Terms & Conditions</a> and <a href="#" style="color: #F18603;">Privacy Policy</a>
                                        </label>
                                        <div class="error-message" id="agree_terms_error"></div>
                                    </div>
                                    
                                    <div class="btn_wrapper text-center">
                                        <button type="submit" class="wc-btn-pink btn-hover btn-item" id="submitButton">
                                            <span></span>Proceed to Verification
                                            <span class="loading-spinner" id="loadingSpinner" style="display: none; margin-left: 10px;">
                                                <i class="fa-solid fa-spinner fa-spin"></i>
                                            </span>
                                        </button>
                                    </div>
                                    
                                    <div style="text-align: center; margin-top: 25px; font-size: 14px; color: #666;">
                                        <p>🔒 Your data is secure and protected</p>
                                        <p style="color: #F18603; font-weight: 600;">⚡ Only 50 seats available!</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Step 2: OTP Verification -->
                        <div class="wizard-step" id="wizardStep2" style="display: none;">
                            <div class="registration-form">
                                <h3 class="step-title">Verify Your WhatsApp</h3>
                                <p class="step-subtitle">Enter the 6-digit OTP sent to your WhatsApp number</p>
                                
                                <div class="verification-info">
                                    <div class="verification-icon">
                                        📱
                                    </div>
                                    <p class="verification-text">We've sent a verification code to:<br><strong id="whatsappDisplay"></strong></p>
                                </div>
                                
                                <div class="otp-inputs">
                                    <input type="text" class="otp-input" maxlength="1" id="otp1">
                                    <input type="text" class="otp-input" maxlength="1" id="otp2">
                                    <input type="text" class="otp-input" maxlength="1" id="otp3">
                                    <input type="text" class="otp-input" maxlength="1" id="otp4">
                                    <input type="text" class="otp-input" maxlength="1" id="otp5">
                                    <input type="text" class="otp-input" maxlength="1" id="otp6">
                                </div>
                                
                                <div class="otp-timer">
                                    Code expires in <span id="otpTimer">5:00</span>
                                </div>
                                
                                <div class="btn_wrapper text-center">
                                    <button type="button" class="wc-btn-pink btn-hover btn-item" id="verifyOtpButton">
                                        <span></span>Verify & Complete Registration
                                    </button>
                                </div>
                                
                                <div class="wizard-actions">
                                    <button type="button" class="back-button" id="backToRegistration">← Back to Registration</button>
                                    <a href="#" class="resend-link" id="resendOtp">Didn't receive OTP? Resend</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 3: Thank You -->
                        <div class="wizard-step" id="wizardStep3" style="display: none;">
                            <div class="registration-form text-center">
                                <div class="success-icon">
                                    🎉
                                </div>
                                <h3 class="step-title" style="color: #28a745;">Registration Complete!</h3>
                                <p class="step-subtitle">Welcome to the Astro Trading Masterclass 2025</p>
                                
                                <div class="confirmation-details">
                                    <div class="confirmation-card">
                                        <h4>Event Details</h4>
                                        <p><strong>Date:</strong> January 15, 2025</p>
                                        <p><strong>Time:</strong> 7:00 PM IST</p>
                                        <p><strong>Duration:</strong> 3 hours</p>
                                        <p><strong>Your Registration ID:</strong> <span id="confirmationRegId"></span></p>
                                    </div>
                                    
                                    <div class="next-steps">
                                        <h4>What's Next?</h4>
                                        <ul>
                                            <li>📱 Check your WhatsApp for event QR code</li>
                                            <li>📧 Confirmation email sent to your inbox</li>
                                            <li>📅 Add event to your calendar</li>
                                            <li>🎁 Bonus materials will be shared before the event</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="btn_wrapper">
                                    <button type="button" class="wc-btn-pink btn-hover btn-item" id="shareEvent">
                                        <span></span>Share with Friends
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('script-bottom')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Wizard elements
    const wizardSteps = document.querySelectorAll('.wizard-step');
    const progressSteps = document.querySelectorAll('.step');
    let currentStep = 1;
    let currentRegistrationId = null;
    
    // Form elements
    const form = document.getElementById('registrationForm');
    const submitButton = document.getElementById('submitButton');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const otpInputs = document.querySelectorAll('.otp-input');
    const verifyButton = document.getElementById('verifyOtpButton');
    const resendButton = document.getElementById('resendOtp');
    const backButton = document.getElementById('backToRegistration');
    
    // Wizard navigation functions
    function showStep(stepNumber) {
        // Hide all steps
        wizardSteps.forEach(step => step.style.display = 'none');
        
        // Show current step
        const currentStepElement = document.getElementById(`wizardStep${stepNumber}`);
        if (currentStepElement) {
            currentStepElement.style.display = 'block';
        }
        
        // Update progress indicators
        updateProgressSteps(stepNumber);
        currentStep = stepNumber;
    }
    
    function updateProgressSteps(activeStep) {
        progressSteps.forEach((step, index) => {
            const stepNumber = index + 1;
            step.classList.remove('active', 'completed');
            
            if (stepNumber < activeStep) {
                step.classList.add('completed');
            } else if (stepNumber === activeStep) {
                step.classList.add('active');
            }
        });
    }
    
    function nextStep() {
        if (currentStep < 3) {
            showStep(currentStep + 1);
        }
    }
    
    function previousStep() {
        if (currentStep > 1) {
            showStep(currentStep - 1);
        }
    }
    
    // Back button handler
    if (backButton) {
        backButton.addEventListener('click', previousStep);
    }
    
    // Form validation functions
    function validateForm() {
        let isValid = true;
        clearAllErrors();
        
        // Validate first name
        const firstName = document.getElementById('first_name');
        if (!firstName.value.trim()) {
            showError('first_name', 'First name is required');
            isValid = false;
        } else if (firstName.value.trim().length < 2) {
            showError('first_name', 'First name must be at least 2 characters');
            isValid = false;
        } else if (!/^[a-zA-Z\s]+$/.test(firstName.value.trim())) {
            showError('first_name', 'First name can only contain letters and spaces');
            isValid = false;
        }
        
        // Validate last name
        const lastName = document.getElementById('last_name');
        if (!lastName.value.trim()) {
            showError('last_name', 'Last name is required');
            isValid = false;
        } else if (lastName.value.trim().length < 2) {
            showError('last_name', 'Last name must be at least 2 characters');
            isValid = false;
        } else if (!/^[a-zA-Z\s]+$/.test(lastName.value.trim())) {
            showError('last_name', 'Last name can only contain letters and spaces');
            isValid = false;
        }
        
        // Validate email
        const email = document.getElementById('email');
        if (!email.value.trim()) {
            showError('email', 'Email address is required');
            isValid = false;
        } else if (!isValidEmail(email.value.trim())) {
            showError('email', 'Please enter a valid email address (e.g., user@example.com)');
            isValid = false;
        }
        
        // Validate mobile number
        const mobileNumber = document.getElementById('mobile_number');
        if (!mobileNumber.value.trim()) {
            showError('mobile_number', 'Mobile number is required');
            isValid = false;
        } else if (!isValidPhone(mobileNumber.value.trim())) {
            showError('mobile_number', 'Please enter a valid 10-digit mobile number');
            isValid = false;
        }
        
        // Validate WhatsApp number
        const whatsappNumber = document.getElementById('whatsapp_number');
        if (!whatsappNumber.value.trim()) {
            showError('whatsapp_number', 'WhatsApp number is required');
            isValid = false;
        } else if (!isValidPhone(whatsappNumber.value.trim())) {
            showError('whatsapp_number', 'Please enter a valid 10-digit WhatsApp number');
            isValid = false;
        }
        
        // Validate terms agreement
        const agreeTerms = document.getElementById('agree_terms');
        if (!agreeTerms.checked) {
            showError('agree_terms', 'You must agree to the terms and conditions to proceed');
            isValid = false;
        }
        
        // Validate birth date if provided
        const birthDate = document.getElementById('birth_date');
        if (birthDate.value) {
            const selectedDate = new Date(birthDate.value);
            const today = new Date();
            const minDate = new Date(today.getFullYear() - 100, today.getMonth(), today.getDate());
            const maxDate = new Date(today.getFullYear() - 10, today.getMonth(), today.getDate());
            
            if (selectedDate > maxDate) {
                showError('birth_date', 'You must be at least 10 years old');
                isValid = false;
            } else if (selectedDate < minDate) {
                showError('birth_date', 'Please enter a valid birth date');
                isValid = false;
            }
        }
        
        return isValid;
    }
    
    function showError(fieldName, message) {
        const input = document.getElementById(fieldName);
        const errorElement = document.getElementById(fieldName + '_error');
        
        if (input && errorElement) {
            input.classList.add('error');
            errorElement.textContent = message;
            errorElement.style.display = 'block';
            errorElement.style.opacity = '1';
            
            // Scroll to first error if not visible
            if (!isElementInViewport(input)) {
                input.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    }
    
    function clearError(fieldName) {
        const input = document.getElementById(fieldName);
        const errorElement = document.getElementById(fieldName + '_error');
        
        if (input && errorElement) {
            input.classList.remove('error');
            errorElement.style.display = 'none';
            errorElement.style.opacity = '0';
        }
    }
    
    function clearAllErrors() {
        const errorElements = document.querySelectorAll('.error-message');
        const inputElements = document.querySelectorAll('.form-input');
        
        errorElements.forEach(el => {
            el.style.display = 'none';
            el.style.opacity = '0';
        });
        inputElements.forEach(el => el.classList.remove('error'));
    }
    
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    
    function isValidEmail(email) {
        // More comprehensive email validation
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email) && email.length <= 254;
    }
    
    function isValidPhone(phone) {
        // Remove all non-digits and check if exactly 10 digits
        const cleanPhone = phone.replace(/\D/g, '');
        return cleanPhone.length === 10 && /^[6-9][0-9]{9}$/.test(cleanPhone);
    }
    
    // Real-time validation
    function setupRealTimeValidation() {
        const fields = [
            { id: 'first_name', validator: validateName },
            { id: 'last_name', validator: validateName },
            { id: 'email', validator: validateEmailField },
            { id: 'mobile_number', validator: validatePhoneField },
            { id: 'whatsapp_number', validator: validatePhoneField },
            { id: 'birth_date', validator: validateBirthDate }
        ];
        
        fields.forEach(field => {
            const element = document.getElementById(field.id);
            if (element) {
                element.addEventListener('blur', function() {
                    field.validator(this);
                });
                
                element.addEventListener('input', function() {
                    // Clear error when user starts typing
                    if (this.classList.contains('error')) {
                        clearError(field.id);
                    }
                });
            }
        });
    }
    
    function validateName(input) {
        const value = input.value.trim();
        const fieldName = input.name.replace('_', ' ');
        
        if (!value) {
            showError(input.id, `${fieldName} is required`);
            return false;
        } else if (value.length < 2) {
            showError(input.id, `${fieldName} must be at least 2 characters`);
            return false;
        } else if (!/^[a-zA-Z\s]+$/.test(value)) {
            showError(input.id, `${fieldName} can only contain letters and spaces`);
            return false;
        }
        return true;
    }
    
    function validateEmailField(input) {
        const value = input.value.trim();
        
        if (!value) {
            showError('email', 'Email address is required');
            return false;
        } else if (!isValidEmail(value)) {
            showError('email', 'Please enter a valid email address (e.g., user@example.com)');
            return false;
        }
        return true;
    }
    
    function validatePhoneField(input) {
        const value = input.value.trim();
        const fieldLabel = input.id === 'mobile_number' ? 'Mobile number' : 'WhatsApp number';
        
        if (!value) {
            showError(input.id, `${fieldLabel} is required`);
            return false;
        } else if (!isValidPhone(value)) {
            showError(input.id, `Please enter a valid 10-digit ${fieldLabel.toLowerCase()} starting with 6-9`);
            return false;
        }
        return true;
    }
    
    function validateBirthDate(input) {
        const value = input.value;
        
        if (value) {
            const selectedDate = new Date(value);
            const today = new Date();
            const minDate = new Date(today.getFullYear() - 100, today.getMonth(), today.getDate());
            const maxDate = new Date(today.getFullYear() - 10, today.getMonth(), today.getDate());
            
            if (selectedDate > maxDate) {
                showError('birth_date', 'You must be at least 10 years old');
                return false;
            } else if (selectedDate < minDate) {
                showError('birth_date', 'Please enter a valid birth date');
                return false;
            }
        }
        return true;
    }
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateForm()) {
            return;
        }
        
        submitButton.disabled = true;
        loadingSpinner.style.display = 'inline-block';
        
        const formData = new FormData(form);
        
        fetch('{{ route("event.register") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') || '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            submitButton.disabled = false;
            loadingSpinner.style.display = 'none';
            
            if (data.success) {
                currentRegistrationId = data.registration_id;
                
                // Show WhatsApp number in verification step
                const whatsappDisplay = document.getElementById('whatsappDisplay');
                if (whatsappDisplay) {
                    const whatsappNumber = document.getElementById('whatsapp_number').value;
                    whatsappDisplay.textContent = '+91 ' + whatsappNumber;
                }
                
                // Move to verification step
                nextStep();
                startOtpTimer();
                
                // Focus on first OTP input
                if (otpInputs[0]) {
                    otpInputs[0].focus();
                }
                
            } else {
                if (data.errors) {
                    // Handle server-side validation errors
                    let firstErrorField = null;
                    
                    Object.keys(data.errors).forEach(field => {
                        if (data.errors[field] && data.errors[field].length > 0) {
                            showError(field, data.errors[field][0]);
                            
                            // Remember first error field for focusing
                            if (!firstErrorField) {
                                firstErrorField = field;
                            }
                        }
                    });
                    
                    // Focus on first error field
                    if (firstErrorField) {
                        const firstErrorElement = document.getElementById(firstErrorField);
                        if (firstErrorElement) {
                            firstErrorElement.focus();
                        }
                    }
                } else {
                    // Show general error message
                    const generalError = document.createElement('div');
                    generalError.className = 'alert alert-danger';
                    generalError.style.marginBottom = '20px';
                    generalError.style.padding = '15px';
                    generalError.style.borderRadius = '8px';
                    generalError.style.backgroundColor = '#f8d7da';
                    generalError.style.color = '#721c24';
                    generalError.style.border = '1px solid #f5c6cb';
                    generalError.textContent = data.message || 'Registration failed. Please check your details and try again.';
                    
                    form.insertBefore(generalError, form.firstChild);
                    
                    // Remove after 5 seconds
                    setTimeout(() => {
                        if (generalError.parentNode) {
                            generalError.remove();
                        }
                    }, 5000);
                }
            }
        })
        .catch(error => {
            submitButton.disabled = false;
            loadingSpinner.style.display = 'none';
            
            console.error('Registration error:', error);
            
            // Show connection error in first form field
            const firstInput = form.querySelector('.form-input');
            if (firstInput) {
                showError(firstInput.id, 'Connection error. Please check your internet and try again.');
            }
        });
    });
    
    // OTP input handling
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            
            if (this.value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        });
        
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !this.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });
        
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pasteData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 6);
            
            for (let i = 0; i < pasteData.length && (index + i) < otpInputs.length; i++) {
                otpInputs[index + i].value = pasteData[i];
            }
            
            if (pasteData.length === 6) {
                otpInputs[5].focus();
            }
        });
    });
    
    // Verify OTP
    verifyButton.addEventListener('click', function() {
        const otp = Array.from(otpInputs).map(input => input.value).join('');
        
        if (otp.length !== 6) {
            // Highlight incomplete OTP inputs
            otpInputs.forEach((input, index) => {
                if (!input.value) {
                    input.classList.add('error');
                    input.style.borderColor = '#dc3545';
                } else {
                    input.classList.remove('error');
                    input.style.borderColor = '#F18603';
                }
            });
            
            // Show error message below OTP inputs
            showOtpError('Please enter the complete 6-digit OTP');
            otpInputs[0].focus();
            return;
        }
        
        if (!currentRegistrationId) {
            showOtpError('Session expired. Please register again.');
            setTimeout(() => {
                previousStep();
            }, 2000);
            return;
        }
        
        verifyButton.disabled = true;
        const originalText = verifyButton.innerHTML;
        verifyButton.innerHTML = '<span></span>Verifying... <i class="fa-solid fa-spinner fa-spin"></i>';
        
        fetch('{{ route("event.verify.otp") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') || '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                registration_id: currentRegistrationId,
                otp: otp
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update confirmation details
                const confirmationRegId = document.getElementById('confirmationRegId');
                if (confirmationRegId) {
                    confirmationRegId.textContent = currentRegistrationId;
                }
                
                // Move to thank you step
                nextStep();
                
                // Clear OTP inputs
                otpInputs.forEach(input => input.value = '');
                
            } else {
                showOtpError(data.message || 'Invalid OTP. Please try again.');
                
                // Highlight all OTP inputs as error
                otpInputs.forEach(input => {
                    input.classList.add('error');
                    input.style.borderColor = '#dc3545';
                    input.value = '';
                });
                
                if (otpInputs[0]) {
                    otpInputs[0].focus();
                }
                
                verifyButton.disabled = false;
                verifyButton.innerHTML = originalText;
            }
        })
        .catch(error => {
            console.error('OTP verification error:', error);
            showOtpError('Verification failed. Please check your connection and try again.');
            
            verifyButton.disabled = false;
            verifyButton.innerHTML = originalText;
        });
    });
    
    // Resend OTP
    resendButton.addEventListener('click', function(e) {
        e.preventDefault();
        
        if (!currentRegistrationId) {
            alert('Registration ID not found. Please register again.');
            return;
        }
        
        this.style.pointerEvents = 'none';
        this.textContent = 'Sending...';
        
        fetch('{{ route("event.resend.otp") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') || '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                registration_id: currentRegistrationId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✅ New OTP sent to your WhatsApp number!');
                startOtpTimer();
                
                // Clear OTP inputs and focus first one
                otpInputs.forEach(input => input.value = '');
                if (otpInputs[0]) {
                    otpInputs[0].focus();
                }
            } else {
                showOtpError(data.message || 'Failed to resend OTP. Please try again.');
            }
        })
        .catch(error => {
            console.error('Resend OTP error:', error);
            showOtpError('Failed to resend OTP. Please check your connection.');
        })
        .finally(() => {
            this.style.pointerEvents = 'auto';
            this.textContent = 'Didn\'t receive OTP? Resend';
        });
    });
    
    // OTP Timer
    function startOtpTimer() {
        let timeLeft = 300; // 5 minutes
        const timerElement = document.getElementById('otpTimer');
        
        const timer = setInterval(() => {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft <= 0) {
                clearInterval(timer);
                timerElement.textContent = 'Expired';
                timerElement.style.color = '#dc3545';
            }
            
            timeLeft--;
        }, 1000);
    }
    
    // OTP validation helper functions
    function showOtpError(message) {
        let otpErrorDiv = document.getElementById('otpErrorMessage');
        if (!otpErrorDiv) {
            otpErrorDiv = document.createElement('div');
            otpErrorDiv.id = 'otpErrorMessage';
            otpErrorDiv.className = 'otp-error-message';
            
            const otpContainer = document.querySelector('.otp-inputs');
            if (otpContainer && otpContainer.parentNode) {
                otpContainer.parentNode.insertBefore(otpErrorDiv, otpContainer.nextSibling);
            }
        }
        
        otpErrorDiv.textContent = message;
        otpErrorDiv.style.display = 'block';
        otpErrorDiv.style.opacity = '1';
    }
    
    function showOtpSuccess(message) {
        let otpSuccessDiv = document.getElementById('otpSuccessMessage');
        if (!otpSuccessDiv) {
            otpSuccessDiv = document.createElement('div');
            otpSuccessDiv.id = 'otpSuccessMessage';
            otpSuccessDiv.className = 'otp-success-message';
            
            const otpContainer = document.querySelector('.otp-inputs');
            if (otpContainer && otpContainer.parentNode) {
                otpContainer.parentNode.insertBefore(otpSuccessDiv, otpContainer.nextSibling);
            }
        }
        
        otpSuccessDiv.textContent = message;
        otpSuccessDiv.style.display = 'block';
        otpSuccessDiv.style.opacity = '1';
        
        // Hide after 3 seconds
        setTimeout(() => {
            otpSuccessDiv.style.opacity = '0';
            setTimeout(() => {
                otpSuccessDiv.style.display = 'none';
            }, 300);
        }, 3000);
    }
    
    function clearOtpMessages() {
        const otpError = document.getElementById('otpErrorMessage');
        const otpSuccess = document.getElementById('otpSuccessMessage');
        
        if (otpError) {
            otpError.style.display = 'none';
        }
        if (otpSuccess) {
            otpSuccess.style.display = 'none';
        }
    }
    
    function showConfirmationMessage(message, type = 'info') {
        let messageDiv = document.getElementById('confirmationMessage');
        if (!messageDiv) {
            messageDiv = document.createElement('div');
            messageDiv.id = 'confirmationMessage';
            messageDiv.className = `confirmation-message ${type}`;
            
            const confirmationDetails = document.querySelector('.confirmation-details');
            if (confirmationDetails) {
                confirmationDetails.appendChild(messageDiv);
            }
        }
        
        messageDiv.textContent = message;
        messageDiv.className = `confirmation-message ${type}`;
        messageDiv.style.display = 'block';
        
        // Hide after 4 seconds
        setTimeout(() => {
            messageDiv.style.display = 'none';
        }, 4000);
    }
    
    // Clear OTP messages when user starts typing
    otpInputs.forEach(input => {
        input.addEventListener('input', function() {
            clearOtpMessages();
            
            // Reset input styling
            otpInputs.forEach(inp => {
                inp.classList.remove('error');
                inp.style.borderColor = '#e1e5e9';
            });
        });
    });
    
    // Share event functionality
    const shareButton = document.getElementById('shareEvent');
    if (shareButton) {
        shareButton.addEventListener('click', function() {
            const shareText = 'Join me at the Astro Trading Masterclass 2025! Learn financial astrology secrets. FREE registration: ' + window.location.href;
            
            if (navigator.share) {
                navigator.share({
                    title: 'Astro Trading Masterclass 2025',
                    text: shareText,
                    url: window.location.href
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(shareText).then(() => {
                    showConfirmationMessage('Event link copied to clipboard!', 'success');
                }).catch(() => {
                    showConfirmationMessage('Share link: ' + window.location.href, 'info');
                });
            }
        });
    }
    
    // Auto-fill WhatsApp number with mobile number
    document.getElementById('mobile_number').addEventListener('input', function() {
        const whatsappField = document.getElementById('whatsapp_number');
        if (!whatsappField.value || whatsappField.value === this.dataset.previousValue) {
            whatsappField.value = this.value;
            whatsappField.dataset.autoFilled = 'true';
        }
        this.dataset.previousValue = this.value;
    });
    
    // Prevent auto-fill if user manually changes WhatsApp number
    document.getElementById('whatsapp_number').addEventListener('input', function() {
        if (this.dataset.autoFilled === 'true') {
            delete this.dataset.autoFilled;
        }
    });
    
    // Initialize real-time validation
    setupRealTimeValidation();
    
    // Add input formatters for phone numbers
    ['mobile_number', 'whatsapp_number'].forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener('input', function(e) {
                // Only allow digits
                this.value = this.value.replace(/\D/g, '');
                
                // Limit to 10 digits
                if (this.value.length > 10) {
                    this.value = this.value.slice(0, 10);
                }
            });
        }
    });
    
    // Smooth scroll to registration
    document.querySelectorAll('a[href="#registration"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('registration').scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Add CSRF token meta tag if not exists
    if (!document.querySelector('meta[name="csrf-token"]')) {
        const meta = document.createElement('meta');
        meta.name = 'csrf-token';
        meta.content = '{{ csrf_token() }}';
        document.getElementsByTagName('head')[0].appendChild(meta);
    }
});
</script>
@endsection

@section('css')
<style>
/* Speakers Section Styling */
.speakers__area {
    background: #fff;
}

.speakers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.speaker-card {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
}

.speaker-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.speaker-avatar {
    position: relative;
    margin-bottom: 25px;
}

.speaker-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #F18603;
    margin: 0 auto;
    display: block;
}

.speaker-badge {
    position: absolute;
    bottom: 10px;
    right: 50%;
    transform: translateX(50%);
    background: #F18603;
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.speaker-name {
    color: #051536;
    margin-bottom: 8px;
    font-size: 22px;
    font-weight: 700;
}

.speaker-title {
    color: #F18603;
    margin-bottom: 12px;
    font-size: 16px;
    font-weight: 600;
}

.speaker-experience {
    color: #666;
    font-size: 14px;
    line-height: 1.5;
}

/* Section Spacing */
section {
    margin-bottom: 80px;
}

section:last-child {
    margin-bottom: 0;
}

.section-padding-140 {
    padding: 140px 0;
}

@media (max-width: 768px) {
    section {
        margin-bottom: 60px;
    }
    
    .section-padding-140 {
        padding: 80px 0;
    }
}

@media (max-width: 480px) {
    section {
        margin-bottom: 40px;
    }
    
    .section-padding-140 {
        padding: 60px 0;
    }
}

/* Wizard Styling */
.wizard-container {
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    margin-top: 40px;
}

.wizard-steps {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    position: relative;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
}

.step-number {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #e1e5e9;
    color: #666;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 18px;
    margin-bottom: 10px;
    transition: all 0.3s ease;
}

.step.active .step-number {
    background: #F18603;
    color: white;
    transform: scale(1.1);
}

.step.completed .step-number {
    background: #28a745;
    color: white;
}

.step-label {
    color: #666;
    font-size: 14px;
    font-weight: 600;
    transition: color 0.3s ease;
}

.step.active .step-label {
    color: #F18603;
}

.step.completed .step-label {
    color: #28a745;
}

.step-line {
    flex: 1;
    height: 2px;
    background: #e1e5e9;
    margin: 0 20px;
    position: relative;
    top: -35px;
}

.step.completed ~ .step-line {
    background: #28a745;
}

.wizard-step {
    min-height: 400px;
}

.step-title {
    text-align: center;
    color: #051536;
    margin-bottom: 10px;
    font-size: 28px;
    font-weight: 700;
}

.step-subtitle {
    text-align: center;
    color: #666;
    margin-bottom: 30px;
    font-size: 16px;
}

.verification-info {
    text-align: center;
    margin-bottom: 30px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
}

.verification-icon {
    font-size: 48px;
    margin-bottom: 15px;
}

.verification-text {
    color: #051536;
    font-size: 16px;
    margin: 0;
}

.wizard-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
    flex-wrap: wrap;
    gap: 15px;
}

.back-button {
    background: none;
    border: 2px solid #e1e5e9;
    color: #666;
    padding: 12px 24px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.back-button:hover {
    border-color: #F18603;
    color: #F18603;
}

.success-icon {
    font-size: 80px;
    margin-bottom: 20px;
}

.confirmation-details {
    margin: 30px 0;
}

.confirmation-card {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 25px;
}

.confirmation-card h4 {
    color: #051536;
    margin-bottom: 15px;
    font-size: 18px;
}

.confirmation-card p {
    margin: 8px 0;
    color: #666;
    font-size: 14px;
}

.next-steps {
    background: rgba(241, 134, 3, 0.1);
    padding: 25px;
    border-radius: 12px;
    text-align: left;
}

.next-steps h4 {
    color: #051536;
    margin-bottom: 15px;
    text-align: center;
}

.next-steps ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.next-steps li {
    padding: 8px 0;
    color: #051536;
    font-size: 14px;
    border-bottom: 1px solid rgba(241, 134, 3, 0.2);
}

.next-steps li:last-child {
    border-bottom: none;
}

/* Registration Form Styling */
.registration-form {
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    margin-top: 40px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    color: #051536;
    font-weight: 600;
    font-size: 14px;
}

.form-input {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e1e5e9;
    border-radius: 12px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: #fff;
}

.form-input:focus {
    outline: none;
    border-color: #F18603;
    box-shadow: 0 0 0 3px rgba(241, 134, 3, 0.1);
}

.form-input.error {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
}

.error-message {
    color: #dc3545;
    font-size: 13px;
    margin-top: 8px;
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease;
    background: #f8d7da;
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid #f5c6cb;
    font-weight: 500;
}

.error-message:before {
    content: '⚠️ ';
    margin-right: 5px;
}

.success-message {
    background: #d4edda;
    color: #155724;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 25px;
    display: none;
    text-align: center;
    border: 1px solid #c3e6cb;
}

/* OTP Input Styling */

.otp-inputs {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 30px;
}

.otp-input {
    width: 50px;
    height: 60px;
    border: 2px solid #e1e5e9;
    border-radius: 12px;
    text-align: center;
    font-size: 24px;
    font-weight: 600;
    color: #051536;
    transition: all 0.3s ease;
}

.otp-input:focus {
    outline: none;
    border-color: #F18603;
    box-shadow: 0 0 0 3px rgba(241, 134, 3, 0.2);
    transform: scale(1.05);
}

.resend-link {
    color: #F18603;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
}

.resend-link:hover {
    color: #d67003;
    text-decoration: underline;
}

.otp-timer {
    margin: 20px 0;
    color: #666;
    font-size: 14px;
    text-align: center;
}

.otp-error-message {
    color: #dc3545;
    font-size: 13px;
    margin-top: 15px;
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease;
    background: #f8d7da;
    padding: 10px 15px;
    border-radius: 8px;
    border: 1px solid #f5c6cb;
    font-weight: 500;
    text-align: center;
}

.otp-error-message:before {
    content: '⚠️ ';
    margin-right: 5px;
}

.otp-success-message {
    color: #155724;
    font-size: 13px;
    margin-top: 15px;
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease;
    background: #d4edda;
    padding: 10px 15px;
    border-radius: 8px;
    border: 1px solid #c3e6cb;
    font-weight: 500;
    text-align: center;
}

.otp-success-message:before {
    content: '✅ ';
    margin-right: 5px;
}

.confirmation-message {
    margin: 15px 0;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 14px;
    text-align: center;
    display: none;
}

.confirmation-message.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.confirmation-message.info {
    background: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .wizard-container,
    .registration-form {
        padding: 25px;
        margin: 20px 10px;
    }
    
    .speakers-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    
    .wizard-steps {
        flex-direction: column;
        gap: 20px;
    }
    
    .step-line {
        width: 2px;
        height: 30px;
        margin: 10px 0;
        top: 0;
    }
    
    .wizard-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .otp-inputs {
        gap: 10px;
    }
    
    .otp-input {
        width: 45px;
        height: 55px;
        font-size: 20px;
    }
}

@media (max-width: 480px) {
    .event-details {
        grid-template-columns: 1fr !important;
        text-align: center !important;
    }
    
    .wizard-container {
        padding: 20px 15px;
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
    
    .step-label {
        font-size: 12px;
    }
    
    .otp-inputs {
        gap: 8px;
    }
    
    .otp-input {
        width: 40px;
        height: 50px;
        font-size: 18px;
    }
    
    .speakers-grid {
        gap: 15px;
    }
    
    .speaker-card {
        padding: 20px;
    }
    
    .speaker-img {
        width: 100px;
        height: 100px;
    }
}
</style>
@endsection