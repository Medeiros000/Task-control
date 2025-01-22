@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Add task') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('task.store') }}">
              @csrf
              <div class="mb-3">
                <label class="form-label">Task</label>
                <input type="test" class="form-control" name="task">
              </div>
              <div class="mb-3">
                <label class="form-label">Deadline Completion</label>
                <input type="date" class="form-control" name="deadline">
              </div>

              <button type="submit" class="btn btn-primary">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
