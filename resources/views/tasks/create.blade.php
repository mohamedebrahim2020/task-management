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
<div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-10 col-md-8 col-lg-6">
            <h3 class="mb-4">Add a Task</h3>

            <form action="{{ route('tasks.store') }}" method="post">
                @csrf

                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            required
                    >
                    @error('title')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea
                            class="form-control"
                            id="description"
                            name="description"
                            rows="3"
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="due_date">Due Date</label>
                    <input
                            type="datetime-local"
                            class="form-control"
                            id="due_date"
                            name="due_date"
                            value="{{ old('due_date') }}"
                    >
                    @error('due_date')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="is_completed" name="is_completed" value="1">
                    <label class="form-check-label" for="is_completed">Mark as Completed</label>
                    @error('is_completed')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create Task</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>