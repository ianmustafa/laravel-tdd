@extends('layouts.app')

@section('content')
<h1 class="text-center display-4 mb-4">Tasks Management</h1>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5 mb-5 mb-md-0">
        <h2>All Tasks</h2>
        <ul class="list-group">
            @forelse ($tasks as $task)
            <li class="list-group-item">
                <h5 class="mb-1">{{ $task->name }}</h5>
                <p class="mb-0">{{ $task->description }}</p>
            </li>
            @empty
            <li class="list-group-item">
                <p class="mb-0">There are no tasks found. For now.</p>
            </li>
            @endforelse
        </ul>
    </div>

    <div class="col-md-6 col-lg-5">
        <h2>New Task</h2>
        <form action="{{ url('tasks') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="off">

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('description') }}</textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Task</button>
        </form>
    </div>
</div>
@endsection
