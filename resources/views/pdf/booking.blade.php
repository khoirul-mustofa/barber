<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation - {{ $booking->booking_code }}</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
            color: #374151; /* Gray 700 */
            line-height: 1.6;
            font-size: 14px;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        /* Top Accent Bar */
        .top-bar {
            height: 8px;
            background-color: #065f46; /* Emerald 800 */
            width: 100%;
        }

        /* Container */
        .container {
            padding: 40px 50px;
        }

        /* Header */
        .header-table {
            width: 100%;
            margin-bottom: 40px;
            border-bottom: 2px solid #f3f4f6; /* Gray 100 */
            padding-bottom: 20px;
        }
        .brand-name {
            font-family: 'Georgia', serif;
            font-size: 28px;
            font-weight: bold;
            color: #065f46;
            margin: 0;
            letter-spacing: 1px;
        }
        .brand-subtitle {
            font-size: 11px;
            color: #6b7280; /* Gray 500 */
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 5px;
        }
        .invoice-label {
            font-size: 12px;
            font-weight: bold;
            color: #9ca3af; /* Gray 400 */
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: right;
            display: block;
        }
        .invoice-number {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937; /* Gray 900 */
            text-align: right;
            margin-top: 5px;
            font-family: 'Courier New', Courier, monospace; /* Monospace for code */
        }
        
        /* Status Badge */
        .status-container {
            text-align: right;
            margin-top: 10px;
        }
        .status-pill {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .status-waiting { background-color: #fffbeb; color: #b45309; border: 1px solid #fcd34d; }
        .status-confirmed { background-color: #ecfdf5; color: #047857; border: 1px solid #6ee7b7; }
        .status-cancelled { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fca5a5; }

        /* Two Column Layout */
        .info-table {
            width: 100%;
            margin-bottom: 40px;
        }
        .info-column {
            width: 48%; /* Slightly less than 50% for gap */
            vertical-align: top;
        }
        
        .section-title {
            font-size: 10px;
            font-weight: bold;
            color: #059669; /* Emerald 600 */
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }

        .info-label {
            font-size: 11px;
            color: #6b7280; /* Gray 500 */
            margin-bottom: 2px;
        }
        .info-value {
            font-size: 14px;
            color: #111827; /* Gray 900 */
            font-weight: 500;
            margin-bottom: 15px;
        }
        .info-value-large {
            font-size: 16px;
            font-weight: bold;
            color: #111827;
            font-family: 'Georgia', serif;
            margin-bottom: 5px;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            text-align: left;
            padding: 12px 10px;
            background-color: #f9fafb;
            color: #4b5563;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid #e5e7eb;
            border-top: 1px solid #e5e7eb;
        }
        .items-table td {
            padding: 20px 10px;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: top;
        }
        .item-name {
            font-size: 14px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 4px;
        }
        .item-desc {
            font-size: 12px;
            color: #6b7280;
            font-style: italic;
        }
        .item-price {
            text-align: right;
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }

        /* Totals */
        .totals-table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: avoid;
        }
        .totals-table td {
            padding: 5px 0;
            text-align: right;
        }
        .total-label {
            font-size: 12px;
            color: #6b7280;
            padding-right: 30px;
        }
        .total-number {
            font-size: 13px;
            font-weight: 500;
            color: #111827;
            width: 120px;
        }
        .grand-total-row td {
            padding-top: 15px;
            padding-bottom: 15px;
            border-top: 2px solid #059669;
            border-bottom: 2px solid #059669; /* Double border effect via explicit height? No, just top/bottom lines */
        }
        .grand-total-label {
            font-size: 14px;
            font-weight: bold;
            color: #065f46;
            text-transform: uppercase;
            padding-right: 30px;
        }
        .grand-total-number {
            font-size: 18px;
            font-weight: bold;
            color: #065f46;
        }

        /* Helper Box */
        .helper-box {
            background-color: #f8fafc; /* Slate 50 */
            border-left: 4px solid #94a3b8; /* Slate 400 */
            padding: 15px 20px;
            margin-top: 30px;
            page-break-inside: avoid;
        }
        .helper-text {
            font-size: 11px;
            color: #64748b;
            line-height: 1.5;
        }
        .helper-title {
            font-size: 11px;
            font-weight: bold;
            color: #334155;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 40px;
            text-align: center;
            border-top: 1px solid #f3f4f6;
            padding-top: 15px;
        }
        .footer-text {
            font-size: 10px;
            color: #9ca3af;
            letter-spacing: 0.5px;
        }
        
    </style>
</head>
<body>

    <div class="top-bar"></div>

    <div class="container">
        
        <!-- Header -->
        <table class="header-table">
            <tr>
                <td style="vertical-align: top;">
                    <div class="brand-name">KUGA BARBER</div>
                    <div class="brand-subtitle">Premium Cuts & Styles</div>
                </td>
                <td style="vertical-align: top; text-align: right;">
                    <span class="invoice-label">Kode Booking</span>
                    <div class="invoice-number">{{ $booking->booking_code }}</div>
                    
                    <div class="status-container">
                        @if($booking->status->value == 'waiting_payment')
                            <span class="status-pill status-waiting">Menunggu Pembayaran</span>
                        @elseif($booking->status->value == 'confirmed')
                            <span class="status-pill status-confirmed">Terverifikasi</span>
                        @elseif($booking->status->value == 'cancelled')
                            <span class="status-pill status-cancelled">Dibatalkan</span>
                        @elseif($booking->status->value == 'rejected')
                            <span class="status-pill status-cancelled">Ditolak</span>
                        @elseif($booking->status->value == 'completed')
                            <span class="status-pill status-cancelled">Selesai</span>
                        @elseif($booking->status->value == 'expired')
                            <span class="status-pill status-cancelled">Kadaluarsa</span>
                        @else
                             <span class="status-pill status-waiting">{{ $booking->status->value }}</span>
                        @endif
                    </div>
                </td>
            </tr>
        </table>

        <!-- Customer & Schedule -->
        <table class="info-table">
            <tr>
                <td class="info-column">
                    <div class="section-title">Informasi Pelanggan</div>
                    
                    <div class="info-label">Nama</div>
                    <div class="info-value-large">{{ $booking->name }}</div>
                    
                    <div class="info-label">Kontak</div>
                    <div class="info-value">{{ $booking->phone }}</div>
                    
                    <div class="info-label">Tipe Customer</div>
                    <div class="info-value">Reguler</div>
                </td>
                <td style="width: 4%;"></td> <!-- Spacer -->
                <td class="info-column">
                    <div class="section-title">Rincian Jadwal</div>
                    
                    <table style="width: 100%;">
                        <tr>
                            <td class="info-label" style="padding-bottom: 8px;">Tanggal</td>
                            <td class="info-value" style="text-align: right; padding-bottom: 8px;">{{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}</td>
                        </tr>
                        <tr>
                            <td class="info-label" style="padding-bottom: 8px;">Jam</td>
                            <td class="info-value" style="text-align: right; padding-bottom: 8px;">{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }} WIB</td>
                        </tr>
                        <tr>
                            <td class="info-label">Barber</td>
                            <td class="info-value" style="text-align: right;">{{ $booking->barber->name }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Line Items -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Layanan</th>
                    <th style="width: 25%; text-align: center;">Durasi</th>
                    <th style="width: 25%; text-align: right;">Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="item-name">{{ $booking->service->name }}</div>
                        <div class="item-desc">Layanan cukur rambut profesional.</div>
                    </td>
                    <td style="text-align: center; color: #6b7280; font-size: 12px;">
                        ~45 Menit
                    </td>
                    <td class="item-price">
                        Rp {{ number_format($booking->service->price, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Totals -->
        <table class="totals-table">
            <tr>
                <td class="total-label">Subtotal</td>
                <td class="total-number">Rp {{ number_format($booking->service->price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="total-label">Biaya Layanan</td>
                <td class="total-number">Rp 0</td>
            </tr>
            <tr>
                <td colspan="2" style="height: 10px;"></td>
            </tr>
            <tr class="grand-total-row">
                <td class="grand-total-label">Total Tagihan</td>
                <td class="grand-total-number">Rp {{ number_format($booking->service->price, 0, ',', '.') }}</td>
            </tr>
            
            @if($booking->status == 'waiting_payment')
            <tr>
                <td colspan="2" style="height: 10px;"></td>
            </tr>
            <tr>
                <td class="total-label" style="color: #b45309; font-style: italic;">Sisa Pembayaran (DP 50%)</td>
                <td class="total-number" style="color: #b45309; font-weight: bold;">Rp {{ number_format($booking->service->price * 0.5, 0, ',', '.') }}</td>
            </tr>
            @endif
        </table>

        <!-- Helper Box -->
        <div class="helper-box">
            <div class="helper-title">Catatan</div>
            <div class="helper-text">
                Simpan dokumen ini sebagai bukti booking. Harap hadir tepat waktu sesuai jadwal yang telah ditentukan. 
                Jika Anda terlambat lebih dari 15 menit, booking mungkin akan dibatalkan otomatis oleh sistem.
            </div>
        </div>

    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-text">
            &copy; 2026 KUGA Barbershop. Design by PALCUMPING.GL</div>
    </div>

</body>
</html>