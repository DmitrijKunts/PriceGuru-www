<div class="bg-white px-4 overflow-hidden sm:px-6 lg:px-8">

    <x-slot name="meta_robots">
        <meta name="robots" content="noindex, nofollow">
    </x-slot>


    <div class="relative max-w-xl mx-auto">
        @if (session()->has('message'))
            <div class="px-12 pb-12">
                <div class="rounded-md bg-blue-50 p-4 ">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: solid/information-circle -->
                            <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3 flex-1 md:flex md:justify-between">
                            <p class="text-sm text-blue-700">
                                {{ session('message') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="text-center">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Обратная свзять
            </h1>
            <p class="mt-4 text-lg leading-6 text-gray-500">
                Если у есть вопрос или предложение, то Вы можете передать его через форму расположенную ниже.
            </p>
        </div>
        <div class="mt-12">
            <form wire:submit.prevent="submit" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                <div class="sm:col-span-2">
                    <label for="subject" class="block text-sm font-medium text-gray-700">Тема</label>
                    <div class="mt-1">
                        <input type="text" wire:model="subject" id="subject" autocomplete="given-subject"
                            class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                    </div>
                    @error('subject')<p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Имя</label>
                    <div class="mt-1">
                        <input type="text" wire:model="name" id="name" autocomplete="given-name"
                            class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                    </div>
                    @error('name')<p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1">
                        <input id="email" wire:model="email" type="email" autocomplete="email"
                            class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                    </div>
                    @error('email')<p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="content" class="block text-sm font-medium text-gray-700">Сообщение</label>
                    <div class="mt-1">
                        <textarea id="content" wire:model="content" rows="4"
                            class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border border-gray-300 rounded-md"></textarea>
                    </div>
                    @error('content')<p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Отправить
                    </button>
                </div>
            </form>
        </div>
    </div>


</div>
