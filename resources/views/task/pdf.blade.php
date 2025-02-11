<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks List</title>
    <style>
      .title {
        width: 100%;
        text-align: center;
        text-transform: uppercase;
        background-color: #c2c2c2;
        border: 1px;
      }

      table {
        width: 100%;
        text-align: center;
        border-collapse: collapse;
      }

      th,
      td {
        padding: 5px;
      }

      .page-break {
        page-break-after: always;
      }
    </style>
  </head>

  <body>
    <h2 class="title">Tasks List</h2>
    @php
      $tasks = $tasks->toArray();
    @endphp
    <table style="table">
      <thead>
        <tr style="background-color:#acacac">
          <th>ID</th>
          <th>Task</th>
          <th>Deadline</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tasks as $task)
          <tr style="background-color: {{ $loop->index % 2 == 0 ? '#f0f0f0' : '#ffffff' }};">
            <td>{{ $task['id'] }}</td>
            <td>{{ $task['task'] }}</td>
            <td>{{ $task['deadline'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>

</html>
