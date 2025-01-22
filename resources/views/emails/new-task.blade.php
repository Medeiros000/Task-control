@component('mail::message')
# {{ $task}}

Deadline: {{ $deadline }}

@component('mail::button', ['url' => $url])
Click here to view the task
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
