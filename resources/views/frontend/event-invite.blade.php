@extends('frontend.layouts.master')

@section('title')
    Invite Friends - Astro Trading Masterclass 2025
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

.invite-hero {
    background: linear-gradient(135deg, var(--primary-dark) 0%, #0a2a5c 100%);
    color: var(--white);
    padding: 100px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.invite-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(241,134,3,0.1)"/><circle cx="80" cy="40" r="1" fill="rgba(241,134,3,0.05)"/><circle cx="40" cy="80" r="1.5" fill="rgba(241,134,3,0.08)"/></svg>') repeat;
    z-index: 1;
}

.invite-hero .container {
    position: relative;
    z-index: 2;
}

.invite-title {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 20px;
}

.invite-subtitle {
    font-size: 20px;
    opacity: 0.9;
    margin-bottom: 40px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.referral-info {
    background: rgba(255, 255, 255, 0.1);
    padding: 30px;
    border-radius: 20px;
    max-width: 500px;
    margin: 0 auto 40px;
    backdrop-filter: blur(10px);
}

.referrer-name {
    font-size: 24px;
    font-weight: 600;
    color: var(--accent-orange);
    margin-bottom: 10px;
}

.discount-info {
    font-size: 28px;
    font-weight: 700;
    color: var(--success-green);
    margin: 20px 0;
}

.invite-features {
    background: var(--white);
    padding: 80px 0;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.feature-card {
    background: var(--light-gray);
    padding: 40px 30px;
    border-radius: 15px;
    text-align: center;
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 40px rgba(5, 21, 54, 0.1);
}

.feature-icon {
    font-size: 48px;
    color: var(--accent-orange);
    margin-bottom: 20px;
}

.feature-title {
    font-size: 20px;
    font-weight: 600;
    color: var(--primary-dark);
    margin-bottom: 15px;
}

.sharing-section {
    background: var(--primary-dark);
    color: var(--white);
    padding: 80px 0;
}

.sharing-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 40px;
}

.share-button {
    background: var(--accent-orange);
    color: var(--white);
    padding: 20px;
    border-radius: 15px;
    text-decoration: none;
    font-weight: 600;
    text-align: center;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.share-button:hover {
    background: #e67503;
    transform: translateY(-2px);
    text-decoration: none;
    color: var(--white);
}

.referral-stats {
    background: var(--light-gray);
    padding: 60px 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.stat-item {
    text-align: center;
    background: var(--white);
    padding: 30px 20px;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
}

.stat-number {
    font-size: 36px;
    font-weight: 700;
    color: var(--accent-orange);
    margin-bottom: 10px;
}

.stat-label {
    font-size: 14px;
    color: var(--text-gray);
    font-weight: 600;
}

.cta-section {
    background: linear-gradient(135deg, var(--accent-orange) 0%, #ff8533 100%);
    color: var(--white);
    padding: 60px 0;
    text-align: center;
}

.cta-button {
    background: var(--white);
    color: var(--accent-orange);
    padding: 18px 40px;
    border: none;
    border-radius: 30px;
    font-size: 18px;
    font-weight: 700;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    margin-top: 20px;
}

.cta-button:hover {
    background: #f8f9ff;
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
    text-decoration: none;
    color: var(--accent-orange);
}

@media (max-width: 768px) {
    .invite-title {
        font-size: 32px;
    }
    
    .sharing-options {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection

@section('content')
<main>
    <!-- Invite Hero Section -->
    <section class="invite-hero">
        <div class="container">
            @if($referrer)
                <div class="referral-info">
                    <p>🎉 You've been personally invited by</p>
                    <div class="referrer-name">{{ $referrer->full_name }}</div>
                    <div class="discount-info">Get ₹500 OFF!</div>
                    <p>Special discount just for you</p>
                </div>
            @endif
            
            <h1 class="invite-title">Invite Friends & Earn Rewards</h1>
            <p class="invite-subtitle">
                Share the cosmic trading wisdom with your friends and earn amazing rewards for every successful registration.
            </p>
            
            @if(!$referrer)
                <div class="referral-info">
                    <p>💰 <strong>Earn ₹500</strong> for every friend who registers</p>
                    <p>🎁 <strong>Plus bonus</strong> when you reach 5 referrals</p>
                </div>
            @endif
            
            <a href="{{ $referrer ? route('event.landing') . '?ref=' . $referralCode : '#sharing' }}" class="cta-button">
                {{ $referrer ? 'Register with Discount' : 'Start Sharing Now' }}
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="invite-features">
        <div class="container">
            <h2 class="section-title">Why Your Friends Will Thank You</h2>
            <p class="section-subtitle">
                You're not just inviting them to an event - you're opening the door to a transformative trading journey.
            </p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🚀</div>
                    <h3 class="feature-title">Exclusive Early Bird Pricing</h3>
                    <p>Your friends get 50% off the regular price (₹1,499 instead of ₹2,999) when they use your referral.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3 class="feature-title">Proven Trading System</h3>
                    <p>Access to 87% accurate predictions that have helped thousands of traders achieve consistent profits.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <h3 class="feature-title">Elite Community Access</h3>
                    <p>Join an exclusive group of astro traders sharing insights, predictions, and success stories daily.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">🎁</div>
                    <h3 class="feature-title">Bonus Resources Worth ₹15,000</h3>
                    <p>Trading software, personal chart analysis, and 3 months of premium predictions included free.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sharing Section -->
    @if(!$referrer)
    <section class="sharing-section" id="sharing">
        <div class="container">
            <h2 class="section-title">Share & Earn Rewards</h2>
            <p class="section-subtitle">
                Choose your preferred way to invite friends and start earning rewards immediately.
            </p>
            
            <div class="sharing-options">
                <a href="#" class="share-button" onclick="shareViaWhatsApp()">
                    <i class="fab fa-whatsapp"></i>
                    Share on WhatsApp
                </a>
                
                <a href="#" class="share-button" onclick="copyReferralLink()">
                    <i class="fa-solid fa-link"></i>
                    Copy Referral Link
                </a>
                
                <a href="#" class="share-button" onclick="shareViaEmail()">
                    <i class="fa-solid fa-envelope"></i>
                    Send via Email
                </a>
                
                <a href="#" class="share-button" onclick="shareViaSMS()">
                    <i class="fa-solid fa-sms"></i>
                    Send SMS Invite
                </a>
            </div>
            
            <div style="margin-top: 40px; padding: 30px; background: rgba(255,255,255,0.1); border-radius: 15px;">
                <h4 style="color: var(--accent-orange); margin-bottom: 15px;">🎯 Your Referral Code:</h4>
                <div style="font-size: 24px; font-weight: 700; letter-spacing: 2px;" id="referralCodeDisplay">
                    {{ $referralCode ?? 'REGISTER_FIRST' }}
                </div>
                <p style="font-size: 14px; margin-top: 10px; opacity: 0.8;">
                    Share this code with friends for instant ₹500 discount
                </p>
            </div>
        </div>
    </section>
    @endif

    <!-- Referral Stats -->
    <section class="referral-stats">
        <div class="container">
            <h2 class="section-title">Referral Program Benefits</h2>
            
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">₹500</div>
                    <div class="stat-label">Per Referral</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-number">₹2,500</div>
                    <div class="stat-label">Bonus at 5 Referrals</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-number">₹10,000</div>
                    <div class="stat-label">Bonus at 15 Referrals</div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-number">🏆</div>
                    <div class="stat-label">Top Referrer Prize</div>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 40px; padding: 30px; background: var(--white); border-radius: 15px; box-shadow: 0 5px 25px rgba(0,0,0,0.1);">
                <h3 style="color: var(--primary-dark); margin-bottom: 15px;">🌟 Special Rewards</h3>
                <p style="color: var(--text-gray);">
                    <strong>Top 3 Referrers</strong> get exclusive one-on-one sessions with our master trainers + 
                    lifetime access to all future events + special recognition certificate!
                </p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 style="font-size: 36px; font-weight: 700; margin-bottom: 20px;">
                Ready to Transform Lives and Earn Rewards?
            </h2>
            <p style="font-size: 18px; margin-bottom: 30px;">
                Start sharing now and watch your friends thank you for introducing them to cosmic trading success!
            </p>
            
            @if($referrer)
                <a href="{{ route('event.landing') }}?ref={{ $referralCode }}" class="cta-button">
                    Register Now with ₹500 Discount
                </a>
            @else
                <a href="#sharing" class="cta-button">
                    Start Inviting Friends Now
                </a>
            @endif
        </div>
    </section>
</main>

<!-- Share Modal -->
<div id="shareModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 40px; border-radius: 20px; max-width: 500px; width: 90%;">
        <h3 style="color: var(--primary-dark); margin-bottom: 20px;">📱 Share Your Invitation</h3>
        
        <div style="background: var(--light-gray); padding: 20px; border-radius: 10px; margin-bottom: 20px;">
            <p style="font-size: 14px; color: var(--text-gray); margin-bottom: 10px;">Your invitation message:</p>
            <div id="shareMessage" style="font-size: 12px; color: var(--primary-dark); line-height: 1.4;"></div>
        </div>
        
        <div style="text-align: center;">
            <button onclick="copyMessage()" style="background: var(--accent-orange); color: white; border: none; padding: 10px 20px; border-radius: 20px; margin: 5px; cursor: pointer;">
                📋 Copy Message
            </button>
            <button onclick="closeShareModal()" style="background: var(--text-gray); color: white; border: none; padding: 10px 20px; border-radius: 20px; margin: 5px; cursor: pointer;">
                Close
            </button>
        </div>
    </div>
</div>
@endsection

@section('script-bottom')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const referralCode = '{{ $referralCode ?? "" }}';
    const registrationUrl = '{{ route('event.landing') }}' + (referralCode ? '?ref=' + referralCode : '');
    
    // Share message template
    const shareMessageTemplate = `🎯 *Exclusive Invitation to Astro Trading Masterclass!*

✨ I've discovered an amazing event that transformed my trading approach and wanted to share it with you!

🎓 *Event:* Astro Trading Masterclass 2025
📅 *Date:* September 15, 2025 (Sunday)
🕐 *Time:* 2:00 PM - 6:00 PM IST
💰 *Special Price:* ₹1,499 (50% off!)

${referralCode ? '🎁 *Your Discount Code:* ' + referralCode + ' (Extra ₹500 off!)' : ''}

🌟 *What You'll Learn:*
• How to predict market movements using astrology
• Personal trading chart analysis
• Exclusive trading software worth ₹15,000
• Join 15,000+ successful astro traders

👉 *Register here:* ${registrationUrl}

Limited seats! Don't miss this life-changing opportunity! 🚀`;

    window.shareViaWhatsApp = function() {
        const message = encodeURIComponent(shareMessageTemplate);
        window.open(`https://wa.me/?text=${message}`);
    };

    window.shareViaEmail = function() {
        const subject = encodeURIComponent('Join me for Astro Trading Masterclass 2025!');
        const body = encodeURIComponent(shareMessageTemplate);
        window.open(`mailto:?subject=${subject}&body=${body}`);
    };

    window.shareViaSMS = function() {
        const message = encodeURIComponent(shareMessageTemplate);
        window.open(`sms:?body=${message}`);
    };

    window.copyReferralLink = function() {
        navigator.clipboard.writeText(registrationUrl).then(() => {
            alert('Referral link copied to clipboard!');
        }).catch(() => {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = registrationUrl;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('Referral link copied to clipboard!');
        });
    };

    window.shareMessage = function() {
        document.getElementById('shareMessage').textContent = shareMessageTemplate;
        document.getElementById('shareModal').style.display = 'block';
    };

    window.copyMessage = function() {
        const message = document.getElementById('shareMessage').textContent;
        navigator.clipboard.writeText(message).then(() => {
            alert('Message copied to clipboard!');
            closeShareModal();
        });
    };

    window.closeShareModal = function() {
        document.getElementById('shareModal').style.display = 'none';
    };

    // Close modal when clicking outside
    document.getElementById('shareModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeShareModal();
        }
    });
});
</script>
@endsection