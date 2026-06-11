<!DOCTYPE html>
<html>
<head>
    <title>To-Do List APP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ffe6f0, #efe0ff);
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        .btn-pink {
            background: #ff4da6;
            color: white;
        }

        .btn-purple {
            background: #7a3cff;
            color: white;
        }

        .badge-soft {
            background: #f3e6ff;
            color: #6a1bb9;
            padding: 5px 10px;
            border-radius: 10px;
        }

        .title {
            font-weight: 600;
            color: #6a1bb9;
        }
    </style>
</head>

<body>

<div class="container py-5">

    <h2 class="text-center title mb-4">🌸 APK List Tugas Yoren🌸</h2>

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- FORM TAMBAH -->
    <div class="card p-4 mb-4">
        <h5>➕ Tambah Task</h5>

        <form action="/tasks" method="POST">
            @csrf

            <input type="text" name="title" class="form-control mb-2" placeholder="Judul" required>

            <textarea name="description" class="form-control mb-2" placeholder="Deskripsi"></textarea>

            <input type="date" name="due_date" class="form-control mb-3" required>

            <button class="btn btn-pink w-100">Tambah</button>
        </form>
    </div>

    <!-- LIST TASK -->
    @foreach($tasks as $task)

    <div class="card p-3 mb-3">

        <h5>{{ $task->title }}</h5>
        <small>{{ $task->description }}</small><br>

        <span class="badge-soft">📅 {{ $task->due_date }}</span>

        <div class="mt-2">
            @if($task->completed)
                <span class="badge bg-success">Selesai</span>
            @else
                <span class="badge bg-warning text-dark">Belum</span>
            @endif
        </div>

        <div class="mt-3 d-flex gap-2">

            @if(!$task->completed)

            <form action="/tasks/{{ $task->id }}/complete" method="POST">
                @csrf
                @method('PATCH')
                <button class="btn btn-sm btn-purple">✔ Selesai</button>
            </form>

            <form action="/tasks/{{ $task->id }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="title" value="{{ $task->title }}">
                <input type="hidden" name="description" value="{{ $task->description }}">
                <input type="hidden" name="due_date" value="{{ $task->due_date }}">

                <button onclick="editTask(this.form)" type="button" class="btn btn-sm btn-primary">
                    Edit
                </button>
            </form>

            <form action="/tasks/{{ $task->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Hapus</button>
            </form>

            @else
                <small class="text-muted">Tidak bisa edit/hapus</small>
            @endif

        </div>

    </div>

    @endforeach

    <a href="/report" class="btn btn-dark mt-3">📊 Report</a>

</div>

<script>
function editTask(form){
    let title = prompt("Edit judul:", form.title.value);
    let desc = prompt("Edit deskripsi:", form.description.value);
    let date = prompt("Edit tanggal:", form.due_date.value);

    if(title){
        form.title.value = title;
        form.description.value = desc;
        form.due_date.value = date;
        form.submit();
    }
}
</script>

</body>
</html>