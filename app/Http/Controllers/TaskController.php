<?php

namespace App\Http\Controllers;

use App\Exports\TasksExport;
use App\Mail\NewTaskMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class TaskController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user_id = auth()->user()->id;

		$tasks = Task::where('user_id', $user_id)->paginate(10);

		return view('task.index', ['tasks' => $tasks]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('task.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$data            = $request->all('task', 'deadline');
		$data['user_id'] = auth()->user()->id;

		$task = Task::create($data);

		$user_email = auth()->user()->email;
		Mail::to($user_email)->send(new NewTaskMail($task));

		return redirect()->route('task.show', ['task' => $task->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function show(Task $task)
	{
		return view('task.show', ['task' => $task]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Task $task)
	{
		if ($task->user_id != auth()->user()->id) {
			return view('access-denied');
		}
		return view('task.edit', ['task' => $task]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Task $task)
	{
		if ($task->user_id != auth()->user()->id) {
			return view('access-denied');
		}
		$task->update($request->all());
		return redirect()->route('task.show', ['task' => $task->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Task $task)
	{
		if ($task->user_id != auth()->user()->id) {
			return view('access-denied');
		}
		$task->delete();
		return redirect()->route('task.index');
	}

	public function exportation($file_ext)
	{
		if (in_array($file_ext, ['xlsx', 'csv', 'pdf'])) {
			return Excel::download(new TasksExport, 'tasks_list.' . $file_ext);
		}
		return redirect()->route('task.index');
	}

	public function export()
	{
		$pdf = PDF::loadView('task.pdf', ['tasks' => auth()->user()->tasks()->get()]);
		return $pdf->stream('tasks_list.pdf');
		// return $pdf->download('tasks_list.pdf');
	}
}
