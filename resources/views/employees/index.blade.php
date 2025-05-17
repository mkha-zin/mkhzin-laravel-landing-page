<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body d-flex align-items-center">
            <img src="{{ asset('storage/' . $employee->image) }}" alt="Profile Image" class="rounded-circle me-4" width="100">
            <div>
                <h4>{{ $employee->name }}</h4>
                <p class="mb-0 text-muted">{{ $employee->designation }}</p>
                <p class="text-muted small">Branch ID: {{ $employee->branch_id }}</p>
            </div>
        </div>
    </div>

    <div class="card mt-3 shadow">
        <div class="card-body">
            <h5>Contact Information</h5>
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
            Save to Contacts
        </button>
    </div>
</div>

<script>
    function downloadVCard() {
        const employee = @json($employee);
        const contacts = employee.contacts;

        let vCard = `BEGIN:VCARD\nVERSION:3.0\n`;
        vCard += `FN:${employee.name_ar}\n`;
        vCard += `TITLE:${employee.designation_ar}\n`;

        contacts.forEach(contact => {
            if (contact.type === 'phone') {
                vCard += `TEL;TYPE=${contact.label}:${contact.value}\n`;
            } else if (contact.type === 'email') {
                vCard += `EMAIL;TYPE=${contact.label}:${contact.value}\n`;
            }
        });

        vCard += `END:VCARD`;

        const blob = new Blob([vCard], { type: 'text/vcard;charset=utf-8' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = `${employee.name}.vcf`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
