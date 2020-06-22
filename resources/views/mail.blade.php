@component('mail::message')
# Hello, Mr admin

{{$name}} has sent you following message.
<br>
{{$message}}

@component('mail::button', ['url' => 'http://127.0.0.1:8001'])
Visit Us
@endcomponent

Thanks,<br>
{{ config('APP_NAME') }}
@endcomponent
