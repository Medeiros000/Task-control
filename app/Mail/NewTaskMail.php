<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;

class NewTaskMail extends Mailable
{
    use Queueable, SerializesModels;
    public $task;
    public $deadline;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task->task;
        $this->deadline = date('d/m/Y', strtotime($task->deadline));
        $this->url = route('task.show', ['task' => $task->id]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-task')->subject('New Task Created');
    }
}
