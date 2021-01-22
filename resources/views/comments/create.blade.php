<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add comment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">New comment</x-slot>
                    <x-slot name="description"></x-slot>
                </x-jet-section-title>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form method="post" action="{{ route('releases.comments.store', $release) }}">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="hidden" name="release_id" value="{{ $release->id }}">

                        <div>
                            <x-jet-label for="message" value="{{ __('Comment') }}"/>
                            <x-jet-input id="message" class="block mt-1 w-full" type="text" name="message" required
                                         autocomplete="message"/>
                            <x-jet-input-error for="message" class="mt-2"/>
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
