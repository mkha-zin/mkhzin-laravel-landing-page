<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تخفيضات نهاية العام الكبرى! لا تفوتها!</title>
    <style>
        body {
            font-family: 'Cairo', Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
            direction: rtl;
            text-align: right;
        }

        .email-container {
            max-width: 800px;
            margin: auto;
            background: #ffffff;
            border-radius: 12px;
            /* Softer corners */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            /* Softer shadow */
            overflow: hidden;
        }

        .email-header {
            padding: 0;
            text-align: center;
            line-height: 0;
        }

        .email-header img {
            width: 100%;
            height: auto;
        }

        .email-body {
            padding: 30px;
            text-align: center;
        }

        .intro-text {
            padding-bottom: 25px;
            margin-bottom: 25px;
        }

        .intro-text h3 {
            font-size: 24px;
            color: #333;
            font-weight: 700;
            margin: 0 0 10px 0;
        }

        .intro-text p {
            font-size: 16px;
            color: #555;
            line-height: 1.7;
            margin: 0;
        }

        .offer-card {
            border: none;
            /* Remove border */
            background-color: #fdfdfd;
            border-radius: 10px;
            padding: 0px;
            margin-bottom: 25px;
            text-align: center;
            /* box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07); */
            /* Subtle shadow for card */
        }

        .offer-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            /* Match card radius */
            margin-bottom: 0px;
        }

        .button {
            display: inline-block;
            background-color: #28a745;
            /* Green for action */
            color: #ffffff !important;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
        }

        .button:hover {
            background-color: #218838;
        }

        .main-button {
            background: linear-gradient(135deg, #e22128, #c01c22);
            /* Identity red gradient for CTA */
            color: #ffffff !important;
            display: block;
            width: 100%;
            margin: 0;
            padding: 15px;
            font-size: 20px;
            /* Larger font */
            font-weight: 700;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            border: none;
            text-decoration: none;
        }

        .main-button:hover {
            background: linear-gradient(135deg, #c01c22, #a0171c);
            /* Darker red on hover */
        }

        .unsubscribe {
            display: block;
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        .unsubscribe a {
            color: #e22128;
            text-decoration: none;
            font-weight: bold;
        }

        .email-footer {
            background-color: #f8f9fa;
            color: #6c757d;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #dee2e6;
        }

        .footer-logo img {
            max-width: 150px;
            margin-bottom: 15px;
        }

        .social-icons {
            margin-bottom: 15px;
        }

        .social-icons a {
            display: inline-block;
            margin: 0 8px;
        }

        .social-icons img {
            width: 32px;
            height: 32px;
        }

        .footer-text {
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{ $offerImageUrl }}"
                alt="{{ $emailSubject }}">
        </div>

        <div class="email-body">
            <div class="intro-text">
                <h3>{{ $emailSubject }}</h3>
                <p>
                    {{ \Filament\Support\Markdown::block($offerDescription) }}
                </p>
            </div>
            <a href="{{ $offerUrl }}" target="_blank" class="button main-button">شاهد العرض</a>

        </div>
        <div class="email-footer">
            <div class="footer-logo">
                <a href="#" target="_blank"><img src="{{ asset('uploads/mkhazin/logo900.png') }}"
                        alt="شعار مخازن العالمية"></a>
            </div>
            <div class="social-icons">
                <a href="#" target="_blank"><img src="{{ asset('images/icons/facebook.png') }}" alt="Facebook"></a>
                <a href="#" target="_blank"><img src="{{ asset('images/icons/twitter.png') }}" alt="Twitter"></a>
                <a href="#" target="_blank"><img src="{{ asset('images/icons/instagram.png') }}" alt="Instagram"></a>
                <a href="#" target="_blank"><img src="{{ asset('images/icons/snapchat.png') }}" alt="Snapchat"></a>
                <a href="#" target="_blank"><img src="{{ asset('images/icons/tik-tok.png') }}" alt="TikTok"></a>
                <a href="#" target="_blank"><img src="{{ asset('images/icons/whatsapp.png') }}" alt="WhatsApp"></a>
            </div>
            <p class="footer-text">
                © {{ date('Y') }} مخازن العالمية. جميع الحقوق محفوظة.<br>
            </p>
        </div>
        <p class="unsubscribe">
            إذا كنت لا ترغب في استقبال هذه الرسائل مجدداً، يمكنك
            <a href="{{ $unsubscribeUrl }}">إلغاء الاشتراك</a>.
        </p>
    </div>
</body>

</html>
