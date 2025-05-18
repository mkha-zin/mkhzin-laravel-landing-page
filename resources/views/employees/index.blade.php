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
    <!-- Bootstrap 5 RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Google Cairo Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
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
                    {{ __('dashboard.branch') }}:
                    {{ $lang === 'ar' ? $employee->branch->name_ar : $employee->branch->name_en }}
                </p>
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
                                {{ ucfirst($contact['type']) }} ({{ $contact['label'] }})
                                <span class="text-primary">{{ $contact['value'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="text-end mt-3">
                <button onclick="downloadVCard()" class="btn btn-success">
                    <i class="fa fa-download"></i> {{ __('dashboard.save to contacts') }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- QR Code Library -->
<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
<script>
    const employee = @json($employee);
    const contacts = employee.contacts;

    let vCard = `BEGIN:VCARD\nVERSION:3.0\nFN:${ employee.name_ar }\nTITLE:${ employee.designation_ar }\n`;
    contacts.forEach(contact => {
        if (contact.type === 'phone') {
            vCard += `TEL;TYPE=${contact.label}:${contact.value}\n`;
        } else if (contact.type === 'email') {
            vCard += `EMAIL;TYPE=${contact.label}:${contact.value}\n`;
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
        link.download = `${employee.name}.vcf`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
</body>
</html>
