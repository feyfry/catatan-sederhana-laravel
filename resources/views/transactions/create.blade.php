<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Mark Status') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('transactions.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="notes" :value="__('Notes')" />
                            <x-select id="notes" name="notes[]" required>
                                @foreach (Auth::user()->notes as $note)
                                <option value="{{ $note->id }}">{{ $note->title }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </x-select>
                        </div>

                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>