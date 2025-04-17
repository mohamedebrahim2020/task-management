@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $task->title }}</h1>
    <p>{{ $task->description }}</p>
    <p>Due: {{ $task->due_date }}</p>
    <p>Status: {{ $task->is_completed ? 'Completed' : 'Incomplete' }}</p>

    <a href="{{ route('tasks.edit', $task) }}">Edit</a>
@endsection
