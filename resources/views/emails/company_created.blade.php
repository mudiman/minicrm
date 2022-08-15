@component('mail::message')
    {{ __('Hi')  }} {{$company->name}}



    {{ __('Congratulation your company has been successfully registered.')  }}




    Thanks,
    {{ config('app.name') }}
@endcomponent
