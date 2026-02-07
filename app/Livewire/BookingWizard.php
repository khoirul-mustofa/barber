<?php

namespace App\Livewire;

use App\Models\Barber;
use App\Models\Booking;
use App\Models\Service;
use App\Models\TimeSlot;
use App\Models\PaymentMethod;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class BookingWizard extends Component
{
    use WithFileUploads;

    // Wizard State
    public $step = 1;

    public $totalSteps = 6;

    // Data Properties
    public $service_id;

    public $barber_id;

    public $booking_date;

    public $booking_time;

    public $name;

    public $phone;

    public $notes;

    public $payment_method;

    public $payment_proof;

    public $booking_code;

    // Computed/Fetched Data
    public $total_price = 0;

    public $dp_amount = 0;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->booking_date = now()->format('Y-m-d');
    }

    // Step Navigation
    public function nextStep()
    {
        $this->validateStep();
        if ($this->step < $this->totalSteps) {
            $this->step++;
        }
    }

    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function setStep($step)
    {
        // Allow jumping back, but validate forward movement
        if ($step < $this->step) {
            $this->step = $step;
        }
    }

    // specific selection methods for better UI interaction
    public function selectService($id, $price)
    {
        $this->service_id = $id;
        $this->total_price = $price;
        $this->dp_amount = $price * 0.5; // Example: 50% DP
        $this->nextStep();
    }

    public function selectBarber($id)
    {
        $this->barber_id = $id;
        $this->nextStep();
    }

    public function selectTime($time)
    {
        $this->booking_time = $time;
        // Don't auto advance here, let user confirm date/time
    }

    public function validateStep()
    {
        if ($this->step == 1) {
            $this->validate([
                'service_id' => 'required|exists:services,id',
            ]);
        } elseif ($this->step == 2) {
            $this->validate([
                'barber_id' => 'required|exists:barbers,id',
            ]);
        } elseif ($this->step == 3) {
            $this->validate([
                'booking_date' => 'required|date|after_or_equal:today',
                'booking_time' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $isTaken = Booking::where('booking_date', $this->booking_date)
                            ->where('barber_id', $this->barber_id)
                            ->whereIn('status', [
                                'waiting_payment',
                                'waiting_verification',
                                'confirmed',
                            ])
                            ->where('booking_time', $value)
                            ->exists();

                        if ($isTaken) {
                            $fail('Jadwal ini sudah terisi. Silakan pilih jam lain.');
                        }
                    },
                ],
            ]);
        } elseif ($this->step == 4) {
            $this->validate([
                'name' => 'required|string|min:3',
                'phone' => 'required|string|min:10',
                'notes' => 'nullable|string',
            ]);
        } elseif ($this->step == 5) {
            $this->validate([
                'payment_method' => ['required', 'exists:payment_methods,code'],
                'payment_proof' => 'required|image|max:2048', // 2MB Max
            ]);
        }
    }

    public function messages()
    {
        return [
            'service_id.required' => 'Silakan pilih layanan terlebih dahulu.',
            'barber_id.required' => 'Silakan pilih barber.',
            'booking_date.required' => 'Silakan pilih tanggal booking.',
            'booking_date.after_or_equal' => 'Tanggal booking harus hari ini atau setelahnya.',
            'booking_time.required' => 'Silakan pilih jam booking.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.min' => 'Nomor telepon minimal 10 digit.',
            'payment_method.required' => 'Silakan pilih metode pembayaran.',
            'payment_proof.required' => 'Bukti pembayaran wajib diupload.',
            'payment_proof.image' => 'File harus berupa gambar.',
            'payment_proof.max' => 'Ukuran file maksimal 2MB.',
        ];
    }

    public function submit()
    {
        $this->validateStep(); // Validate current step (payment)

        // Final Validation of all data
        $this->validate([
            'service_id' => 'required',
            'barber_id' => 'required',
            'booking_date' => 'required',
            'booking_time' => [
                'required',
                function ($attribute, $value, $fail) {
                    $isTaken = Booking::where('booking_date', $this->booking_date)
                        ->where('barber_id', $this->barber_id)
                        ->whereIn('status', [
                            'waiting_payment',
                            'waiting_verification',
                            'confirmed',
                        ])
                        ->where('booking_time', $value)
                        ->exists();

                    if ($isTaken) {
                        $fail('Maaf, jadwal ini baru saja diambil oleh orang lain. Silakan pilih waktu lain.');
                    }
                },
            ],
            'name' => 'required',
            'phone' => 'required',
            'payment_proof' => 'required',
        ]);

        // Process Payment Proof Upload
        $proofPath = $this->payment_proof->store('payment_proofs', 'public');

        // Create Booking
        $booking = Booking::create([
            'booking_code' => 'BK-'.strtoupper(Str::random(8)),
            'service_id' => $this->service_id,
            'barber_id' => $this->barber_id,
            'booking_date' => $this->booking_date,
            'booking_time' => $this->booking_time,
            'name' => $this->name,
            'phone' => $this->phone,
            'notes' => $this->notes,
            'payment_method' => $this->payment_method, // Will be string value from Enum
            'payment_proof' => $proofPath,
            'total_price' => $this->total_price,
            'dp_amount' => $this->dp_amount,
            'status' => 'waiting_verification',
        ]);

        $this->booking_code = $booking->booking_code;

        // Move to Success Step
        $this->step = 6;

        // Optional: clear session/state if needed, but for now we keep it to show success message
    }

    #[Layout('kuga.layouts.app')]
    public function render()
    {
        $data = [];

        // Always pass services and barbers for the summary panel
        $data['services'] = Service::all();
        $data['barbers'] = Barber::all();
        $data['payment_methods'] = PaymentMethod::where('is_active', true)->get();

        if ($this->step == 3) {
            // Get raw booking times and format them to H:i
            $takenSlots = Booking::where('booking_date', $this->booking_date)
                ->where('barber_id', $this->barber_id)
                ->whereIn('status', [
                    'waiting_payment',
                    'waiting_verification',
                    'confirmed',
                ])
                ->get() // Get collection to use model casting
                ->map(function ($booking) {
                    return $booking->booking_time->format('H:i');
                })
                ->toArray();

            $allSlots = TimeSlot::where('is_active', true)->orderBy('start_time')->get();

            // Map slots to include is_taken status
            $isToday = $this->booking_date === now()->format('Y-m-d');
            $currentTime = now()->format('H:i'); // Compare using H:i

            $data['timeSlots'] = $allSlots->map(function ($slot) use ($takenSlots, $isToday, $currentTime) {
                // Determine format based on DB value, safe bet is substr or format
                $slotTime = date('H:i', strtotime($slot->start_time));
                
                // Check if taken OR if it's today and the time has passed
                $isPast = $isToday && $slotTime < $currentTime;
                
                $slot->is_taken = in_array($slotTime, $takenSlots) || $isPast;
                $slot->display_time = $slotTime;

                return $slot;
            });
        }

        return view('livewire.booking-wizard', $data);
    }
}
