@extends('frontend.layouts.master')

@section('title')
    Event Feedback - Astro Trading Masterclass 2025
@endsection

@section('css')
<style>
:root {
    --primary-dark: #051536;
    --accent-orange: #F18603;
    --white: #ffffff;
    --light-gray: #f8f9ff;
    --text-gray: #666;
    --star-color: #ffa726;
}

.feedback-hero {
    background: linear-gradient(135deg, var(--primary-dark) 0%, #0a2a5c 100%);
    color: var(--white);
    padding: 80px 0;
    text-align: center;
}

.feedback-form-section {
    padding: 80px 0;
    background: var(--white);
}

.feedback-container {
    max-width: 800px;
    margin: 0 auto;
}

.feedback-form {
    background: var(--light-gray);
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(5, 21, 54, 0.1);
}

.rating-section {
    text-align: center;
    margin-bottom: 40px;
}

.star-rating {
    display: flex;
    justify-content: center;
    gap: 5px;
    margin: 20px 0;
}

.star {
    font-size: 32px;
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s ease;
}

.star:hover,
.star.active {
    color: var(--star-color);
}

.rating-text {
    margin-top: 15px;
    font-size: 16px;
    font-weight: 600;
    color: var(--primary-dark);
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: block;
    font-weight: 600;
    color: var(--primary-dark);
    margin-bottom: 10px;
    font-size: 16px;
}

.form-input,
.form-textarea {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid var(--border-light);
    border-radius: 10px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: var(--white);
    font-family: inherit;
}

.form-textarea {
    min-height: 120px;
    resize: vertical;
}

.form-input:focus,
.form-textarea:focus {
    outline: none;
    border-color: var(--accent-orange);
    box-shadow: 0 0 0 3px rgba(241, 134, 3, 0.1);
}

.checkbox-group {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 15px;
}

.checkbox-item {
    display: flex;
    align-items: center;
    padding: 10px;
    background: var(--white);
    border-radius: 10px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    cursor: pointer;
}

.checkbox-item:hover {
    border-color: var(--accent-orange);
    background: rgba(241, 134, 3, 0.05);
}

.checkbox-item input[type="checkbox"] {
    margin-right: 10px;
    transform: scale(1.2);
}

.feedback-submit {
    background: var(--accent-orange);
    color: var(--white);
    padding: 18px 40px;
    border: none;
    border-radius: 30px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    margin-top: 20px;
}

.feedback-submit:hover {
    background: #e67503;
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(241, 134, 3, 0.3);
}

.thank-you-section {
    display: none;
    text-align: center;
    padding: 60px 0;
}

.thank-you-icon {
    font-size: 80px;
    color: var(--star-color);
    margin-bottom: 30px;
}

.next-events {
    background: var(--light-gray);
    padding: 60px 0;
}

.event-card {
    background: var(--white);
    padding: 30px;
    border-radius: 15px;
    margin-bottom: 20px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 40px rgba(5, 21, 54, 0.1);
}

.event-date {
    color: var(--accent-orange);
    font-weight: 600;
    font-size: 14px;
}

.event-title {
    color: var(--primary-dark);
    font-size: 20px;
    font-weight: 600;
    margin: 10px 0;
}

.early-bird-badge {
    background: var(--accent-orange);
    color: var(--white);
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
    margin-top: 10px;
}

@media (max-width: 768px) {
    .feedback-form {
        padding: 30px 20px;
    }
    
    .star-rating {
        gap: 3px;
    }
    
    .star {
        font-size: 28px;
    }
    
    .checkbox-group {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection

@section('content')
<main>
    <!-- Feedback Hero -->
    <section class="feedback-hero">
        <div class="container">
            <h1 style="font-size: 42px; font-weight: 700; margin-bottom: 20px;">
                Thank You for Attending! 🙏
            </h1>
            <p style="font-size: 20px; opacity: 0.9; max-width: 600px; margin: 0 auto;">
                Help us improve and serve you better by sharing your valuable feedback about the Astro Trading Masterclass.
            </p>
        </div>
    </section>

    <!-- Feedback Form -->
    <section class="feedback-form-section">
        <div class="container">
            <div class="feedback-container">
                
                <div class="feedback-form" id="feedbackForm">
                    <h2 style="text-align: center; color: var(--primary-dark); margin-bottom: 30px;">
                        Share Your Experience
                    </h2>
                    
                    <!-- Overall Rating -->
                    <div class="rating-section">
                        <h3 style="color: var(--primary-dark); margin-bottom: 15px;">
                            How would you rate the overall event?
                        </h3>
                        
                        <div class="star-rating" id="overallRating">
                            <span class="star" data-rating="1">⭐</span>
                            <span class="star" data-rating="2">⭐</span>
                            <span class="star" data-rating="3">⭐</span>
                            <span class="star" data-rating="4">⭐</span>
                            <span class="star" data-rating="5">⭐</span>
                        </div>
                        
                        <div class="rating-text" id="ratingText">Click stars to rate</div>
                    </div>

                    <form id="feedbackFormElement" method="POST" action="{{ route('event.feedback.submit') }}">
                        @csrf
                        <input type="hidden" name="registration_id" value="{{ request('reg') }}">
                        <input type="hidden" name="overall_rating" id="overallRatingValue">
                        
                        <!-- What did you like most? -->
                        <div class="form-group">
                            <label class="form-label">What did you like most about the event?</label>
                            <div class="checkbox-group">
                                <label class="checkbox-item">
                                    <input type="checkbox" name="liked_aspects[]" value="content_quality">
                                    Content Quality
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="liked_aspects[]" value="speaker_expertise">
                                    Speaker Expertise
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="liked_aspects[]" value="practical_examples">
                                    Practical Examples
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="liked_aspects[]" value="interactive_sessions">
                                    Interactive Sessions
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="liked_aspects[]" value="networking_opportunity">
                                    Networking
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="liked_aspects[]" value="bonus_materials">
                                    Bonus Materials
                                </label>
                            </div>
                        </div>
                        
                        <!-- Specific Feedback -->
                        <div class="form-group">
                            <label class="form-label" for="what_learned">What was the most valuable thing you learned?</label>
                            <textarea id="what_learned" name="what_learned" class="form-textarea" placeholder="Share your key takeaway from the masterclass..."></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="improvements">What could we improve for future events?</label>
                            <textarea id="improvements" name="improvements" class="form-textarea" placeholder="Your suggestions help us make future events even better..."></textarea>
                        </div>
                        
                        <!-- Would you recommend? -->
                        <div class="form-group">
                            <label class="form-label">Would you recommend this event to friends?</label>
                            <div style="display: flex; gap: 20px; margin-top: 15px;">
                                <label style="display: flex; align-items: center; cursor: pointer;">
                                    <input type="radio" name="would_recommend" value="definitely" style="margin-right: 8px;">
                                    Definitely! 🌟
                                </label>
                                <label style="display: flex; align-items: center; cursor: pointer;">
                                    <input type="radio" name="would_recommend" value="probably" style="margin-right: 8px;">
                                    Probably 👍
                                </label>
                                <label style="display: flex; align-items: center; cursor: pointer;">
                                    <input type="radio" name="would_recommend" value="maybe" style="margin-right: 8px;">
                                    Maybe 🤔
                                </label>
                                <label style="display: flex; align-items: center; cursor: pointer;">
                                    <input type="radio" name="would_recommend" value="no" style="margin-right: 8px;">
                                    Not really 😕
                                </label>
                            </div>
                        </div>
                        
                        <!-- Future Events Interest -->
                        <div class="form-group">
                            <label class="form-label">Which future events interest you?</label>
                            <div class="checkbox-group">
                                <label class="checkbox-item">
                                    <input type="checkbox" name="future_interests[]" value="advanced_astro_trading">
                                    Advanced Astro Trading
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="future_interests[]" value="personal_chart_workshop">
                                    Personal Chart Workshop
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="future_interests[]" value="crypto_astro_trading">
                                    Crypto Astro Trading
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="future_interests[]" value="monthly_predictions">
                                    Monthly Prediction Sessions
                                </label>
                            </div>
                        </div>
                        
                        <!-- Additional Comments -->
                        <div class="form-group">
                            <label class="form-label" for="additional_comments">Any additional comments?</label>
                            <textarea id="additional_comments" name="additional_comments" class="form-textarea" placeholder="Anything else you'd like to share..."></textarea>
                        </div>
                        
                        <!-- Newsletter Subscription -->
                        <div class="form-group">
                            <label style="display: flex; align-items: center; cursor: pointer;">
                                <input type="checkbox" name="subscribe_newsletter" value="1" style="margin-right: 10px;" checked>
                                Yes, send me updates about future events and trading insights
                            </label>
                        </div>
                        
                        <button type="submit" class="feedback-submit" id="submitFeedback">
                            Submit Feedback & Get Bonus Materials 🎁
                        </button>
                    </form>
                </div>
                
                <!-- Thank You Section (hidden initially) -->
                <div class="thank-you-section" id="thankYouSection">
                    <div class="thank-you-icon">🙏</div>
                    <h2 style="color: var(--primary-dark); margin-bottom: 20px;">
                        Thank You for Your Valuable Feedback!
                    </h2>
                    <p style="color: var(--text-gray); font-size: 18px; margin-bottom: 30px;">
                        Your insights help us create even better experiences for future participants.
                    </p>
                    
                    <div style="background: var(--light-gray); padding: 30px; border-radius: 15px; margin-bottom: 30px;">
                        <h3 style="color: var(--accent-orange); margin-bottom: 15px;">🎁 Your Bonus Materials</h3>
                        <p>Check your email for:</p>
                        <ul style="text-align: left; max-width: 400px; margin: 15px auto; color: var(--text-gray);">
                            <li>📹 Complete event recording</li>
                            <li>📊 Advanced astro trading charts</li>
                            <li>📱 Premium app access (1 month free)</li>
                            <li>📚 Exclusive e-book: "30 Days to Astro Trading Mastery"</li>
                        </ul>
                    </div>
                    
                    <a href="{{ route('home') }}" style="background: var(--accent-orange); color: white; padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: 600;">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Next Events -->
    <section class="next-events">
        <div class="container">
            <h2 class="section-title">Don't Miss Our Upcoming Events</h2>
            <p class="section-subtitle">
                Continue your astro trading journey with these exclusive upcoming workshops and masterclasses.
            </p>
            
            <div style="max-width: 800px; margin: 50px auto 0;">
                <div class="event-card">
                    <div class="event-date">October 20, 2025</div>
                    <h3 class="event-title">Advanced Nakshatra Trading Strategies</h3>
                    <p>Deep dive into sector-specific predictions using advanced Nakshatra techniques.</p>
                    <span class="early-bird-badge">Early Bird: ₹1,999</span>
                </div>
                
                <div class="event-card">
                    <div class="event-date">November 15, 2025</div>
                    <h3 class="event-title">Personal Chart Analysis Workshop</h3>
                    <p>Get your complete birth chart analyzed for personalized trading insights.</p>
                    <span class="early-bird-badge">Limited to 25 participants</span>
                </div>
                
                <div class="event-card">
                    <div class="event-date">December 10, 2025</div>
                    <h3 class="event-title">Crypto Astro Trading Masterclass</h3>
                    <p>Learn how planetary movements affect cryptocurrency markets and altcoin cycles.</p>
                    <span class="early-bird-badge">Pre-launch: ₹2,499</span>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('home') }}" style="background: var(--primary-dark); color: white; padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: 600;">
                    🔔 Get Notified About New Events
                </a>
            </div>
        </div>
    </section>
</main>
@endsection

@section('script-bottom')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star');
    const ratingText = document.getElementById('ratingText');
    const ratingValue = document.getElementById('overallRatingValue');
    const form = document.getElementById('feedbackFormElement');
    const feedbackForm = document.getElementById('feedbackForm');
    const thankYouSection = document.getElementById('thankYouSection');
    
    let selectedRating = 0;
    
    const ratingTexts = {
        1: 'Poor - Needs significant improvement',
        2: 'Fair - Below expectations', 
        3: 'Good - Met expectations',
        4: 'Very Good - Exceeded expectations',
        5: 'Excellent - Outstanding experience!'
    };
    
    // Star rating functionality
    stars.forEach(star => {
        star.addEventListener('click', function() {
            selectedRating = parseInt(this.dataset.rating);
            ratingValue.value = selectedRating;
            
            // Update star display
            stars.forEach((s, index) => {
                if (index < selectedRating) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });
            
            // Update rating text
            ratingText.textContent = ratingTexts[selectedRating];
            ratingText.style.color = selectedRating >= 4 ? 'var(--accent-orange)' : 'var(--text-gray)';
        });
        
        star.addEventListener('mouseenter', function() {
            const hoverRating = parseInt(this.dataset.rating);
            stars.forEach((s, index) => {
                if (index < hoverRating) {
                    s.style.color = 'var(--star-color)';
                } else {
                    s.style.color = '#ddd';
                }
            });
        });
        
        star.addEventListener('mouseleave', function() {
            stars.forEach((s, index) => {
                if (index < selectedRating) {
                    s.style.color = 'var(--star-color)';
                } else {
                    s.style.color = '#ddd';
                }
            });
        });
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (selectedRating === 0) {
            alert('Please provide an overall rating by clicking on the stars.');
            return;
        }
        
        const submitButton = document.getElementById('submitFeedback');
        submitButton.disabled = true;
        submitButton.textContent = 'Submitting Feedback...';
        
        // Collect form data
        const formData = new FormData(form);
        
        // Simulate form submission (replace with actual AJAX)
        setTimeout(() => {
            // Hide form, show thank you
            feedbackForm.style.display = 'none';
            thankYouSection.style.display = 'block';
            
            // Scroll to thank you section
            thankYouSection.scrollIntoView({ behavior: 'smooth' });
            
            // Show success message
            alert('Thank you! Your feedback has been submitted successfully. Check your email for bonus materials.');
            
        }, 2000);
    });
    
    // Checkbox item interaction
    document.querySelectorAll('.checkbox-item').forEach(item => {
        item.addEventListener('click', function(e) {
            if (e.target.type !== 'checkbox') {
                const checkbox = this.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;
            }
        });
    });
});
</script>
@endsection