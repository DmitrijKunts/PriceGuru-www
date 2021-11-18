<x-app-layout>
    <x-slot name="header">{{ __('Create Release') }}</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('New release') }}</x-slot>
                    <x-slot name="description"></x-slot>
                </x-jet-section-title>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form method="post" action="{{ route('releases.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-jet-label for="version" value="{{ __('Version') }}" />
                            <x-jet-input value="{{ old('version') }}" id="version" class="block mt-1 w-full"
                                type="text" name="version" required autocomplete="version" autofocus />
                            <x-jet-input-error for="version" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="description" value="{{ __('Description') }}" />
                            <textarea value="" id="description" name="description" required
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">{{ old('description') }}</textarea>
                            <x-jet-input-error for="description" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="file_inst" value="{{ __('Installation file') }}" />
                            <x-jet-input value="{{ old('file_inst') }}" id="file_inst" class="block mt-1 w-full"
                                type="file" name="file_inst" required autocomplete="file_inst" />
                            <x-jet-input-error for="file_inst" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="file_arc" value="{{ __('Zip-file') }}" />
                            <x-jet-input value="{{ old('file_arc') }}" id="file_arc" class="block mt-1 w-full"
                                type="file" name="file_arc" required autocomplete="file_arc" />
                            <x-jet-input-error for="file_arc" class="mt-2" />
                        </div>

                        <div class="flex justify-end mt-4">
                            <x-jet-button class="ml-4">
                                {{ __('Add') }}
                            </x-jet-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
