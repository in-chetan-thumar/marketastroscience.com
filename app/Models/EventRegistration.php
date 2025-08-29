<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventRegistration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'registration_id',
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'whatsapp_number',
        'trading_experience',
        'birth_date',
        'otp',
        'otp_expiry',
        'status',
        'verified_at',
        'qr_code_path',
        'attended',
        'feedback_submitted',
        'referral_code',
        'referred_by'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'otp_expiry' => 'datetime',
        'verified_at' => 'datetime',
        'attended' => 'boolean',
        'feedback_submitted' => 'boolean'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'verified_at',
        'otp_expiry'
    ];

    // Status constants
    const STATUS_PENDING = 'pending_verification';
    const STATUS_VERIFIED = 'verified';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_ATTENDED = 'attended';


    /**
     * Get full name attribute
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Check if registration is verified
     */
    public function isVerified()
    {
        return $this->status === self::STATUS_VERIFIED || $this->status === self::STATUS_CONFIRMED;
    }


    /**
     * Check if OTP is expired
     */
    public function isOtpExpired()
    {
        return $this->otp_expiry && $this->otp_expiry->isPast();
    }

    /**
     * Generate referral code
     */
    public function generateReferralCode()
    {
        $this->referral_code = 'MAS' . strtoupper(substr($this->first_name, 0, 2)) . rand(1000, 9999);
        $this->save();
        return $this->referral_code;
    }

    /**
     * Get referrals made by this registration
     */
    public function referrals()
    {
        return $this->hasMany(EventRegistration::class, 'referred_by', 'registration_id');
    }

    /**
     * Get the registration that referred this one
     */
    public function referrer()
    {
        return $this->belongsTo(EventRegistration::class, 'referred_by', 'registration_id');
    }

    /**
     * Scope for verified registrations
     */
    public function scopeVerified($query)
    {
        return $query->whereIn('status', [self::STATUS_VERIFIED, self::STATUS_CONFIRMED, self::STATUS_ATTENDED]);
    }

    /**
     * Scope for pending registrations
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

}