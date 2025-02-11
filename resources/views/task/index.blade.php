@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-6">
                Task
              </div>
              <div class="col-6">
                <div class="float-right">
                  <a href="{{ route('task.create') }}" class="mr-3">New</a>
                  <a href="{{ route('task.exportation', ['file_ext' => 'xlsx']) }}" class="mr-3">XLSX</a>
                  <a href="{{ route('task.exportation', ['file_ext' => 'csv']) }}" class="mr-3">CSV</a>
                  <a href="{{ route('task.exportation', ['file_ext' => 'pdf']) }}" class="mr-3">PDF</a>
                  <a href="{{ route('task.export') }}" target="_blank" class="mr-3">PDF V2</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Task</th>
                  <th scope="col">Deadline</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tasks as $k => $v)
                  <tr>
                    <th scope="row">{{ $v['id'] }}</th>
                    <td>{{ $v['task'] }}</td>
                    <td>{{ $v['deadline'] }}</td>
                    <td><a href="{{ route('task.edit', $v['id']) }}">Edit</a></td>
                    <td>
                      <form id="form_{{ $v['id'] }}" method="POST"
                        action="{{ route('task.destroy', ['task' => $v['id']]) }}">
                        @csrf
                        @method('DELETE')
                      </form>
                      <a href="#" onclick="document.getElementById('form_{{ $v['id'] }}').submit()">Delete</a>
                    </td>
                    {{-- <td>{{ date('d/m/Y', strtotime($v['deadline'])) }}</td> --}}
                  </tr>
                @endforeach

              </tbody>
            </table>
            <nav>
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="{{ $tasks->previousPageUrl() }}">Previous</a></li>
                @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                  <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $tasks->url($i) }}">{{ $i }}</a>
                  </li>
                @endfor
                <li class="page-item"><a class="page-link" href="{{ $tasks->nextPageUrl() }}">Next</a></li>
              </ul>
            </nav>
            <a href="{{ route('task.create') }}" class="btn btn-primary">Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
