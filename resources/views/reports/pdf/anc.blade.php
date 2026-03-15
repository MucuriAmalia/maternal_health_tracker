<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ANC Attendance Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th {
            background: #f2f2f2;
            padding: 8px;
            text-align: left;
        }

        td {
            padding: 6px;
        }
    </style>
</head>

<body>

<h1>ANC Attendance Report</h1>

<p>
Start Date: {{ $start ?? 'N/A' }} <br>
End Date: {{ $end ?? 'N/A' }}
</p>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Mother</th>
            <th>Visit Date</th>
            <th>Gestation Weeks</th>
            <th>Blood Pressure</th>
            <th>Weight</th>
        </tr>
    </thead>

    <tbody>
        @foreach($visits as $index => $visit)
        <tr>
            <td>{{ $index + 1 }}</td>

            <td>
                {{ $visit->mother->full_name ?? $visit->mother->name ?? 'N/A' }}
            </td>

            <td>
                {{ $visit->visit_date }}
            </td>

            <td>
                {{ $visit->gestation_weeks ?? 'N/A' }}
            </td>

            <td>
                {{ $visit->blood_pressure ?? 'N/A' }}
            </td>

            <td>
                {{ $visit->weight ?? 'N/A' }}
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

</body>
</html>