<?php

namespace App\Examples;

use App\Models\Setting;

/**
 * Practical Usage Examples for Dynamic Settings System
 * 
 * This file demonstrates real-world integration patterns
 */

class SettingsUsageExamples
{
    /**
     * Example 1: Service Integration
     * Replace env() with setting() in your services
     */
    public function serviceLevelIntegration()
    {
        // ❌ OLD WAY (hardcoded from .env)
        // $token = env('FONNTE_TOKEN');
        
        // ✅ NEW WAY (dynamic from database)
        $token = setting('FONNTE_TOKEN');
        
        return $token;
    }
    
    /**
     * Example 2: Controller Usage
     * Access settings in controllers
     */
    public function controllerExample()
    {
        $adminPhone = setting('ADMIN_PHONE');
        
        // Use in message, redirect, etc.
        return response()->json([
            'admin_contact' => $adminPhone
        ]);
    }
    
    /**
     * Example 3: Configuration Class
     * Create a type-safe configuration class
     */
    public function configurationClass()
    {
        return new class {
            public function getFonnteToken(): string
            {
                return setting('FONNTE_TOKEN', '');
            }
            
            public function getAdminPhone(): string
            {
                return setting('ADMIN_PHONE', '');
            }
            
            public function hasFonnteConfigured(): bool
            {
                return !empty($this->getFonnteToken());
            }
        };
    }
    
    /**
     * Example 4: Service Provider
     * Bootstrap settings in service provider
     */
    public function serviceProviderExample()
    {
        // In AppServiceProvider::boot()
        /*
        public function boot()
        {
            // Make settings available globally
            View::share('adminPhone', setting('ADMIN_PHONE'));
            
            // Or bind to container
            $this->app->singleton('fonnte.token', function() {
                return setting('FONNTE_TOKEN');
            });
        }
        */
    }
    
    /**
     * Example 5: Middleware
     * Use settings in middleware
     */
    public function middlewareExample()
    {
        /*
        public function handle($request, Closure $next)
        {
            $adminPhone = setting('ADMIN_PHONE');
            
            if (!$adminPhone) {
                return redirect()->route('settings')
                    ->with('error', 'Please configure admin phone');
            }
            
            return $next($request);
        }
        */
    }
    
    /**
     * Example 6: Blade Templates
     * Access settings in views
     */
    public function bladeTemplateExample()
    {
        /*
        <div class="footer">
            <p>Contact Admin: {{ setting('ADMIN_PHONE') }}</p>
        </div>
        
        @if(setting('FONNTE_TOKEN'))
            <button>Send WhatsApp</button>
        @else
            <p>WhatsApp not configured</p>
        @endif
        */
    }
    
    /**
     * Example 7: Console Commands
     * Use settings in artisan commands
     */
    public function consoleCommandExample()
    {
        /*
        use App\Models\Setting;
        
        class NotifyAdminCommand extends Command
        {
            public function handle()
            {
                $adminPhone = setting('ADMIN_PHONE');
                $token = setting('FONNTE_TOKEN');
                
                // Send notification logic
                $this->info("Sending to: " . $adminPhone);
            }
        }
        */
    }
    
    /**
     * Example 8: Event Listeners
     * Access settings in event handlers
     */
    public function eventListenerExample()
    {
        /*
        class BookingCreated
        {
            public function handle(BookingCreatedEvent $event)
            {
                $adminPhone = setting('ADMIN_PHONE');
                $token = setting('FONNTE_TOKEN');
                
                // Notify admin about new booking
                $this->notifyAdmin($event->booking, $adminPhone, $token);
            }
        }
        */
    }
    
    /**
     * Example 9: Jobs/Queues
     * Use settings in queued jobs
     */
    public function queuedJobExample()
    {
        /*
        class SendWhatsAppJob implements ShouldQueue
        {
            public function handle()
            {
                // Settings are cached, very fast
                $token = setting('FONNTE_TOKEN');
                
                // Use in API call
                Http::withToken($token)->post(...);
            }
        }
        */
    }
    
    /**
     * Example 10: API Integration
     * Complete FonnteService example
     */
    public function fonnteServiceExample()
    {
        return new class {
            protected string $apiUrl = 'https://api.fonnte.com/send';
            
            public function sendMessage(string $phone, string $message): array
            {
                $token = setting('FONNTE_TOKEN');
                
                if (empty($token)) {
                    throw new \Exception('Fonnte token not configured');
                }
                
                // Simulated HTTP call
                // return Http::withHeaders([
                //     'Authorization' => $token
                // ])->post($this->apiUrl, [
                //     'target' => $phone,
                //     'message' => $message
                // ])->json();
                
                return ['status' => 'queued'];
            }
            
            public function notifyAdmin(string $message): array
            {
                $adminPhone = setting('ADMIN_PHONE');
                return $this->sendMessage($adminPhone, $message);
            }
        };
    }
    
    /**
     * Example 11: Programmatic Updates
     * Update settings from code
     */
    public function programmaticUpdate()
    {
        // Update via helper
        setting('ADMIN_PHONE', '628987654321');
        
        // Update via model with metadata
        Setting::set(
            'FONNTE_TOKEN',
            'new-secure-token-xyz',
            'string',
            'Updated Fonnte API token'
        );
        
        // Cache is automatically cleared
    }
    
    /**
     * Example 12: Bulk Operations
     * Handle multiple settings efficiently
     */
    public function bulkOperations()
    {
        // Get all settings at once
        $allSettings = settings();
        
        $token = $allSettings['FONNTE_TOKEN'] ?? '';
        $phone = $allSettings['ADMIN_PHONE'] ?? '';
        
        // Batch updates
        collect([
            'ADMIN_PHONE' => '628111111111',
            'FONNTE_TOKEN' => 'new-token',
        ])->each(function($value, $key) {
            Setting::set($key, $value);
        });
    }
    
    /**
     * Example 13: Validation Before Use
     * Always validate critical settings
     */
    public function validationExample()
    {
        $phone = setting('ADMIN_PHONE');
        
        // Validate format
        if (!preg_match('/^628[0-9]{8,13}$/', $phone)) {
            throw new \InvalidArgumentException('Invalid phone format');
        }
        
        // Check existence
        if (!Setting::has('FONNTE_TOKEN')) {
            abort(500, 'Application not configured');
        }
        
        return $phone;
    }
}

// ============================================
// REAL-WORLD MIGRATION EXAMPLE
// ============================================

/**
 * Before: FonnteService using env()
 */
class FonnteServiceOld
{
    protected $token;
    protected $adminPhone;
    
    public function __construct()
    {
        // ❌ Hardcoded
        $this->token = env('FONNTE_TOKEN');
        $this->adminPhone = env('ADMIN_PHONE');
    }
    
    public function sendToAdmin(string $message)
    {
        // Cannot change without restarting server
        return $this->send($this->adminPhone, $message);
    }
    
    protected function send($phone, $message) { /* ... */ }
}

/**
 * After: FonnteService using setting()
 */
class FonnteServiceNew
{
    public function sendToAdmin(string $message)
    {
        // ✅ Dynamic, changeable via admin panel
        $adminPhone = setting('ADMIN_PHONE');
        $token = $this->getToken();
        
        return $this->send($adminPhone, $message, $token);
    }
    
    protected function getToken(): string
    {
        // ✅ Can be updated without code deploy
        return setting('FONNTE_TOKEN');
    }
    
    protected function send($phone, $message, $token) { /* ... */ }
}
