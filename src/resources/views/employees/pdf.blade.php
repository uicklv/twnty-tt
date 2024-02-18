<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Information</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h2>Employee Information #{{ $employee->id }}</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Salary</th>
        <th>Position</th>
        <th>Country</th>
    </tr>
    <tr>
        <td>{{ $employee->name }}</td>
        <td>{{ $employee->email }}</td>
        <td>${{ $employee->salary }}</td>
        <td>{{ $employee->position->name }}</td>
        <td>{{ $employee->country->name }}</td>
    </tr>
</table>

</body>
</html>
