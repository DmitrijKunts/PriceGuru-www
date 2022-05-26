<x-app-layout>
    <x-slot name="header">Сводка</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="bg-gray-50">
                    <div
                        class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                            <span class="block">Готовы к бесплатному тесту?</span>
                            <span class="block text-indigo-600">Лицензия на 28 дней для работы на полных оборотах.</span>
                            <span class="block text-gray-500 text-sm font-normal">* Ограничение незарегистрированной
                                версии лишь в том, что нет возможности добавлять новые организации если 3 уже добавлены.
                                Но если ранее, при активной лицензии, были добавлены нужные Вам организации, то они
                                будут использоваться программой без ограничений.</span>
                        </h2>
                        <div class="mt-8 lex lg:mt-0 lg:flex-shrink-0">
                            <div class="inline-flex rounded-md shadow">
                                <a href="{{ route('lic_make_free') }}"
                                    class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Скачать лицензию
                                </a>
                            </div>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</x-app-layout>
