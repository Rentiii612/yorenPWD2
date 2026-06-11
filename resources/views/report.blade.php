<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-5">

<h3>📊 Report Task</h3>

<table class="table table-bordered mt-3">
    <tr>
        <th>Tanggal</th>
        <th>Total Task</th>
    </tr>

    @foreach($data as $d)
    <tr>
        <td>{{ $d->due_date }}</td>
        <td>{{ $d->total }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>