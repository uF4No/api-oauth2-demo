@extends('layouts.app')
@section('content')
  <div class="container-fluid">
    <h4>All tasks</h4>
    @if(isset($tasks))
    <ul>
      @foreach($tasks as $task)
      <li>{{$task->name}}</li>
      <p>{{$task->description}}</p>
      @endforeach
    </ul>
    @else
    <p>There are no tasks!</p>
    @endif
    <nav>
    <a href="{{route('tasks.create')}}" class="btn btn-info" role="button">Create Task!</a>
    </nav>
  </div>
@endsection