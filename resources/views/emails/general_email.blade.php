
<x-mail::message>
<div >
   Hello {{ $recipientName}},
<br><br>
</div>
 Click the button below to verify your rippler account, <br>  
<div >
    {{$theMessage}}
</div>
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>