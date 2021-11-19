<x-app-layout>
    <x-slot name="header">{{ __('Add comment') }}</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">

                <x-jet-section-title>
                    <x-slot name="title">{{ __('New comment') }}</x-slot>
                    <x-slot name="description">
                        {!! __('Version') . ': ' . $release->version . '. ' . __('Description') . ': <br>' . nl2br($release->description) !!}
                    </x-slot>
                </x-jet-section-title>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form method="post" action="{{ route('releases.comments.store', $release) }}">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="hidden" name="release_id" value="{{ $release->id }}">

                        <div>
                            <x-jet-label for="message" value="{{ __('Comment') }}" />
                            <textarea id="message" name="message" required
                                class="h-40 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"></textarea>
                            <x-jet-input-error for="message" class="mt-2" />
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
