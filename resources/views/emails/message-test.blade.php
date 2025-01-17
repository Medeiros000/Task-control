@component('mail::message')
# Introduction

The body of your message.

- Option 1
- Option 2
- Option 3

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
