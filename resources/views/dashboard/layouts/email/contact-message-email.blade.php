<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9fafb;
            color: #111827;
            padding: 2rem;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .header {
            font-size: 1.25rem;
            font-weight: 600;
            color: #0e7490;
            margin-bottom: 1rem;
        }

        .content p {
            margin-bottom: 0.75rem;
            line-height: 1.6;
        }

        .footer {
            margin-top: 2rem;
            font-size: 0.85rem;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            📥 New Contact Message Received
        </div>

        <div class="content">
            <p><strong>From:</strong> {{ $email }}</p>

            @if (!empty($messageContent))
                <p><strong>Message:</strong><br>{{ $messageContent }}</p>
            @else
                <p><strong>Message:</strong><br><em>No message provided.</em></p>
            @endif
        </div>

        <div class="footer">
            This message was sent from your portfolio contact form.
        </div>
    </div>
</body>

</html>
