<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Релизы
        </h2>
    </x-slot>
    <x-slot name="title">Релизы</x-slot>

    <div>
        @foreach ($releases as $release)
            @include('releases.card')
            @break(true)
        @endforeach

        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Предыдущие релизы
                </h3>
            </div>

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Дата
                                    </th>
                                    <th scope="col" width="50"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Версия
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Примечание
                                    </th>
                                    @can('release-master')
                                        <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                        </th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($releases as $release)
                                    @if ($loop->first && $loop->count > 1)
                                        @continue
                                    @endif
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <a href="{{ route('releases.show', $release->id) }}"
                                               class="text-blue-600 hover:text-blue-900 mb-2 mr-2">
                                                {{ $release->created_at }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <a href="{{ route('releases.show', $release->id) }}"
                                               class="text-blue-600 hover:text-blue-900 mb-2 mr-2">
                                                {{ $release->version }}
                                            </a>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $release->description }}
                                        </td>
                                        @can('release-master')
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('releases.show', $release->id) }}"
                                                   class="text-blue-600 hover:text-blue-900 mb-2 mr-2">Обзор</a>
                                                <a href="{{ route('releases.edit', $release->id) }}"
                                                   class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Редактировать</a>
                                                <form class="inline-block"
                                                      action="{{ route('releases.destroy', $release->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure?');">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit"
                                                           class="text-red-600 hover:text-red-900 mb-2 mr-2"
                                                           value="Удалить">
                                                </form>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @can('release-master')
                <div class="block mb-8 mt-4">
                    <a href="{{ route('releases.create') }}"
                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Добавить релиз</a>
                </div>
            @endcan
        </div>
    </div>
</x-app-layout>
