@component('mail::message')
# عزيزنا العميل 

يؤسفنا ابلاغك بآن موعدكم قد تم الغاءة.
<br>
يرجي حجز موعد في وقت أخر.

@component('mail::button', ['url' => 'http://mybarber.test/home'])
حجز موعد أخر
@endcomponent

شكرًا ,<br>
{{ config('app.name') }}
@endcomponent
