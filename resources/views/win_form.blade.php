@php
    use Illuminate\Support\Facades\App;
    use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('content')
    <div class="contest-wrapper">
        <div class="contest-container">
            <!-- Header Section -->
            <div class="contest-header">
                <div class="header-content">
                    <div class="prize-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h1 class="contest-title">مسابقة آيفون 16</h1>
                    <p class="contest-subtitle">مع مخازن سوبرماركت يمكنك ربح جوال آيفون 16 الجديد!</p>
                </div>
                <div class="header-decoration">
                    <div class="sparkle"></div>
                    <div class="sparkle"></div>
                    <div class="sparkle"></div>
                </div>
            </div>

            <!-- Contest Rules -->
            <div class="rules-section">
                <div class="rules-header">
                    <i class="fas fa-list-check"></i>
                    <h3>شروط المشاركة</h3>
                </div>
                <div class="rules-grid">
                    <div class="rule-item">
                        <div class="rule-icon">
                            <i class="fab fa-tiktok"></i>
                        </div>
                        <p>يجب متابعة حسابنا على TikTok</p>
                    </div>
                    <div class="rule-item">
                        <div class="rule-icon">
                            <i class="fas fa-comment"></i>
                        </div>
                        <p>قم بالتعليق على المنشور المخصص</p>
                    </div>
                    <div class="rule-item">
                        <div class="rule-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        <p>ارفع صورة لتعليقك وأدخل بياناتك</p>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="progress-wrapper">
                <div class="progress-bar-custom">
                    <div class="progress-step active" id="progress-1">
                        <div class="step-circle">1</div>
                        <span>متابعة الحساب</span>
                    </div>
                    <div class="progress-line"></div>
                    <div class="progress-step" id="progress-2">
                        <div class="step-circle">2</div>
                        <span>التعليق</span>
                    </div>
                    <div class="progress-line"></div>
                    <div class="progress-step" id="progress-3">
                        <div class="step-circle">3</div>
                        <span>إرسال البيانات</span>
                    </div>
                </div>
            </div>

            <!-- Steps Content -->
            <div class="steps-container">
                <!-- Step 1 -->
                <div id="step-1" class="step-card active">
                    <div class="step-header">
                        <div class="step-number">1</div>
                        <h4>تابع حسابنا على TikTok</h4>
                    </div>
                    <div class="step-content">
                        <p>اضغط على الزر أدناه لزيارة حسابنا على TikTok ومتابعتنا</p>
                        <button class="btn-step btn-tiktok" onclick="openStep1()">
                            <i class="fab fa-tiktok"></i>
                            زيارة الحساب
                        </button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div id="step-2" class="step-card d-none">
                    <div class="step-header">
                        <div class="step-number">2</div>
                        <h4>علق على المنشور</h4>
                    </div>
                    <div class="step-content">
                        <p>اذهب إلى المنشور المخصص للمسابقة وقم بالتعليق عليه</p>
                        <button class="btn-step btn-comment" onclick="openStep2()">
                            <i class="fas fa-comment-dots"></i>
                            فتح المنشور
                        </button>
                    </div>
                </div>

                <!-- Step 3 -->
                <div id="step-3" class="step-card d-none">
                    <div class="step-header">
                        <div class="step-number">3</div>
                        <h4>أرسل صورة التعليق وبياناتك</h4>
                    </div>
                    <div class="step-content">
                        <form method="POST" enctype="multipart/form-data" class="contest-form">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user"></i>
                                    الاسم الكامل
                                </label>
                                <input type="text" name="name" id="name" class="form-input" required>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="form-label">
                                    <i class="fas fa-phone"></i>
                                    رقم الجوال
                                </label>
                                <input type="text" name="phone" id="phone" class="form-input" required>
                            </div>

                            <div class="form-group">
                                <label for="tiktok_user" class="form-label">
                                    <i class="fab fa-tiktok"></i>
                                    اسم المستخدم في TikTok
                                </label>
                                <input type="text" name="tiktok_user" id="tiktok_user" class="form-input" required>
                            </div>

                            <div class="form-group">
                                <label for="comment_image" class="form-label">
                                    <i class="fas fa-image"></i>
                                    صورة التعليق (لقطة شاشة)
                                </label>
                                <div class="file-upload-wrapper">
                                    <input type="file" name="comment_image" id="comment_image" class="file-input"
                                        accept="image/*" required>
                                    <div class="file-upload-area">
                                        <div class="upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <p class="upload-text" style="text-align: center;">اسحب الصورة هنا أو اضغط للاختيار
                                        </p>
                                        <p class="upload-hint" style="text-align: center;">PNG, JPG, GIF حتى 10MB</p>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane"></i>
                                إرسال المشاركة
                                <div class="btn-glow"></div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            direction: rtl;
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            min-height: 100vh;
            padding: 20px 0;
        }

        .contest-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .contest-container {
            max-width: 900px;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(20px);
            overflow: hidden;
            position: relative;
        }

        /* Header Styles */
        .contest-header {
            background: linear-gradient(135deg, #e12228, #ff4444, #e12228);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .prize-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        .contest-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .contest-subtitle {
            text-align: right;
            direction: rtl;
            font-size: 1.2rem;
            opacity: 0.9;
            font-weight: 500;
        }

        .header-decoration {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
        }

        .sparkle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: white;
            border-radius: 50%;
            animation: sparkle 3s infinite;
        }

        .sparkle:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .sparkle:nth-child(2) {
            top: 60%;
            right: 15%;
            animation-delay: 1s;
        }

        .sparkle:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 2s;
        }

        @keyframes sparkle {

            0%,
            100% {
                opacity: 0;
                transform: scale(0);
            }

            50% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Rules Section */
        .rules-section {
            padding: 30px;
            background: #f8f9fa;
        }

        .rules-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            color: black !important;
            direction: rtl;
        }

        .rules-header i {
            font-size: 1.5rem;
            text-align: right;
            direction: rtl;
            color: #000 !important;
        }

        .rules-header h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #000 !important;

        }

        .rules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .rule-item {
            background: white;
            text-align: right;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.3s ease;
        }

        .rule-item:hover {
            transform: translateY(-5px);
        }

        .rule-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #e12228, #ff4444);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        /* Progress Bar */
        .progress-wrapper {
            padding: 30px;
            background: white;
        }

        .progress-bar-custom {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            opacity: 0.5;
            transition: all 0.3s ease;
        }

        .progress-step.active {
            opacity: 1;
        }

        .step-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .progress-step.active .step-circle {
            background: linear-gradient(135deg, #e12228, #ff4444);
            color: white;
            transform: scale(1.1);
        }

        .progress-line {
            width: 80px;
            height: 3px;
            background: #e9ecef;
            border-radius: 2px;
        }

        /* Steps Content */
        .steps-container {
            padding: 30px;
        }

        .step-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .step-card.active {
            transform: scale(1.02);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .step-header {
            background: linear-gradient(135deg, #e12228, #c41e3a);
            color: white !important;
            padding: 25px 30px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .step-header h4 {
            color: white !important;

        }

        .step-number {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .step-content {
            padding: 30px;
        }

        .step-content p {
            margin-bottom: 25px;
            text-align: right;
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* Buttons */
        .btn-step {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-tiktok {
            background: linear-gradient(135deg, #e12228, #ff4444);
            color: white;
        }

        .btn-comment {
            background: linear-gradient(135deg, #e12228, #ff4444);
            color: white;
        }

        .btn-step:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        /* Form Styles */
        .contest-form {
            display: grid;
            gap: 25px;
        }

        .form-group {
            position: relative;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
            font-size: 1rem;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-input:focus {
            outline: none;
            border-color: #e12228;
            background: white;
            box-shadow: 0 0 0 3px rgba(225, 34, 40, 0.1);
        }

        /* File Upload */
        .file-upload-wrapper {
            position: relative;
        }

        .file-input {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }

        .file-upload-area {
            border: 3px dashed #e9ecef;
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .file-upload-area:hover {
            border-color: #e12228;
            background: rgba(225, 34, 40, 0.05);
        }

        .upload-icon {
            font-size: 3rem;
            color: #e12228;
            margin-bottom: 15px;
        }

        .upload-text {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .upload-hint {
            color: #666;
            font-size: 0.9rem;
        }

        /* Submit Button */
        .btn-submit {
            background: linear-gradient(135deg, #e12228, #ff4444);
            color: white;
            border: none;
            padding: 18px 40px;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: 0 auto;
            min-width: 250px;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(225, 34, 40, 0.4);
        }

        .btn-glow {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .btn-submit:hover .btn-glow {
            left: 100%;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .contest-title {
                font-size: 2rem;
            }

            .contest-subtitle {
                font-size: 1rem;
            }

            .rules-grid {
                grid-template-columns: 1fr;
            }

            .progress-bar-custom {
                flex-direction: column;
                gap: 15px;
            }

            .progress-line {
                width: 3px;
                height: 30px;
            }

            .step-header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
        }

        .d-none {
            display: none !important;
        }
    </style>

    {{-- JavaScript --}}
    <script>
        function openStep1() {
            window.open('https://www.tiktok.com/@your_tiktok_account', '_blank');
            document.getElementById('step-2').classList.remove('d-none');
            document.getElementById('progress-2').classList.add('active');
        }

        function openStep2() {
            window.open('https://www.tiktok.com/@your_tiktok_account/video/your_post_id', '_blank');
            document.getElementById('step-3').classList.remove('d-none');
            document.getElementById('progress-3').classList.add('active');
        }

        // File upload functionality
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.getElementById('comment_image');
            const uploadArea = document.querySelector('.file-upload-area');

            if (uploadArea && fileInput) {
                uploadArea.addEventListener('click', () => fileInput.click());

                fileInput.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        uploadArea.innerHTML = `
                                                                                                                                    <div class="upload-icon">
                                                                                                                                        <i class="fas fa-check-circle" style="color: #28a745;"></i>
                                                                                                                                    </div>
                                                                                                                                    <p class="upload-text" style="color: #28a745;">تم اختيار الملف: ${file.name}</p>
                                                                                                                                    <p class="upload-hint">اضغط لتغيير الملف</p>
                                                                                                                                `;
                    }
                });
            }
        });
    </script>
@endsection
