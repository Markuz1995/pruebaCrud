<!DOCTYPE html>
<html>
<head>
    <title>Reporte de usuarios por país</title>
</head>
<body>
<h1>Reporte de usuarios por país</h1>
<table>
    <thead>
    <tr>
        <th>País</th>
        <th>Número de usuarios</th>
    </tr>
    </thead>
    <tbody>
    @foreach($usersByCountry as $user)
        <tr>
            <td>{{ $user->country }}</td>
            <td>{{ $user->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
