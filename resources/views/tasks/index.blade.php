@extends('layouts.app')
@section('content')
<nav style="text-align: center;">
    <a href="{{route('tasks.create')}}" class="btn btn-info" role="button">Create Task!</a>
  </nav>
  <div class="container-fluid">
    @if(isset($tasks_pending))
    <h3>Pending tasks</h3>
      @foreach($tasks_pending as $task)
      <div class="card card-body mb-2">
      <form action="{{route('tasks.complete', $task->id)}}" method="post">
          {!! csrf_field() !!}
          <h4>{{$task->name}}</h4>
          <p>{{$task->description}}</p>
          <input type="submit" class="btn btn-warning" value="complete">
      </form>
      @endforeach
      </div>
    <h3>Completed tasks</h3>
      @foreach($tasks_completed as $t)
      <div class="card card-body mt-2 mb-2">
        <h5>{{$t->name}}</h5>
        <p>{{$t->description}}</p>
      </div>
      @endforeach
    @endif

  </div>
@endsection