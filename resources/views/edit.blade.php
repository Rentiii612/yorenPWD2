<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg,#ffe6f0,#efe0ff);
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <div class="card p-4">

        <h3>Edit Task</h3>

        <form action="/tasks/{{ $task->id }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="title" class="form-control mb-2" value="{{ $task->title }}">

            <textarea name="description" class="form-control mb-2">{{ $task->description }}</textarea>

            <input type="date" name="due_date" class="form-control mb-3" value="{{ $task->due_date }}">

            <button class="btn btn-primary">Update</button>
            <a href="/" class="btn btn-secondary">Kembali</a>

        </form>

    </div>

</div>

</body>
</html>