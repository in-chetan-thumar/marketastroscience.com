<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QRCodeService
{
    /**
     * Generate QR code for event registration
     */
    public function generateRegistrationQR($registration)
    {
        $qrData = $this->prepareQRData($registration);
        $qrCodeImage = $this->createQRCode($qrData);
        $filename = $this->saveQRCode($qrCodeImage, $registration->registration_id);
        
        // Update registration with QR code path
        $registration->update(['qr_code_path' => $filename]);
        
        return $filename;
    }

    /**
     * Prepare data for QR code
     */
    private function prepareQRData($registration)
    {
        $fullName = $registration->first_name . ' ' . $registration->last_name;
        
        return json_encode([
            'event' => 'astro-trading-masterclass-2025',
            'registration_id' => $registration->registration_id,
            'name' => $fullName,
            'email' => $registration->email,
            'phone' => $registration->mobile_number,
            'event_date' => '2025-01-15',
            'event_time' => '19:00:00',
            'verified_at' => $registration->verified_at->toISOString(),
            'checksum' => hash('sha256', $registration->registration_id . $registration->email . config('app.key'))
        ]);
    }

    /**
     * Create QR code image using simple HTML/CSS approach
     * In production, use a proper QR library like endroid/qr-code
     */
    private function createQRCode($data)
    {
        // For now, create a styled card with registration details
        // In production, replace with actual QR code generation
        $html = $this->generateQRTemplate($data);
        
        // Convert HTML to image (you might want to use a library like wkhtmltoimage)
        // For now, we'll use a simple approach
        return $this->htmlToImage($html);
    }

    /**
     * Generate HTML template for QR code card
     */
    private function generateQRTemplate($data)
    {
        $decodedData = json_decode($data, true);
        
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { 
                    margin: 0; 
                    font-family: Arial, sans-serif; 
                    background: linear-gradient(135deg, #051536 0%, #F18603 100%);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    min-height: 100vh;
                    padding: 20px;
                }
                .qr-card {
                    background: white;
                    border-radius: 20px;
                    padding: 40px;
                    text-align: center;
                    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
                    max-width: 400px;
                    width: 100%;
                }
                .logo {
                    font-size: 24px;
                    font-weight: bold;
                    color: #051536;
                    margin-bottom: 20px;
                }
                .event-title {
                    font-size: 18px;
                    font-weight: bold;
                    color: #051536;
                    margin-bottom: 10px;
                }
                .qr-placeholder {
                    width: 200px;
                    height: 200px;
                    background: #f0f0f0;
                    margin: 20px auto;
                    border-radius: 10px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 12px;
                    color: #666;
                    border: 2px solid #051536;
                }
                .registration-id {
                    font-size: 16px;
                    font-weight: bold;
                    color: #F18603;
                    margin: 15px 0;
                }
                .details {
                    font-size: 12px;
                    color: #666;
                    line-height: 1.4;
                }
                .event-date {
                    font-size: 14px;
                    font-weight: bold;
                    color: #051536;
                    margin-top: 15px;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 10px;
                    color: #999;
                }
            </style>
        </head>
        <body>
            <div class="qr-card">
                <div class="logo">🌟 MARKET ASTRO SCIENCE</div>
                <div class="event-title">Astro Trading Masterclass 2025</div>
                
                <div class="qr-placeholder">
                    <!-- QR Code would be generated here -->
                    <div style="text-align: center;">
                        <div style="font-size: 20px; margin-bottom: 10px;">📱</div>
                        <div>QR CODE</div>
                        <div style="font-size: 10px; margin-top: 5px;">Scan for Entry</div>
                    </div>
                </div>
                
                <div class="registration-id">ID: ' . $decodedData['registration_id'] . '</div>
                <div class="details">
                    ' . $decodedData['name'] . '<br>
                    ' . $decodedData['phone'] . '
                </div>
                
                <div class="event-date">
                    📅 January 15, 2025<br>
                    🕐 7:00 PM IST
                </div>
                
                <div class="footer">
                    Present this QR code at the venue for entry<br>
                    Valid ID required • marketastroscience.com
                </div>
            </div>
        </body>
        </html>';
    }

    /**
     * Convert HTML to image using simple QR generation
     */
    private function htmlToImage($html)
    {
        // For demo purposes, we'll create a simple text-based QR representation
        // In production, install endroid/qr-code package:
        // composer require endroid/qr-code
        
        try {
            // Simple QR code data URI generation
            $qrData = json_decode(base64_decode(substr($html, strpos($html, 'base64,') + 7)), true);
            
            // Create a simple data URL for the QR content
            $qrContent = "Event: Astro Trading Masterclass 2025\n";
            $qrContent .= "ID: {$qrData['registration_id']}\n";
            $qrContent .= "Name: {$qrData['name']}\n";
            $qrContent .= "Date: January 15, 2025 7:00 PM IST";
            
            // Return the HTML content for now
            return base64_encode($html);
            
        } catch (\Exception $e) {
            Log::error('QR Code generation failed', ['error' => $e->getMessage()]);
            return base64_encode($html);
        }
    }

    /**
     * Save QR code to storage
     */
    private function saveQRCode($qrCodeData, $registrationId)
    {
        $filename = 'qr-codes/' . $registrationId . '_' . time() . '.html';
        
        // Ensure directory exists
        $directory = dirname($filename);
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }
        
        // Save to storage
        Storage::disk('public')->put($filename, base64_decode($qrCodeData));
        
        Log::info('QR Code saved successfully', [
            'registration_id' => $registrationId,
            'filename' => $filename
        ]);
        
        return $filename;
    }

    /**
     * Get QR code URL
     */
    public function getQRCodeUrl($registration)
    {
        if (!$registration->qr_code_path) {
            return null;
        }
        
        return Storage::disk('public')->url($registration->qr_code_path);
    }

    /**
     * Verify QR code data
     */
    public function verifyQRCode($scannedData)
    {
        try {
            $data = json_decode($scannedData, true);
            
            if (!isset($data['registration_id'], $data['checksum'])) {
                return false;
            }
            
            // Verify checksum
            $expectedChecksum = hash('sha256', $data['registration_id'] . $data['email'] . config('app.key'));
            
            if (!hash_equals($expectedChecksum, $data['checksum'])) {
                return false;
            }
            
            return $data;
        } catch (\Exception $e) {
            Log::error('QR Code verification failed', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Generate batch QR codes for multiple registrations
     */
    public function generateBatchQRCodes($registrations)
    {
        $results = [];
        
        foreach ($registrations as $registration) {
            try {
                $filename = $this->generateRegistrationQR($registration);
                $results[] = [
                    'registration_id' => $registration->registration_id,
                    'qr_code_path' => $filename,
                    'success' => true
                ];
            } catch (\Exception $e) {
                $results[] = [
                    'registration_id' => $registration->registration_id,
                    'success' => false,
                    'error' => $e->getMessage()
                ];
            }
        }
        
        return $results;
    }
}