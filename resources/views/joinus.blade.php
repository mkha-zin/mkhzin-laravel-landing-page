<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>التقديم على قسم التسويق والتطوير</title>    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { background-color: #efe7e7; }
        .container { max-width: 680px; background: #fff; padding: 20px; border-radius: 8px; margin-top: 40px; margin-bottom: 40px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .company-logo { width: 80px; }
        .social-link-group { display: flex; gap: 10px; margin-bottom: 10px; }
        .remove-btn { width: 40px; background: red; color: white; border: none; padding: 2px 8px; cursor: pointer; }
    </style>
</head>
<body style="background-image: url({{ asset('uploads/mkhazin/join_form_bg.svg') }}); font-family: Cairo, sans-serif !important;">

<div class="container">
    <!-- Header Section -->
    <div class="header">
        <div>
            <h3 class="fw-bold">مرحبًا بك في شركة مخازن المملكة العالمية</h3>
            <p class="text-muted">يرجى تعبئة النموذج التالي للانضمام إلى فريق التسويق والتطوير لدينا.</p>
        </div>
        <img src="{{ asset('uploads/mkhazin/fav.png') }}" alt="Logo" class="company-logo">
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Application Form -->
    <form action="{{ route('joinus') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label class="form-label">الاسم</label>
            <p class="text-muted">اكتب اسمك الثلاثي</p>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label class="form-label">رقم الهاتف</label>
            <p class="text-muted">اكتب رقمًا سعوديًا صحيحًا</p>
            <div class="input-group">
                <input type="text" name="phone" style="border-radius: 0 6px 6px 0 " class="form-control @error('phone') is-invalid @enderror text-start" value="{{ old('phone') }}">
                <span class="input-group-text" style="border-radius:  6px  0 0 6px ">+966</span>
            </div>
            @error('phone')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Address -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">المدينة</label>
                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}">
                @error('city')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">الحي</label>
                <input type="text" name="district" class="form-control @error('district') is-invalid @enderror" value="{{ old('district') }}">
                @error('district')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Social Media Profiles -->
        <div class="mb-3">
            <label class="form-label">روابط وسائل التواصل</label>
            <p class="text-muted">يجب إضافة رابط واحد على الأقل</p>

            <div id="social-links-container">
                <div class="input-group mb-2 social-link">
                    <input type="url" name="social_profiles[]" style="border-radius: 0 6px 6px 0 " class="form-control @error('social_profiles') is-invalid @enderror" placeholder="أدخل رابط الحساب">
                    <button type="button" class="btn btn-danger remove-link d-none" style="width: 45px; border-radius:  6px  0 0 6px ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="button" id="add-social-link" class="btn btn-secondary">إضافة رابط</button>

            @error('social_profiles')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <!-- CV -->
            <div class="col-md-6 mb-3">
                <label class="form-label">السيرة الذاتية (إن وجدت)</label>
                <input type="file" name="cv" class="form-control @error('cv') is-invalid @enderror">
                @error('cv')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <p class="text-muted">يجب ألا يتجاوز 10MB، ويسمح فقط بملفات PDF</p>
            </div>
            <!-- License (Optional) -->
            <div class="col-md-6 mb-3">
                <label class="form-label">صورة الترخيص (إن وجدت)</label>
                <input type="file" name="license" class="form-control @error('license') is-invalid @enderror">
                @error('license')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">وصفك الشخصي</label>
            <p class="text-muted">تحدث بحرية عن نفسك، طريقة عملك مع العملاء، الأسعار التي تتقاضاها، نوع المحتوى الذي يمكنك إنشاؤه، ولماذا يجب أن نوظفك.</p>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn w-100" style="background: #cd0000; color: white">إرسال الطلب</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const addButton = document.getElementById("add-social-link");
        const container = document.getElementById("social-links-container");

        addButton.addEventListener("click", function () {
            const div = document.createElement("div");
            div.classList.add("input-group", "mb-2", "social-link");

            div.innerHTML = `
                <input type="url" name="social_profiles[]" style="border-radius: 0 6px 6px 0 " class="form-control" placeholder="أدخل رابط الحساب">
                <button type="button" class="btn btn-danger remove-link" style="width: 45px; border-radius:  6px  0 0 6px ">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
</button>
            `;

            container.appendChild(div);
            updateRemoveButtons();
        });

        container.addEventListener("click", function (event) {
            if (event.target.classList.contains("remove-link")) {
                event.target.parentElement.remove();
                updateRemoveButtons();
            }
        });

        function updateRemoveButtons() {
            const removeButtons = document.querySelectorAll(".remove-link");
            removeButtons.forEach(btn => btn.classList.remove("d-none"));
            if (removeButtons.length === 1) removeButtons[0].classList.add("d-none");
        }

        updateRemoveButtons();
    });

</script>
</body>
</html>
