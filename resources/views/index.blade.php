<!DOCTYPE html>
<html>
<head>
    <title>Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Task List</h1>
    <div class="row mb-3">
        <div class="col-md-6">
            <a href="{{ route('tasks.create') }}" class="btn btn-success">Create New Task</a>
        </div>
        <div class="col-md-6">
            <form action="{{ route('tasks.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search tasks..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Due Date</th>
            <th>Priority</th>
            <th>Completed</th>
            <th>Actions</th>
        </tr>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                 <td>{{ $task->category ? $task->category->name : '-' }}</td>
                <td>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d H:i') : '-' }}</td>
                <td>{{ ucfirst($task->priority) }}</td>
                <td>{{ $task->completed ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('tasks.show',$task->id) }}" class="btn btn-info">Show</a>
                    <a href="{{ route('tasks.edit',$task->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('tasks.destroy',$task->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>