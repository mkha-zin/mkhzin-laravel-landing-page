<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Special Offer Just for You!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-body {
            padding: 30px;
            text-align: center;
        }
        .email-body img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .unsubscribe {
            display: block;
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
        .unsubscribe a {
            color: #dc3545;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h2>🎁 Exclusive Offer for You!</h2>
    </div>
    <div class="email-body">
        <p>Click below to view this special deal:</p>

        <a href="{{ $offerUrl }}" target="_blank">
            <img src="{{ $offerImageUrl }}" alt="Offer Image">
        </a>

        <p class="unsubscribe">
            No longer want to receive these emails?
            <a href="{{ $unsubscribeUrl }}">Unsubscribe here</a>.
        </p>
    </div>
</div>
</body>
</html>
