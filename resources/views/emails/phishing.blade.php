<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: #1a73e8;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            color: white;
            margin: 0;
            font-size: 24px;
        }
        .body {
            padding: 40px 30px;
            color: #333;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            background: #1a73e8;
            color: white;
            padding: 14px 32px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            background: #f8f8f8;
            padding: 20px 30px;
            text-align: center;
            color: #999;
            font-size: 12px;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <h1>{{ $campaign->sender_name }}</h1>
        </div>

        <div class="body">
            <p>Dear {{ $recipient->name }},</p>

            <p>{{ $campaign->body }}</p>

            <center>
                <a href="{{ $trackingUrl }}" class="btn">
                    Click Here To Verify
                </a>
            </center>

            <p>If you did not request this, please ignore this email.</p>

            <p>Regards,<br>{{ $campaign->sender_name }}</p>
        </div>

        <div class="footer">
            <p>This email was sent by {{ $campaign->sender_email }}</p>
        </div>

    </div>
</body>
</html>