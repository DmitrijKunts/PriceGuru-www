<x-app-layout>
    <x-slot name="header">{{ __('Edit Release') }}</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('Edit release') }}</x-slot>
                    <x-slot name="description"></x-slot>
                </x-jet-section-title>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form method="post" action="{{ route('releases.update', $release) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-jet-label for="version" value="{{ __('Version') }}" />
                            <x-jet-input id="version" class="block mt-1 w-full" type="text" name="version" required
                                autocomplete="version" autofocus value="{{ old('version', $release->version) }}" />
                            <x-jet-input-error for="version" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="description" value="{{ __('Description') }}" />
                            <textarea id="description" name="description"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">{{ old('description', $release->description) }}</textarea>
                            <x-jet-input-error for="description" class="mt-2" />
                        </div>

                        <div>
                            <x-jet-label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_inst" value="{{ __('Installation file') }}" />
                            <x-jet-input id="file_inst" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="file_inst"
                                autocomplete="file_inst" />
                            <x-jet-input-error for="file_inst" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="file_arc" value="{{ __('Zip-file') }}" />
                            <x-jet-input id="file_arc" class="block mt-1 w-full" type="file" name="file_arc"
                                autocomplete="file_arc" />
                            <x-jet-input-error for="file_arc" class="mt-2" />
                        </div>

                        <div class="flex justify-end mt-4">
                            <x-jet-button class="ml-4">
                                {{ __('Save') }}
                            </x-jet-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
