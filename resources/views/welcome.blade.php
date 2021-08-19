<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Price-Guru - анализа и обработка прайсов
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <img class="mx-auto mb-5" src="{{ url('/imgs/screenshot-main.png') }}"
                 alt="Программа Price-Guru предназначена для обработки прайс-листов поставщиков сформированных в MS Excel'е или OpenOffice Calc">


            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Программа <b>Price-Guru</b> предназначена для обработки прайс-листов сформированных в
                                <a itemscope itemtype="https://schema.org/Brand" target="_blank" href="https://ru.wikipedia.org/wiki/Microsoft_Excel">MS Excel'е</a> или
                                <a itemscope itemtype="https://schema.org/Brand" target="_blank" href="https://ru.wikipedia.org/wiki/OpenOffice_Calc">OpenOffice Calc</a>.
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Возможности программы:
                        </p>
                    </div>
                    <div class="border-t border-gray-200">
                        <div class="bg-gray-50 px-4 py-5 sm:gap-4 sm:px-6">
                            Импорт прайс-листа из MS Excel по таким полям: код позиции, наименование позиции, наличие,
                            гарантия, цена оптовая, цена розничная, цена партнерская, цена дилерская и примечание.
                        </div>
                        <div class="bg-white-50 px-4 py-5 sm:gap-4 sm:px-6">
                            Разграничение позиций по категориям. Например, для прайса по компьютерной технике можно
                            различить такие категории: Клавиатура, CD-ROM, USB-Flash, Материнки, Процессоры, Видеокарты
                            и т.д.
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:gap-4 sm:px-6">
                            Идентификацию категорий можно настраивать вручную, выполнять загрузку/выгрузку чужих
                            настроек категорий.
                        </div>
                        <div class="bg-white-50 px-4 py-5 sm:gap-4 sm:px-6">
                            Мониторинг цен по каждой организации: измененные цены по отношению к предыдущему прайсу,
                            новые позиции по отношению к предыдущему прайсу, исчезнувшие позиции по отношению к
                            следующему прайсу.
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:gap-4 sm:px-6">
                            Поиск наилучшей цены по определенной позиции по всем внесенным организациям. Идентификация
                            позиций выполняется не по коду, а по анализу наименования (нечеткое сравнение текста).
                        </div>
                        <div class="bg-white-50 px-4 py-5 sm:gap-4 sm:px-6">
                            Построение графика изменения заданных цен за весь период загрузки прайс-листов.
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:gap-4 sm:px-6">
                            Быстрый поиск нужной позиции. Поиск ведется по коду, наименованию и категории.
                        </div>
                        <div class="bg-white-50 px-4 py-5 sm:gap-4 sm:px-6">
                            Сортировка позиций товаров по всем имеющимся колонкам. Так же, следует отметить, что
                            отображение тех или иных колонок настраивается пользователем.
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:gap-4 sm:px-6">
                            После загрузки прайс-листа можно подкорректировать некоторые позиции. Можно настроить такие
                            поля: код, наименование, цены, примечания, категории.
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    @if($release)
        @include('releases.card')
    @endif

</x-app-layout>
