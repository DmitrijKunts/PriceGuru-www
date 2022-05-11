@component('mail::message')
    # Привет!

    Заказана новая лицензия на сайте Price-Guru

    Имя: {{ $user->name }}
    Email: {{ $user->email }}
@endcomponent
