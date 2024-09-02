<x-mail::message>
# {{__('mails.title', ['event_name'=>$event->name])}}

**{{ __('mails.description') }}**<br>
{{$event->description}}

**{{ __('mails.schedule') }}**<br>
{{ __('mails.starts_at') }} {{$event->starts_at->format('Y-m-d H:i')}} {{ __('mails.and_ends_at') }} {{$event->ends_at->format('Y-m-d H:i')}}

**{{ __('mails.location') }}** <br>
{{$eventAddress->name}}
{{$eventAddress->street}} {{$eventAddress->house_number}} {{$eventAddress->house_numer_addition ?? ''}},
{{$eventAddress->zip_code}} - {{$eventAddress->city}}, {{$eventAddress->country_code}}

@if($eventAddress->email != '' || $eventAddress->phone != '' || $eventAddress->website != '')
**{{ __('mails.location_contacts') }}** <br>
@endif
@if($eventAddress->email != '')
{{ __('mails.email') }} : {{$eventAddress->email}}<br>
@endif
@if($eventAddress->phone != '')
{{ __('mails.phone') }} : {{$eventAddress->phone}}<br>
@endif
@if($eventAddress->website != '')
{{ __('mails.website') }} : {{$eventAddress->website}}<br>
@endif

<x-mail::panel>
**{{__('mails.attendees') }}**<br>
<ul>
@foreach($users as $user)
        <li>{{$user->name}}</li>
@endforeach
</ul>
</x-mail::panel>

{{ __('mails.thank_you') }},<br>
{{ config('app.name') }}
</x-mail::message>
