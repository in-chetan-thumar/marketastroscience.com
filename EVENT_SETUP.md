# Event Landing Page Setup Guide

## 🚀 Quick Start

The event landing page has been successfully created with all the requested features:

### ✅ Completed Features

1. **Landing Page**: `/event/astro-trading-masterclass`
2. **Registration Form** with validation for all required fields
3. **OTP Verification System** via WhatsApp
4. **QR Code Generation** for event entry
5. **Email & WhatsApp Reminder System**
6. **Referral/Invite System** with rewards
7. **Feedback System** for post-event
8. **Custom Design** with requested color theme (#051536, #F18603)

## 🔧 Required Configuration

### 1. Supabase Setup

Add these to your `.env` file:

```env
# Supabase Configuration
SUPABASE_URL=your_supabase_project_url
SUPABASE_ANON_KEY=your_anon_key
SUPABASE_SERVICE_KEY=your_service_role_key
SUPABASE_DB_URL=postgresql://[user]:[password]@[host]:[port]/[database]
SUPABASE_DB_HOST=db.your_project_ref.supabase.co
SUPABASE_DB_PORT=5432
SUPABASE_DB_DATABASE=postgres
SUPABASE_DB_USERNAME=postgres
SUPABASE_DB_PASSWORD=your_database_password
SUPABASE_DB_SCHEMA=public
SUPABASE_STORAGE_BUCKET=event-assets
```

### 2. MSG19 WhatsApp API Setup

Add these to your `.env` file:

```env
# MSG19 WhatsApp API Configuration
MSG19_API_URL=https://api.msg19.com/v1
MSG19_API_KEY=your_msg19_api_key
MSG19_FROM_NUMBER=your_whatsapp_business_number
```

### 3. Payment Gateway (Razorpay)

```env
# Event Configuration
EVENT_PAYMENT_GATEWAY=razorpay
RAZORPAY_KEY_ID=your_razorpay_key_id
RAZORPAY_KEY_SECRET=your_razorpay_secret
```

## 📋 Database Migration

Run this command to create the database table:

```bash
php artisan migrate
```

This will create the `event_registrations` table with all necessary fields.

## 🎯 Key Features

### Registration Form Fields
- First Name (required)
- Last Name (required) 
- Email (required, unique)
- Mobile Number (required, 10 digits)
- WhatsApp Number (required, 10 digits)
- Trading Experience (optional dropdown)
- Birth Date (optional, for personalized chart)
- Terms & Conditions checkbox (required)

### Automated Workflows

1. **Registration Flow**:
   - User fills form → OTP sent to WhatsApp → Verification → QR code sent

2. **Reminder System**:
   ```bash
   php artisan event:send-reminders 7day   # 7 days before
   php artisan event:send-reminders 2day   # 2 days before  
   php artisan event:send-reminders 1day   # 1 day before
   php artisan event:send-reminders today  # Day of event
   ```

3. **Post-Event**:
   ```bash
   php artisan event:send-feedback
   ```

### Referral System
- Each registration gets a unique referral code
- ₹500 discount for referred users
- ₹500 reward for referrer
- Special bonuses for multiple referrals

## 🎨 Design Features

- **Color Theme**: #051536 (primary dark) + #F18603 (accent orange)
- **Responsive Design**: Works on all devices
- **Modern UI**: Clean, professional look inspired by wealcoder reference
- **Smooth Animations**: Hover effects and transitions
- **Loading States**: Visual feedback during form submission

## 📱 WhatsApp Integration

The system sends:
- OTP verification codes
- Registration confirmation with event details
- QR codes for entry
- Event reminders (7, 2, 1 days before + day-of)
- Feedback requests post-event

## 🔐 Security Features

- CSRF protection on all forms
- Input validation and sanitization
- OTP expiry (5 minutes)
- QR code checksums for verification
- Rate limiting on API endpoints

## 📊 Admin Features

Track registrations via:
- Database queries on `event_registrations` table
- Registration status monitoring
- Payment status tracking
- Attendance marking
- Feedback analysis

## 🚀 Going Live

1. Configure Supabase credentials
2. Set up MSG19 WhatsApp API
3. Configure payment gateway
4. Run database migrations
5. Test the complete flow
6. Set up cron jobs for automated reminders

## 📞 Support

For technical support with setup:
- Check logs at `storage/logs/laravel.log`
- Verify API configurations
- Test WhatsApp API connectivity
- Validate database connections

## 🎉 Ready to Launch!

Your event landing page is complete and ready for registrations. Just add the API credentials and you're good to go!

Access your landing page at: `/event/astro-trading-masterclass`