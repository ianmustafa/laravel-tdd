<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Tasks Management</title>
</head>
<body>
    <form action="{{ url('tasks') }}" method="POST">
        @csrf
        <input type="text" name="name">
        <textarea name="description"></textarea>
        <button type="submit">Create Task</button>
    </form>
    <ul>
        @foreach ($tasks as $task)
            <li>
                <h4>{{ $task->name }}</h4>
                <p>{{ $task->description }}</p>
            </li>
        @endforeach
    </ul>
</body>
</html>
