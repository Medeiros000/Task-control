@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ $task->task }}</div>
          <div class="card-body">
            <fieldset disabled>
              <div class="mb-3">
                <label class="form-label">Deadline Completion</label>
                <input type="date" class="form-control" value="{{ $task->deadline }}">
              </div>
            </fieldset>
            <a href="{{ route('task.create') }}" class="btn btn-primary">Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
