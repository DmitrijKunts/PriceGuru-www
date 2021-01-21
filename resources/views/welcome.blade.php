<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Price-Guru
        </h2>
    </x-slot>

    @if($release)
        @include('releases.card')
    @endif

</x-app-layout>
