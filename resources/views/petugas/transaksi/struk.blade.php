<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Struk #{{ $transaksi->id }}</title>
    <style>
        @page {
            margin: 0;
            size: 58mm auto;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            width: 58mm;
            padding: 10px;
            background: white;
            color: #000;
            font-size: 10px;
        }

        /* Branding Section */
        .brand {
            text-align: center;
            margin-bottom: 15px;
        }

        .brand .logo {
            font-size: 16px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 2px solid black;
            display: inline-block;
            margin-bottom: 4px;
        }

        .brand p {
            font-size: 8px;
            font-style: italic;
            color: #333;
        }

        /* Divider Modern */
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
            position: relative;
        }

        /* Detail Section */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        .info-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .label {
            font-size: 8px;
            color: #555;
            text-transform: uppercase;
            font-weight: bold;
            width: 40%;
        }

        .value {
            font-size: 10px;
            font-weight: bold;
            text-align: right;
            width: 60%;
        }

        /* Highlight Plat Nomor */
        .plate-box {
            background: #000;
            color: #fff;
            text-align: center;
            padding: 5px;
            margin: 10px 0;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* Payment Section */
        .payment-box {
            margin-top: 10px;
            padding: 10px 0;
            border-top: 1px solid black;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            font-weight: 900;
        }

        .total-label {
            letter-spacing: 1px;
        }

        /* Footer & QR */
        .footer {
            text-align: center;
            margin-top: 15px;
        }

        .qr-placeholder {
            width: 50px;
            height: 50px;
            border: 1px solid #ccc;
            margin: 10px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 6px;
            color: #999;
        }

        .thanks {
            font-weight: bold;
            font-size: 9px;
            margin-bottom: 2px;
        }

        .web-info {
            font-size: 7px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="brand">
        <div class="logo">PARK-IT PRO</div>
        <p>Solusi Parkir Modern & Aman</p>
    </div>

    <div class="info-table">
        <table style="width: 100%;">
            <tr>
                <td class="label">No. Trans</td>
                <td class="value">#{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td class="label">Petugas</td>
                <td class="value">{{ strtoupper($transaksi->user->name) }}</td>
            </tr>
        </table>
    </div>

    <div class="divider"></div>

    <div class="plate-box">
        {{ $transaksi->kendaraan->plat_nomor }}
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Tipe</td>
            <td class="value">{{ ucfirst($transaksi->kendaraan->jenis_kendaraan) }}</td>
        </tr>
        <tr>
            <td class="label">Area</td>
            <td class="value">{{ $transaksi->area->nama_area }}</td>
        </tr>
        <tr>
            <td class="label">Masuk</td>
            <td class="value">{{ $transaksi->waktu_masuk->format('d/m/y H:i') }}</td>
        </tr>
        <tr>
            <td class="label">Keluar</td>
            <td class="value">{{ $transaksi->waktu_keluar ? $transaksi->waktu_keluar->format('d/m/y H:i') : '-' }}</td>
        </tr>
        <tr>
            <td class="label">Durasi</td>
            <td class="value">{{ $transaksi->durasi_jam ?? '0' }} Jam</td>
        </tr>
    </table>

    <div class="payment-box">
        <div class="total-row">
            <span class="total-label">TOTAL</span>
            <span class="total-value">Rp {{ number_format($transaksi->biaya_total, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="footer">
        <p class="thanks">-- TERIMA KASIH --</p>
        <p style="font-size: 8px;">Semoga Selamat Sampai Tujuan</p>

        {{-- Simulasi QR Code --}}
        <div class="qr-placeholder">
            VERIFIED<br>SYSTEM
        </div>

        <p class="web-info">Dicetak: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>

</html>