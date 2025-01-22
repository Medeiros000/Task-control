<?php

namespace App\Http\Controllers;

use App\Mail\NewTaskMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
		$id    = auth()->user()->id;
		$name  = auth()->user()->name;
		$email = auth()->user()->email;
		return "ID: $id | Name: $name | Email: $email";
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
		$task       = Task::create($request->all());
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
		//
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Task $task)
	{
		//
	}
}
