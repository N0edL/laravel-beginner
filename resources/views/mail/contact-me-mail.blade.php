<x-mail::message>
# New Contact Form Submission

## Name: {{ $contactData['name'] }}

## Email: {{ $contactData['email'] }}

## Message: {{ $contactData['message'] }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
