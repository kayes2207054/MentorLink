import os

fixes = [
    {
        'file': 'resources/views/admin/bookings/index.blade.php',
        'replace': [
            ('<thead class="table-light">', '<thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">'),
            ('{{ $bookings->links() }}', "{{ $bookings->links('pagination::bootstrap-5') }}")
        ]
    },
    {
        'file': 'resources/views/admin/mentorship-requests/index.blade.php',
        'replace': [
            ('<thead class="table-light">', '<thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">'),
            ('{{ $requests->links() }}', "{{ $requests->links('pagination::bootstrap-5') }}")
        ]
    },
    {
        'file': 'resources/views/mentor/bookings/index.blade.php',
        'replace': [
            ('<thead class="table-light">', '<thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">'),
            ('{{ $bookings->links() }}', "{{ $bookings->links('pagination::bootstrap-5') }}")
        ]
    },
    {
        'file': 'resources/views/mentor/mentorship-requests/index.blade.php',
        'replace': [
            ('<thead class="table-light">', '<thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">'),
            ('{{ $requests->links() }}', "{{ $requests->links('pagination::bootstrap-5') }}")
        ]
    },
    {
        'file': 'resources/views/student/bookings/index.blade.php',
        'replace': [
            ('<thead class="table-light">', '<thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">'),
            ('{{ $bookings->links() }}', "{{ $bookings->links('pagination::bootstrap-5') }}")
        ]
    },
    {
        'file': 'resources/views/student/mentorship-requests/index.blade.php',
        'replace': [
            ('<thead class="table-light">', '<thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">'),
            ('{{ $requests->links() }}', "{{ $requests->links('pagination::bootstrap-5') }}")
        ]
    },
    {
        'file': 'resources/views/admin/mentors/index.blade.php',
        'replace': [
            ('{{ $mentors->links() }}', "{{ $mentors->links('pagination::bootstrap-5') }}")
        ]
    },
    {
        'file': 'resources/views/mentor/availabilities/index.blade.php',
        'replace': [
            ('<thead>', '<thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">')
        ]
    },
    {
        'file': 'resources/views/student/dashboard.blade.php',
        'replace': [
            ('<thead class="table-light">', '<thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">')
        ]
    }
]

for task in fixes:
    path = task['file']
    if os.path.exists(path):
        with open(path, 'r', encoding='utf-8') as f:
            content = f.read()
        
        for old, new in task['replace']:
            content = content.replace(old, new)
            
        with open(path, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f'Updated {path}')
    else:
        print(f'File not found: {path}')
