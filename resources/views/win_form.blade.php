@php
    use Illuminate\Support\Facades\App;
    use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="form-container">
            <div class="competition-info">
                <p class="main-text">
                    مع مخازن سوبرماركت يمكنك ربح جوال آيفون 16، قم بتسجيل بياناتك ادناه واكمل شروط المسابقة
                    لتدخل السحب على الآيفون.
                </p>

                <div class="conditions-box">
                    <h3 class="conditions-title">شروط المسابقة:</h3>
                    <ul class="conditions-list">
                        <li>متابعة حسابنا على منصة التيك توك.</li>
                        <li>عمل اعجاب على منشور المسابقة.</li>
                        <li>التعليق على المنشور بعمل منشن لثلاثة من اصدقائك.</li>
                    </ul>
                </div>

                <p class="call-to-action">
                    لا تدع الفرصة تفوتك. سجل الأن
                </p>
            </div>
            <!-- Progress Indicator -->
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill"></div>
                </div>
                <div class="progress-steps">
                    <div class="step active" id="step1Indicator">1</div>
                    <div class="step" id="step2Indicator">2</div>
                </div>
            </div>

            <form id="tiktokForm" method="POST" action="" enctype="multipart/form-data">
                @csrf

                <!-- Step 1 -->
                <div class="form-step active" id="step1">
                    <div class="step-content">

                        <h2 class="step-title">تابع حسابنا على التيك توك</h2>
                        <div class="button-group">
                            <a href="https://www.tiktok.com/@example" target="_blank" class="btn btn-tiktok"
                                onclick="followTikTok()">
                                <i class="fab fa-tiktok"></i>
                                زيارة حساب تيك توك
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="form-step" id="step2">
                    <div class="step-content">
                        <h2 class="step-title">حط لايك وتعليق على المنشور </h2>

                        <div class="button-group">
                            <a href="https://www.tiktok.com/@example/video/123456789" target="_blank"
                                class="btn btn-tiktok">
                                <i class="fab fa-tiktok"></i>
                                زيارة المنشور
                            </a>
                        </div>

                        <div class="form-group">
                            <label for="screenshot" class="form-label">سكرين شوت من التعليق</label>
                            <div class="file-upload-area" onclick="document.getElementById('screenshot').click()">
                                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                <div class="upload-text">اختر صورة أو اسحبها هنا</div>
                                <div class="upload-hint">PNG, JPG, GIF حتى 10MB</div>
                                <div class="upload-animations">
                                    <i class="fas fa-sparkles"></i>
                                </div>
                                <input type="file" id="screenshot" name="screenshot" accept="image/*" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">رقم الجوال</label>
                            <input type="tel" id="phone" name="phone" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="tiktok_username" class="form-label">يوزر حسابك على التيك توك</label>
                            <input type="text" id="tiktok_username" name="tiktok_username" class="form-input" required>
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn btn-submit">حفظ</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            padding: 20px 0;
        }

        .form-container {
            max-width: 850px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(225, 34, 40, 0.3);
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .progress-container {
            padding: 35px;
            background: linear-gradient(135deg, #e12228 0%, #c41e3a 50%, #a01729 100%);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .progress-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .progress-bar {
            background: rgba(255, 255, 255, 0.25);
            height: 6px;
            border-radius: 3px;
            margin-bottom: 25px;
            overflow: hidden;
            position: relative;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .progress-fill {
            background: linear-gradient(90deg, #ffffff 0%, #fff3f3 50%, #ffffff 100%);
            height: 100%;
            width: 50%;
            border-radius: 3px;
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(255, 255, 255, 0.3);
        }

        .progress-steps {
            display: flex;
            justify-content: center;
            gap: 80px;
            position: relative;
            z-index: 2;
        }

        .step {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .step.active {
            background: white;
            color: #e12228;
            transform: scale(1.15);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.4);
            border-color: white;
        }

        .form-step {
            display: none;
            padding: 45px;
            min-height: 450px;
            position: relative;
        }

        .form-step.active {
            display: block;
            animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .step-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 35px;
            position: relative;
            background: linear-gradient(135deg, #e12228, #c41e3a);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 2px 4px rgba(225, 34, 40, 0.2);
        }

        .step-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #e12228, #ff6b6b);
            border-radius: 2px;
        }

        .button-group {
            text-align: center;
            margin-bottom: 35px;
        }

        .btn {
            display: inline-block;
            padding: 16px 35px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            margin: 8px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-tiktok {
            background: linear-gradient(135deg, #e12228, #ff6b6b, #e12228);
            background-size: 200% 200%;
            color: white !important;
            margin-bottom: 25px;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 8px 25px rgba(225, 34, 40, 0.3);
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .btn-tiktok:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 35px rgba(225, 34, 40, 0.4);
        }

        .btn-next,
        .btn-submit {
            background: linear-gradient(135deg, #e12228, #ff6b6b, #e12228);
            background-size: 200% 200%;
            color: white;
            width: 100%;
            box-shadow: 0 8px 25px rgba(225, 34, 40, 0.3);
            animation: gradientShift 4s ease infinite;
        }

        .btn-next:hover,
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(225, 34, 40, 0.4);
        }

        .btn-back {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            color: #6c757d;
            border: 2px solid #dee2e6;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #e9ecef, #dee2e6);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        /* RTL Support */
        body {
            direction: rtl;
        }

        .form-container,
        .form-step,
        .step-content,
        .form-group,
        .button-group {
            direction: rtl;
            text-align: right;
        }

        .step-title,
        .button-group {
            text-align: center;
        }

        .form-input {
            text-align: right;
            padding: 16px 20px;
        }

        .form-label {
            text-align: right;
        }

        .file-upload-area {
            direction: rtl;
        }

        .progress-steps {
            direction: rtl;
            /* Keep progress indicators LTR */
        }

        /* Required field styling */
        .form-label::after {
            content: ' *';
            color: #e12228;
            font-weight: bold;
        }

        .form-input:invalid {
            border-color: #dc3545;
        }

        .form-input:valid {
            border-color: #28a745;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 5px;
            display: none;
        }

        /* Enhanced image upload field */
        .file-upload-area {
            border: 3px dashed #e9ecef;
            border-radius: 20px;
            padding: 50px 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            color: #6c757d;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(248, 249, 250, 0.9) 100%);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 15px;
            direction: rtl;
        }

        .file-upload-area::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(225, 34, 40, 0.1), transparent);
            opacity: 0;
            transition: all 0.4s ease;
            animation: rotate 4s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .file-upload-area:hover {
            border-color: #e12228;
            background: linear-gradient(135deg, rgba(225, 34, 40, 0.05) 0%, rgba(255, 107, 107, 0.05) 100%);
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 40px rgba(225, 34, 40, 0.2);
        }

        .file-upload-area:hover::before {
            opacity: 1;
        }

        .file-upload-area.dragover {
            border-color: #e12228;
            background: linear-gradient(135deg, rgba(225, 34, 40, 0.1) 0%, rgba(255, 107, 107, 0.1) 100%);
            transform: scale(1.05);
        }

        .file-upload-area.file-selected {
            border-color: #28a745;
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(72, 187, 120, 0.1) 100%);
        }

        .upload-icon {
            font-size: 3.5rem;
            margin-bottom: 15px;
            color: #e12228;
            transition: all 0.3s ease;
        }

        .file-upload-area:hover .upload-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .upload-text {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .upload-hint {
            font-size: 0.9rem;
            color: #6c757d;
            opacity: 0.8;
        }

        .file-preview {
            display: none;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .file-preview.show {
            display: flex;
        }

        .preview-image {
            max-width: 150px;
            max-height: 150px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 3px solid #28a745;
        }

        .file-info {
            text-align: center;
        }

        .file-name {
            font-weight: 600;
            color: #28a745;
            margin-bottom: 5px;
        }

        .file-size {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .change-file-btn {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .change-file-btn:hover {
            background: linear-gradient(135deg, #5a6268, #3d4449);
            transform: translateY(-1px);
        }

        .upload-animations {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.2rem;
            color: #e12228;
            opacity: 0;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0;
                transform: scale(0.8);
            }

            50% {
                opacity: 1;
                transform: scale(1.2);
            }
        }

        .file-upload-area:hover .upload-animations {
            opacity: 1;
        }

        .file-upload-area input[type="file"] {
            display: none;
        }

        /* Competition info styling */
        .competition-info {
            max-width: 850px;
            background: linear-gradient(135deg, rgba(225, 34, 40, 0.05) 0%, rgba(255, 107, 107, 0.05) 100%);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 0px;
            border: 2px solid rgba(225, 34, 40, 0.1);
            backdrop-filter: blur(5px);
        }

        .main-text {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            text-align: center;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .conditions-box {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 25px;
            margin: 20px 0;
            border-right: 5px solid #e12228;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .conditions-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: black !important;
            margin-bottom: 15px;
            text-align: center;
        }

        .conditions-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .conditions-list li {
            font-size: 1.1rem;
            color: #2c3e50;
            margin-bottom: 12px;
            padding-right: 25px;
            position: relative;
            line-height: 1.6;
        }

        .conditions-list li::before {
            content: '✓';
            position: absolute;
            right: 0;
            color: #28a745;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .call-to-action {
            font-size: 1.3rem;
            font-weight: 700;
            color: #e12228;
            text-align: center;
            margin-top: 20px;
            text-shadow: 0 2px 4px rgba(225, 34, 40, 0.2);
        }
    </style>

    <script>
        let currentStep = 1;

        function followTikTok() {
            // Automatically advance to step 2 after a short delay
            setTimeout(function () {
                nextStep();
            }, 500);
        }

        function nextStep() {
            if (currentStep < 2) {
                document.getElementById('step' + currentStep).classList.remove('active');
                document.getElementById('step' + currentStep + 'Indicator').classList.remove('active');

                currentStep++;

                document.getElementById('step' + currentStep).classList.add('active');
                document.getElementById('step' + currentStep + 'Indicator').classList.add('active');

                updateProgressBar();
            }
        }

        function updateProgressBar() {
            const progressFill = document.getElementById('progressFill');
            const percentage = (currentStep / 2) * 100;
            progressFill.style.width = percentage + '%';
        }

        // Form validation
        document.getElementById('tiktokForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Validate required fields
            const screenshot = document.getElementById('screenshot').files[0];
            const phone = document.getElementById('phone').value.trim();
            const tiktokUsername = document.getElementById('tiktok_username').value.trim();

            let isValid = true;

            // Clear previous error messages
            document.querySelectorAll('.error-message').forEach(msg => msg.style.display = 'none');

            // Validate screenshot
            if (!screenshot) {
                showError('screenshot', 'يرجى اختيار صورة');
                isValid = false;
            }

            // Validate phone
            if (!phone) {
                showError('phone', 'يرجى إدخال رقم الجوال');
                isValid = false;
            } else if (phone.length < 10) {
                showError('phone', 'رقم الجوال يجب أن يكون 10 أرقام على الأقل');
                isValid = false;
            }

            // Validate TikTok username
            if (!tiktokUsername) {
                showError('tiktok_username', 'يرجى إدخال اسم المستخدم على تيك توك');
                isValid = false;
            }

            if (isValid) {
                // Submit form or show success message
                alert('تم إرسال الطلب بنجاح!');
                // this.submit(); // Uncomment to actually submit
            }
        });

        function showError(fieldName, message) {
            const field = document.getElementById(fieldName);
            let errorDiv = field.parentNode.querySelector('.error-message');

            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                field.parentNode.appendChild(errorDiv);
            }

            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
            field.style.borderColor = '#dc3545';
        }

        // Real-time validation
        document.getElementById('phone').addEventListener('input', function () {
            this.style.borderColor = this.value.trim() ? '#28a745' : '#e9ecef';
        });

        document.getElementById('tiktok_username').addEventListener('input', function () {
            this.style.borderColor = this.value.trim() ? '#28a745' : '#e9ecef';
        });

        // Enhanced file upload with preview
        document.getElementById('screenshot').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const uploadArea = document.querySelector('.file-upload-area');

            if (file) {
                uploadArea.classList.add('file-selected');

                // Create file reader for image preview
                const reader = new FileReader();
                reader.onload = function (e) {
                    const fileSize = (file.size / 1024 / 1024).toFixed(2); // Size in MB

                    uploadArea.innerHTML = `
                                                                                        <div class="file-preview show">
                                                                                            <img src="${e.target.result}" alt="Preview" class="preview-image">
                                                                                            <div class="file-info">
                                                                                                <div class="file-name">${file.name}</div>
                                                                                                <div class="file-size">${fileSize} ميجابايت</div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="upload-animations">
                                                                                            <i class="fas fa-check-circle"></i>
                                                                                        </div>
                                                                                    `;
                };
                reader.readAsDataURL(file);
            }
        });

        // Function to change file
        function changeFile() {
            const uploadArea = document.querySelector('.file-upload-area');
            uploadArea.classList.remove('file-selected');
            uploadArea.innerHTML = `
                                                                                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                                                                <div class="upload-text">اختر صورة أو اسحبها هنا</div>
                                                                                <div class="upload-hint">PNG, JPG, GIF حتى 10MB</div>
                                                                                <div class="upload-animations">
                                                                                    <i class="fas fa-sparkles"></i>
                                                                                </div>
                                                                                <input type="file" id="screenshot" name="screenshot" accept="image/*" required>
                                                                            `;

            // Re-attach event listener
            document.getElementById('screenshot').addEventListener('change', arguments.callee);
        }

        // Enhanced drag and drop functionality
        const uploadArea = document.querySelector('.file-upload-area');

        uploadArea.addEventListener('dragover', function (e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', function (e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', function (e) {
            e.preventDefault();
            this.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0 && files[0].type.startsWith('image/')) {
                document.getElementById('screenshot').files = files;
                document.getElementById('screenshot').dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection