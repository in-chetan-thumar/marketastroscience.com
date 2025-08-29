@extends('frontend.layouts.master')

@section('title')
    Registration Successful - Astro Trading Masterclass 2025
@endsection

@section('css')
<style>
:root {
    --primary-dark: #051536;
    --accent-orange: #F18603;
    --white: #ffffff;
    --light-gray: #f8f9ff;
    --text-gray: #666;
    --success-green: #28a745;
}

.success-hero {
    background: linear-gradient(135deg, var(--primary-dark) 0%, #0a2a5c 100%);
    color: var(--white);
    padding: 100px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.success-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(241,134,3,0.1)"/><circle cx="80" cy="40" r="1" fill="rgba(241,134,3,0.05)"/><circle cx="40" cy="80" r="1.5" fill="rgba(241,134,3,0.08)"/></svg>') repeat;
    z-index: 1;
}

.success-hero .container {
    position: relative;
    z-index: 2;
}

.success-icon {
    font-size: 80px;
    color: var(--success-green);
    margin-bottom: 30px;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

.success-title {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 20px;
    color: var(--white);
}

.success-subtitle {
    font-size: 18px;
    opacity: 0.9;
    margin-bottom: 40px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.registration-details {
    background: rgba(255, 255, 255, 0.1);
    padding: 40px;
    border-radius: 20px;
    max-width: 600px;
    margin: 0 auto 40px;
    backdrop-filter: blur(10px);
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 600;
    opacity: 0.8;
}

.detail-value {
    color: var(--accent-orange);
    font-weight: 600;
}

.next-steps {
    background: var(--white);
    padding: 80px 0;
}

.steps-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.step-card {
    background: var(--light-gray);
    padding: 40px 30px;
    border-radius: 15px;
    text-align: center;
    position: relative;
    transition: all 0.3s ease;
}

.step-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 40px rgba(5, 21, 54, 0.1);
}

.step-number {
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 40px;
    height: 40px;
    background: var(--accent-orange);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 18px;
}

.step-icon {
    font-size: 48px;
    color: var(--primary-dark);
    margin: 20px 0;
}

.step-title {
    font-size: 20px;
    font-weight: 600;
    color: var(--primary-dark);
    margin-bottom: 15px;
}

.step-description {
    color: var(--text-gray);
    line-height: 1.5;
}

.important-notes {
    background: var(--primary-dark);
    color: var(--white);
    padding: 60px 0;
}

.note-card {
    background: rgba(255, 255, 255, 0.1);
    padding: 30px;
    border-radius: 15px;
    margin-bottom: 20px;
    border-left: 4px solid var(--accent-orange);
}

.note-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 10px;
    color: var(--accent-orange);
}

.action-buttons {
    text-align: center;
    margin-top: 40px;
}

.btn-secondary {
    background: transparent;
    color: var(--accent-orange);
    border: 2px solid var(--accent-orange);
    padding: 15px 30px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    margin: 0 10px;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: var(--accent-orange);
    color: var(--white);
    text-decoration: none;
}

.btn-primary {
    background: var(--accent-orange);
    color: var(--white);
    border: 2px solid var(--accent-orange);
    padding: 15px 30px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    margin: 0 10px;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #e67503;
    border-color: #e67503;
    text-decoration: none;
    color: var(--white);
}

/* Responsive */
@media (max-width: 768px) {
    .success-title {
        font-size: 32px;
    }
    
    .registration-details {
        padding: 30px 20px;
    }
    
    .detail-row {
        flex-direction: column;
        text-align: left;
        gap: 5px;
    }
    
    .steps-grid {
        grid-template-columns: 1fr;
    }
    
    .action-buttons .btn-primary,
    .action-buttons .btn-secondary {
        display: block;
        margin: 10px 0;
        text-align: center;
    }
}
</style>
@endsection

@section('content')
<main>
    <!-- Success Hero Section -->
    <section class="success-hero">
        <div class="container">
            <div class="success-icon">✅</div>
            <h1 class="success-title">Registration Successful!</h1>
            <p class="success-subtitle">
                Welcome to the Astro Trading Masterclass 2025! Your journey to cosmic trading mastery begins here.
            </p>
            
            <div class="registration-details">
                <div class="detail-row">
                    <span class="detail-label">Registration ID:</span>
                    <span class="detail-value">{{ $registration->registration_id }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value">{{ $registration->full_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ $registration->email }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">WhatsApp:</span>
                    <span class="detail-value">+91-{{ $registration->whatsapp_number }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Event Date:</span>
                    <span class="detail-value">September 15, 2025 | 2:00 PM IST</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Investment:</span>
                    <span class="detail-value">₹1,499 (Early Bird 50% Off)</span>
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="#" class="btn-secondary" onclick="window.print()">
                    📄 Download Receipt
                </a>
                <a href="{{ route('home') }}" class="btn-primary">
                    🏠 Back to Home
                </a>
            </div>
        </div>
    </section>

    <!-- Next Steps -->
    <section class="next-steps">
        <div class="container">
            <h2 class="section-title">What Happens Next?</h2>
            <p class="section-subtitle">
                Here's your step-by-step guide to make the most of your astro trading masterclass experience.
            </p>
            
            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <div class="step-icon">📱</div>
                    <h3 class="step-title">Check Your WhatsApp</h3>
                    <p class="step-description">
                        You'll receive a QR code within 5 minutes. Save it for quick event check-in on September 15th.
                    </p>
                </div>
                
                <div class="step-card">
                    <div class="step-number">2</div>
                    <div class="step-icon">📧</div>
                    <h3 class="step-title">Email Confirmation</h3>
                    <p class="step-description">
                        Check your email for event details, preparation materials, and Zoom link (if attending virtually).
                    </p>
                </div>
                
                <div class="step-card">
                    <div class="step-number">3</div>
                    <div class="step-icon">📚</div>
                    <h3 class="step-title">Pre-Event Preparation</h3>
                    <p class="step-description">
                        Download the preparation guide and complete your birth chart form for personalized insights.
                    </p>
                </div>
                
                <div class="step-card">
                    <div class="step-number">4</div>
                    <div class="step-icon">🔔</div>
                    <h3 class="step-title">Get Reminders</h3>
                    <p class="step-description">
                        We'll send you reminders 7 days, 2 days, and 1 day before the event, plus day-of instructions.
                    </p>
                </div>
                
                <div class="step-card">
                    <div class="step-number">5</div>
                    <div class="step-icon">👥</div>
                    <h3 class="step-title">Join Community</h3>
                    <p class="step-description">
                        Access our exclusive WhatsApp group for daily predictions and networking with fellow astro traders.
                    </p>
                </div>
                
                <div class="step-card">
                    <div class="step-number">6</div>
                    <div class="step-icon">🎉</div>
                    <h3 class="step-title">Attend & Learn</h3>
                    <p class="step-description">
                        Join us on event day with your QR code ready. Bring a notebook and be prepared for transformation!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Important Notes -->
    <section class="important-notes">
        <div class="container">
            <h2 class="section-title">Important Information</h2>
            
            <div class="note-card">
                <h3 class="note-title">🎯 Event Location & Timing</h3>
                <p>
                    <strong>Date:</strong> September 15, 2025 (Sunday)<br>
                    <strong>Time:</strong> 2:00 PM - 6:00 PM IST<br>
                    <strong>Venue:</strong> Will be shared via WhatsApp 48 hours before event<br>
                    <strong>Format:</strong> Hybrid (In-person + Virtual attendance options)
                </p>
            </div>
            
            <div class="note-card">
                <h3 class="note-title">📋 What to Bring</h3>
                <p>
                    • Your smartphone with QR code saved<br>
                    • Notebook and pen for taking notes<br>
                    • Birth details (date, time, place) for chart analysis<br>
                    • Trading app access (for live demonstration)<br>
                    • Positive energy and curiosity to learn!
                </p>
            </div>
            
            <div class="note-card">
                <h3 class="note-title">🎁 Bonus Inclusions</h3>
                <p>
                    • Astro Trading Software (3-month free trial)<br>
                    • Daily prediction WhatsApp alerts<br>
                    • Personalized birth chart analysis<br>
                    • Exclusive community access<br>
                    • 30-day money-back guarantee
                </p>
            </div>
            
            <div class="note-card">
                <h3 class="note-title">📞 Support & Contact</h3>
                <p>
                    <strong>Questions?</strong> WhatsApp us at +91-9876543210<br>
                    <strong>Email:</strong> events@marketastroscience.com<br>
                    <strong>Support Hours:</strong> 9 AM - 9 PM (Mon-Sat)
                </p>
            </div>

            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('event.invite') }}?ref={{ $registration->referral_code ?? $registration->registration_id }}" class="btn-primary">
                    🤝 Invite Friends & Earn Rewards
                </a>
                <a href="{{ route('home') }}" class="btn-secondary">
                    🏠 Back to Home
                </a>
            </div>
        </div>
    </section>
</main>
@endsection

@section('script-bottom')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate referral code if not exists
    @if(!$registration->referral_code)
        // Generate referral code via AJAX
        fetch('/event/generate-referral', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                registration_id: '{{ $registration->registration_id }}'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update referral link
                const referralLink = document.querySelector('a[href*="ref="]');
                if (referralLink) {
                    referralLink.href = referralLink.href.replace(/ref=.*$/, 'ref=' + data.referral_code);
                }
            }
        });
    @endif
    
    // Show WhatsApp reminder
    setTimeout(() => {
        if (confirm('Would you like to save our contact to your WhatsApp for easy communication?')) {
            window.open('https://wa.me/919876543210?text=Hi! I just registered for Astro Trading Masterclass (ID: {{ $registration->registration_id }}). Looking forward to the event!');
        }
    }, 3000);
});
</script>
@endsection