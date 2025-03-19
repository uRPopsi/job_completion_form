<!DOCTYPE html>
<html>
<head>
    <title>Job Completion Form</title>
    <style>
        body {
            font-size: 14px;
            max-width: 768px; /* Equivalent to Tailwind's max-w-xl */
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <!-- Logo -->
    <img src="{{ public_path('images/pgis_logo.png') }}" alt="Pgis_Logo"
         style="width: 13rem; object-fit: contain; display: block; align-self: center; margin: 3rem auto;" />

    <!-- Title -->
    <h2 style="text-align: center; color: #ef4444; font-size: 24px; font-weight: 600; margin-top: 3rem;">
        PGIS COMPLETION REPORT
    </h2>

    <!-- Client Info -->
    <p style="margin-top: 1.25rem;"><strong>Client:</strong> {{ $client ?? '' }}</p>
    <p><strong>Project:</strong> {{ $project ?? '' }}</p>
    <p><strong>PO:</strong> {{ $po ?? '' }}</p>
    <p><strong>Status:</strong> {{ $status ?? '' }}</p>
    <p><strong>Completion Date:</strong> {{ $completion_date ?? '' }}</p>
    <p style="margin-bottom: 0.5rem;"><strong>Invoice:</strong> {{ $invoice ?? '' }}</p>

    <!-- Table -->
    <table style="margin: 1rem 0;">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Item/Service Code</th>
                <th>Description</th>
                <th>Required Quantity</th>
                <th>Supplied Quantity</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item['no'] }}</td>
                    <td>{{ $item['code'] }}</td>
                    <td>{{ $item['description'] }}</td>
                    <td>{{ $item['required_quantity'] }}</td>
                    <td>{{ $item['supplied_quantity'] }}</td>
                    <td>{{ $item['remark'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Watermark Logo -->
    <img src="{{ public_path('images/pgis_logo.png') }}" alt="Pgis_Logo"
         style="position: fixed; top: 50%; left: 45%; transform: translate(-50%, -50%); 
                width: 85%; object-fit: cover; opacity: 0.6; z-index: -50;" />

    <!-- Footer Message -->
    <div style="position: absolute; text-align: center; bottom: 0%;">
        <p style="font-size: 14px; line-height: 1.5;">
            Thank you for choosing PGIS for your technical and operational requirements. Our team is 
            dedicated to providing ongoing support for any future needs, ensuring quality, efficiency, and 
            reliability across all services. Please do not hesitate to reach out for further assistance or follow-up requests.
        </p>
        
        <p style="font-size: 12px; font-weight: 600; margin-top: 6rem;">
            Eleganza Industrial Complex<br>
            2, Billings Way, Off Mobolaji Johnson Road, Oregun, Ikeja, Lagos<br>
            +234-8098587818, +234-8067945449, +234-9139375316<br>
            <a href="http://www.preciousgateintegrated.com" style="color: #000; text-decoration: none;">www.preciousgateintegrated.com</a> || 
            <a href="mailto:info@preciousgateintegrated.com" style="color: #000; text-decoration: none;">info@preciousgateintegrated.com</a>
        </p>  
    </div>  
</body>
</html>
