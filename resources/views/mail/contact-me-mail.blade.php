<x-mail::message>
# New Contact Form Submission

## Name: {{ $contactData['name'] }}

## Email: {{ $contactData['email'] }}

## Message:
{!! nl2br(e($contactData['message'])) !!}
</x-mail::message>
