<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Tasks</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
        <a class="navbar-brand h1" href={{ route('tasks.index') }}>Tasks</a>
        <div class="justify-end ">
            <div class="col ">
                <a class="btn btn-sm btn-success" href={{ route('tasks.create') }}>Add Task</a>
            </div>
        </div>
    </div>
</nav>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container mt-5">
    <div class="row">
        @forelse ($tasks as $task)
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $task->title }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">description : {{ $task->description }}</p>
                    </div>
                    <div class="card-body">
                        <p class="card-text">due date : {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i') }}</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm {{ $task->is_completed ? 'btn-success' : 'btn-outline-secondary' }}">
                                {{ $task->is_completed ? '✅ Completed' : 'Mark as Completed' }}
                            </button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm">
                                <a href="{{ route('tasks.edit', $task->id) }}"
                                   class="btn btn-primary btn-sm">Edit</a>
                            </div>
                            <div class="col-sm">
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <li>No tasks found.</li>
        @endforelse
    </div>
</div>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-auto">
            {{ $tasks->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</div>
</body>
</html>