<x-app-layout>
    <x-slot name="title">Видео приемов обработки</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Скринкасты обработки прайсов
        </h2>
    </x-slot>



    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto divide-y-2 divide-gray-200">
                <h2 class="text-center text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Видеоуроки
                </h2>
                <dl class="mt-6 space-y-6 divide-y divide-gray-200">

                    <div class="pt-6">
                        <dt class="text-lg">

                            <button type="button" class="text-left w-full flex justify-between items-start text-gray-400"
                                aria-controls="faq-0" aria-expanded="false">
                                <span class="font-medium text-gray-900">
                                    1. Загрузка и установка программы Price-guru
                                </span>
                                <span class="ml-6 h-7 flex items-center">

                                    <svg class="rotate-0 h-6 w-6 transform" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </button>
                        </dt>
                        <dd class="mt-2 pr-12" id="faq-0">
                            <div class="aspect-w-16 aspect-h-9">
                                <object class="lozad" data-data="//www.youtube.com/embed/Zr5ZR11mQnI"></object>
                            </div>
                        </dd>
                    </div>



                </dl>
            </div>
        </div>
    </div>


</x-app-layout>
