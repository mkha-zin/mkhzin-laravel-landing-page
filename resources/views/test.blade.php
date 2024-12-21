<!DOCTYPE html>
<html lang="{{ app()->currentLocale() }}" dir="{{ app()->currentLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <title>Profile</title>
</head>
<body class="bg-light-subtle" style="font-family: Cairo, Sans-serif,serif">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 p-0 shadow-sm card rounded d-flex align-self-baseline">
            <img src="{{ asset('uploads/mkhazin/tmp/testpro.jpg') }}" class="rounded"
                 style="width: 100%; object-fit: cover !important;">
            <div class="row m-3">
                <div class="col-md-5 rounded border border-light p-2 d-flex align-items-center justify-content-center">
                    <img src=" {{ asset('uploads/mkhazin/logo300.png') }}" class="justify-self-center"
                         style="width: 100%; max-width: 200px; object-fit: cover !important;  ">
                </div>
                <div class="col-md-6">
                    <div class="row d-flex align-items-baseline">
                        <i class="col-1 fas fa-briefcase fa-lg text-center"></i>
                        <h5 class="col-10"> مدير فرع </h5>
                    </div>
                    <div class="row d-flex align-items-baseline">
                        <i class="col-1 fas fa-building fa-lg text-center"></i>
                        <p class="col-10">{{ config()->get('app.name') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 p-lg-3 p-md-3 p-sm-0">
            <div class="row d-flex align-items-baseline">
                <div class="col-1 text-center mx-2">
                    <i class="fas fa-user fa-2xl text-center"></i>
                </div>
                <div class="col-10">
                    <h1>محمد عبدالكريم</h1>
                </div>
            </div>
            <div class="card shadow-sm p-0 rounded mb-3">
                <div class="card-body">
                    <div class="row d-flex align-items-baseline">
                        <div class="col-1">
                            <i class="fas fa-info-circle fa-xl text-center"></i>
                        </div>
                        <div class="col-11">
                            <h5 class="card-title">نبذة عني</h5>
                            <p class="card-text">
                                للمهتمين قمنا بوضع نص لوريم إبسوم القياسي والمُستخدم منذ القرن الخامس عشر في الأسفل. وتم
                                أيضاً توفير الأقسام 1.10.32 و 1.10.33 من "حول أقاصي الخير والشر" (de Finibus Bonorum et
                                Malorum) لمؤلفه شيشيرون (Cicero) بصيغها الأصلية، مرفقة بالنسخ الإنكليزية لها والتي قام
                                بترجمتها هـ.راكهام (H. Rackham) في عام 1914.
                            </p>
                        </div>
                        {{--<div class="col-md-3">
                            <a class="btn btn-outline-danger w-100"
                               href="tel:+20123456789" role="button">
                                اتصل الان
                                <i class="fa fa-phone-square fa-lg mx-2 text-danger"></i>
                            </a>
                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="card shadow-sm p-0 rounded mb-3">
                <div class="card-body">
                    <div class="row d-flex align-items-center">
                        <div class="col-1 align-self-baseline">
                            <i class="fa fa-phone-square fa-xl text-center"></i>
                        </div>
                        <div class="col-8">
                            <h5 class="card-title">رقم الهاتف</h5>
                            <p class="card-text">+20123456789</p>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-outline-dark w-100"
                               href="tel:+20123456789" role="button">
                                اتصل الان
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm p-0 rounded mb-3">
                <div class="card-body">
                    <div class="row d-flex align-items-center">
                        <div class="col-1 align-self-baseline">
                            <i class="fa fa-envelope fa-xl text-center"></i>
                        </div>
                        <div class="col-8">
                            <h5 class="card-title">الإيميل</h5>
                            <p class="card-text">الشخصي: lTJf5@example.com</p>
                            <p class="card-text">العمل: lTJf5@example.com</p>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-outline-dark w-100"
                               href="mailto:test@example.com" role="button">
                                ارسل إيميل
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm p-0 rounded mb-3">
                <div class="card-body">
                    <div class="row d-flex align-items-center">
                        <div class="col-1 align-self-baseline">
                            <i class="fa fa-link fa-xl text-center"></i>
                        </div>
                        <div class="col-11">
                            <h5 class="card-title">مواقع التواصل الاجتماعي</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-10 p-0 my-2 px-1">
                                    <a class="btn btn-primary w-100" style="background-color: #3b5998;"
                                       href="#!" role="button">
                                        <i class="fab fa-facebook mx-2"></i>
                                        فيس بوك
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-10 p-0 my-2 px-1">
                                    <a class="btn btn-primary w-100" style="background-color: #55acee;"
                                       href="#!" role="button">
                                        <i class="fab fa-twitter mx-2"></i>
                                        منصة X
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-10 p-0 my-2 px-1">
                                    <a class="btn btn-primary w-100" style="background-color: #ac2bac;"
                                       href="#!" role="button">
                                        <i class="fab fa-instagram mx-2"></i>
                                        انستغرام
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-10 p-0 my-2 px-1">
                                    <a class="btn btn-primary w-100" style="background-color: #0077b5;"
                                       href="#!" role="button">
                                        <i class="fab fa-linkedin mx-2"></i>
                                        لينكد إن
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-0 flex justify-content-end align-items-end">
                <a href="{{ route('locale.setting', 'ar') }}" class="col-1">العربية</a>
                |
                <a href="{{ route('locale.setting', 'en') }}" class="col-1">English</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.umd.min.js">
</script>
</body>
</html>
