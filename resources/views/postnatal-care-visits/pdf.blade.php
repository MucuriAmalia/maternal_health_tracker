<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Postnatal Care Visit</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1, h2 { margin-bottom: 8px; }
        .section { margin-bottom: 18px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Postnatal Care Visit</h1>

    <div class="section">
        <h2>Mother Details</h2>
        <table>
            <tr>
                <th>Name</th>
                <td>{{ $postnatalCareVisit->mother->full_name ?? $postnatalCareVisit->mother->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Hospital Number</th>
                <td>{{ $postnatalCareVisit->mother->hospital_number ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Visit Details</h2>
        <table>
            <tr>
                <th>Visit Date</th>
                <td>{{ $postnatalCareVisit->visit_date ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Mother Condition</th>
                <td>{{ $postnatalCareVisit->mother_condition ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Baby Condition</th>
                <td>{{ $postnatalCareVisit->baby_condition ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Temperature</th>
                <td>{{ $postnatalCareVisit->temperature ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Blood Pressure</th>
                <td>{{ $postnatalCareVisit->blood_pressure ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>{{ $postnatalCareVisit->notes ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>
</body>
</html>