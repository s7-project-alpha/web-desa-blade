{{-- resources/views/emails/kontak-message.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #059669;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
        }
        .footer {
            background-color: #374151;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 0 0 8px 8px;
            font-size: 12px;
        }
        .info-row {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .label {
            font-weight: bold;
            color: #059669;
            display: inline-block;
            width: 120px;
        }
        .message-box {
            background-color: white;
            padding: 20px;
            border-left: 4px solid #059669;
            margin-top: 20px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pesan Kontak Baru</h1>
        <p>Website Desa Tanjung Selamat</p>
    </div>

    <div class="content">
        <p>Anda menerima pesan baru melalui form kontak website Desa Tanjung Selamat:</p>

        <div class="info-row">
            <span class="label">Nama:</span>
            {{ $kontakMessage->nama }}
        </div>

        <div class="info-row">
            <span class="label">Email:</span>
            <a href="mailto:{{ $kontakMessage->email }}">{{ $kontakMessage->email }}</a>
        </div>

        @if($kontakMessage->telepon)
        <div class="info-row">
            <span class="label">Telepon:</span>
            {{ $kontakMessage->telepon }}
        </div>
        @endif

        <div class="info-row">
            <span class="label">Subjek:</span>
            {{ $kontakMessage->subjek }}
        </div>

        <div class="info-row">
            <span class="label">Waktu:</span>
            {{ $kontakMessage->created_at->format('d F Y, H:i') }} WIB
        </div>

        <div class="message-box">
            <h3 style="margin-top: 0; color: #059669;">Pesan:</h3>
            <p style="margin-bottom: 0; white-space: pre-line;">{{ $kontakMessage->pesan }}</p>
        </div>

        <div style="margin-top: 30px; padding: 15px; background-color: #eff6ff; border-radius: 4px;">
            <p style="margin: 0; font-size: 14px; color: #1e40af;">
                <strong>Informasi Tambahan:</strong><br>
                IP Address: {{ $kontakMessage->ip_address }}<br>
                User Agent: {{ Str::limit($kontakMessage->user_agent, 100) }}
            </p>
        </div>
    </div>

    <div class="footer">
        <p>Email ini dikirim otomatis dari sistem Website Desa Tanjung Selamat.<br>
        Harap jangan membalas email ini secara langsung.</p>
        <p>Untuk membalas pesan, gunakan email pengirim: {{ $kontakMessage->email }}</p>
    </div>
</body>
</html>
