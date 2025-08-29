# MSG91 WhatsApp Integration Setup

This document explains how to set up MSG91 WhatsApp API integration for the event registration system.

## Environment Variables

Add these variables to your `.env` file:

```env
MSG91_API_URL=https://api.msg91.com/api/v5/whatsapp/whatsapp-outbound-message/bulk/
MSG91_AUTH_KEY=your_auth_key_here
MSG91_INTEGRATED_NUMBER=918140303038
MSG91_NAMESPACE=880d83ae_fdcf_4364_a1da_9293c488f768
MSG91_OTP_TEMPLATE=grahchakra_otp
MSG91_REGISTRATION_SUCCESS_TEMPLATE=event_registration_success
```

## Required MSG91 Templates

### 1. OTP Template (`grahchakra_otp`)
- **Template Name**: `grahchakra_otp`
- **Components**:
  - `body_1`: OTP code (text variable)
  - `button_1`: URL button linking back to registration page

### 2. Registration Success Template (`event_registration_success`)
- **Template Name**: `event_registration_success`
- **Components**:
  - `body_1`: Full name (text variable)
  - `body_2`: Registration ID (text variable)  
  - `body_3`: Event date (text variable)
  - `body_4`: Event time (text variable)
  - `button_2`: URL button linking to success page

## Testing the Integration

Use the built-in command to test WhatsApp functionality:

```bash
# Test OTP sending
php artisan whatsapp:test 9876543210 --type=otp

# Check API status
php artisan whatsapp:test 9876543210 --type=status
```

## Implementation Details

### Features Implemented:
1. ✅ OTP verification via WhatsApp template
2. ✅ Registration confirmation with QR code info
3. ✅ Proper error handling and logging
4. ✅ Server-side validation with custom request classes
5. ✅ Wizard-style registration flow (3 steps)

### Files Created/Modified:
- `app/Http/Requests/EventRegistrationRequest.php` - Form validation
- `app/Http/Requests/EventOtpVerifyRequest.php` - OTP validation  
- `app/Http/Requests/EventResendOtpRequest.php` - Resend OTP validation
- `app/Services/WhatsAppService.php` - Updated for MSG91 API
- `config/services.php` - Added MSG91 configuration
- `app/Console/Commands/TestWhatsAppIntegration.php` - Testing command

### Security Features:
- Input sanitization and validation
- OTP expiry (5 minutes)
- Registration ID format validation
- Phone number format validation (Indian numbers)
- Email uniqueness checks
- XSS protection in form inputs

## Troubleshooting

### Common Issues:
1. **OTP not received**: Check MSG91 dashboard for delivery status
2. **Template not found**: Verify template names in MSG91 console
3. **Authentication failed**: Check `MSG91_AUTH_KEY` in .env
4. **Invalid phone format**: Ensure numbers start with 6-9 and are 10 digits

### Logs Location:
Check `storage/logs/laravel.log` for detailed error information.