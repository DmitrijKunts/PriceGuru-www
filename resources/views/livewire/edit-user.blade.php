<div class="space-y-6 m-2">

    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Персональные данные</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Имя и email пользователя.
                </p>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="#" method="POST">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Имя</label>
                            <input wire:model='user.name' type="text" name="name" id="name" autocomplete="given-name"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('user.name')<p class="mt-2 text-sm text-gray-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <label for="email-address" class="block text-sm font-medium text-gray-700">Email</label>
                            <input wire:model='user.email' type="text" name="email-address" id="email-address"
                                autocomplete="email"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('user.email')<p class="mt-2 text-sm text-gray-500">{{ $message }}</p>
                            @enderror

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <button wire:click='closeModal' type="button"
            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Отменить
        </button>
        <button wire:click='save' type="button" type="submit"
            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Сохранить
        </button>
    </div>

</div>
