@php
    use Illuminate\Support\Facades\App;

    $lang = App::currentLocale();
    $dir = $lang == 'ar' ? 'rtl' : 'ltr';
@endphp

<!DOCTYPE html>
<html lang="en" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $employee ? $lang == 'ar' ? $employee->name_ar : $employee->name_en : ''  }} | {{ config('app.name') }} </title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/mkhazin/fav.png') }}">
    <!-- Bootstrap 5 RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Google Cairo Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            border-radius: .5rem;
        }

        .profile-section {
            background: #fff;
            padding: 2rem;
            border-radius: .5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .qr-canvas {
            max-width: 100px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row g-4">
        <!-- Left Column -->
        <div class="col-md-4">
            <div class="profile-section text-center shadow-lg">
                <img src="{{ asset('storage/' . $employee->image) }}" alt="Profile Image"
                     class="rounded-circle img-fluid mb-3" width="120">
                <h4>{{ $lang === 'ar' ? $employee->name_ar : $employee->name_en }}</h4>
                <p class="text-muted">{{ $lang === 'ar' ? $employee->designation_ar : $employee->designation_en }}</p>
                <p class="text-muted small mb-1">
                    {{ $lang === 'ar' ? $employee->branch->name_ar : $employee->branch->name_en }}
                </p>
                <div class="text-center mt-3">
                    <button onclick="downloadVCard()" class="btn btn-success">
                        <i class="fa fa-download"></i> {{ __('dashboard.save to contacts') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <img src="{{ asset('uploads/mkhazin/logo900.png') }}" width="100">
                        <canvas id="qr-code" class="qr-canvas m{{ $dir == 'rtl' ? 's' : 'e' }}-auto"></canvas>
                    </div>
                    <h5 class="mb-3">{{ __('dashboard.contact info') }}</h5>
                    <ul class="list-group">
                        @foreach($employee->contacts as $contact)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @if($contact['type'] === 'phone')
                                    <div>
                                        {{ ucfirst($contact['type']) }} ({{ $contact['label'] }})
                                        <i class="fa fa-phone mx-2"></i>
                                    </div>
                                    <span class="text-primary" dir="ltr">
                                        <a class="text-decoration-none" href="tel:{{ $contact['value'] }}">
                                            {{ $contact['value'] }}
                                        </a>
                                    </span>
                                @elseif($contact['type'] === 'email')
                                    <div>
                                        {{ ucfirst($contact['type']) }} ({{ $contact['label'] }})
                                        <i class="fa fa-envelope mx-2"></i>
                                    </div>
                                    <span class="text-primary">
                                        <a class="text-decoration-none" href="mailto:{{ $contact['value'] }}">
                                            {{ $contact['value'] }}
                                        </a>
                                    </span>
                                @elseif($contact['type'] === 'whatsapp')
                                    <div>
                                        {{ ucfirst($contact['type']) }} ({{ $contact['label'] }})
                                        <i class="fa fa-whatsapp mx-2"></i>
                                    </div>
                                    <span class="text-primary" dir="ltr">
                                        <a class="text-decoration-none" href="https://wa.me/{{ $contact['value'] }}" target="_blank">
                                            {{ $contact['value'] }}
                                        </a>
                                    </span>
                                @elseif($contact['type'] === 'website')
                                    <div>
                                        {{ ucfirst($contact['type']) }} ({{ $contact['label'] }})
                                        <i class="fa fa-globe mx-2"></i>
                                    </div>
                                    <span class="text-primary">
                                        <a class="text-decoration-none" href="{{ $contact['value'] }}" target="_blank">
                                            {{ $contact['value'] }}
                                        </a>
                                    </span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="text-end mt-3">
                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{ route('locale.setting', 'en') }}" style="color: black; text-decoration: none">English</a>
                    <span class="mx-1">|</span>
                    <a href="{{ route('locale.setting', 'ar') }}" style="color: black; text-decoration: none">العربية</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QR Code Library -->
<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
<script>
    const employee = @json($employee);
    const lang = '{{ app()->getLocale() }}';
    const contacts = employee.contacts;

    // Choose name and designation based on language
    const name = lang === 'ar' ? employee.name_ar : employee.name_en;
    const title = lang === 'ar' ? employee.designation_ar : employee.designation_en;

    // Full image URL
    const imageUrl = "{{ asset('storage/' . $employee->image) }}";

    // Start vCard
    let vCard = `BEGIN:VCARD\nVERSION:3.0\nFN:${name}\nTITLE:${title}\nPHOTO;VALUE=URI:${imageUrl}\n`;
    // Append contact data
    contacts.forEach(contact => {
        const value = contact.value;
        const label = contact.label;
        switch (contact.type) {
            case 'phone':
                vCard += `TEL;TYPE=${label}:${value}\n`;
                break;
            case 'email':
                vCard += `EMAIL;TYPE=${label}:${value}\n`;
                break;
            case 'whatsapp':
                vCard += `TEL;TYPE=${label}-whatsapp:${value}\n`;
                break;
            case 'website':
                vCard += `URL;TYPE=${label}:${value}\n`;
                break;
        }
    });
    vCard += `END:VCARD`;

    // Render QR Code
    QRCode.toCanvas(document.getElementById('qr-code'), vCard.replace(/\\n/g, "\n"), {width: 100}, function (error) {
        if (error) console.error(error);
    });

    // Download VCF
    function downloadVCard() {
        const blob = new Blob([vCard.replace(/\\n/g, "\n")], {type: 'text/vcard;charset=utf-8'});
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = `${name}.vcf`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
</body>
</html>
