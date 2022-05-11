@component('mail::message')
    # Привет!

    Новое сообщение для управляющего Price-Guru.

    Имя:  {{ $data->name }}
    E-mail:  {{ $data->email }}
    Тема:  {{ $data->subject }}
    Сообщение:  {!! $data->content !!}
@endcomponent
