<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Release') }}
        </h2>
    </x-slot>

    <div class="md:grid md:grid-cols-3 md:gap-6">

        <x-jet-section-title>
            <x-slot name="title">New release</x-slot>
            <x-slot name="description">desc new release</x-slot>
        </x-jet-section-title>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="post" action="{{ route('releases.store') }}" enctype="multipart/form-data">
                @csrf

                <div>
                    <x-jet-label for="version" value="{{ __('Version') }}"/>
                    <x-jet-input id="version" class="block mt-1 w-full" type="text" name="version" required
                                 autocomplete="version" autofocus/>
                    <x-jet-input-error for="version" class="mt-2"/>
                </div>
                <div>
                    <x-jet-label for="description" value="{{ __('Description') }}"/>
                    <x-jet-input id="description" class="block mt-1 w-full" type="text" name="description" 
                                 autocomplete="description"/>
                    <x-jet-input-error for="description" class="mt-2"/>
                </div>
                <div>
                    <x-jet-label for="file_inst" value="{{ __('file_inst') }}"/>
                    <x-jet-input id="file_inst" class="block mt-1 w-full" type="file" name="file_inst" required
                                 autocomplete="file_inst"/>
                    <x-jet-input-error for="file_inst" class="mt-2"/>
                </div>
                <div>
                    <x-jet-label for="file_arc" value="{{ __('file_arc') }}"/>
                    <x-jet-input id="file_arc" class="block mt-1 w-full" type="file" name="file_arc" required
                                 autocomplete="file_arc"/>
                    <x-jet-input-error for="file_arc" class="mt-2"/>
                </div>

                <div class="flex justify-end mt-4">
                    <x-jet-button class="ml-4">
                        {{ __('Add') }}
                    </x-jet-button>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>
