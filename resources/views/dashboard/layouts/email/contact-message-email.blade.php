<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
    <link rel="stylesheet" href="{{ session('css/contact-message-email.css') }}">
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
