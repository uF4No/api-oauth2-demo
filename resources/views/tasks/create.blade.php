@extends('layouts.app')
@section('content')
  <h4>Create task</h4>
  <form action="{{route('tasks.store')}}" class="mb-3" method="post" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <div class="row">
      <div class="form-group col-sm-12">
        <label for="name" class="control-label">Task Name</label>
        <input name="name" class="form-control" type="text" id="name">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-sm-12">
        <label for="description" class="control-label">Description</label>
        <textarea name="description" id="description" class="form-control" cols="50" rows="10"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-sm-12">
        <input type="submit" class="btn btn-success" value="Create task!" role="button">
      </div>
    </div>
  </form>
@endsection