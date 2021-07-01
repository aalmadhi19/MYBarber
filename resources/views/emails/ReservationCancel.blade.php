@component('mail::message')
# عزيزي العميل

نأسف لإبلاغك بأن موعدك قد تم الغاءه.
<br>
يرجى حجز موعد في وقت آخر.

@component('mail::button', ['url' => ''])
حجز موعد آخر
@endcomponent

شكرًا ,<br>
{{ config('app.name') }}
@endcomponent
