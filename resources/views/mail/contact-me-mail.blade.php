<!-- resources/views/emails/contact-form.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #2d3748;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
        }
        .message-container {
            background-color: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .message-content {
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .meta {
            font-size: 0.8em;
            color: #718096;
            margin-top: 20px;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <h1>New Contact Form Submission</h1>

    <p>You have received a new message through your website contact form.</p>

    <div class="message-container">
        <div class="field">
            <span class="field-label">Name:</span>
            {{ $data['name'] }}
        </div>

        <div class="field">
            <span class="field-label">Email:</span>
            {{ $data['email'] }}
        </div>

        <div class="field">
            <span class="field-label">Message:</span>
            <div class="message-content">{{ $data['message'] }}</div>
        </div>

        <div class="meta">
            <div>Message ID: {{ $data['message_id'] }}</div>
            <div>Date: {{ now()->format('F j, Y, g:i a') }}</div>
            <div>IP: {{ $data['ip'] }}</div>
        </div>
    </div>

    <p>This is an automated message. Please do not reply directly to this email.</p>
</body>
</html>
