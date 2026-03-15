<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delivery Record</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1, h2 { margin-bottom: 8px; }
        .section { margin-bottom: 18px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Delivery Record</h1>

    <div class="section">
        <h2>Mother Details</h2>
        <table>
            <tr>
                <th>Name</th>
                <td>{{ $delivery->mother->full_name ?? $delivery->mother->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Hospital Number</th>
                <td>{{ $delivery->mother->hospital_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $delivery->mother->phone ?? $delivery->mother->phone_number ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Delivery Details</h2>
        <table>
            <tr>
                <th>Delivery Date</th>
                <td>{{ $delivery->delivery_date ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Delivery Time</th>
                <td>{{ $delivery->delivery_time ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Delivery Type</th>
                <td>{{ $delivery->delivery_type ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Number of Babies</th>
                <td>{{ $delivery->number_of_babies ?? 1 }}</td>
            </tr>
            <tr>
                <th>Baby Gender</th>
                <td>{{ $delivery->baby_gender ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Baby Weight</th>
                <td>{{ $delivery->baby_weight ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Delivery Outcome</th>
                <td>{{ $delivery->delivery_outcome ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>{{ $delivery->notes ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>
</body>
</html>