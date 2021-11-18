<x-app-layout>
    <x-slot name="header">Пользователи</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <livewire:user-table />

            </div>
        </div>
    </div>
</x-app-layout>
