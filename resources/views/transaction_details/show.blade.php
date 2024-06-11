<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Status Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ring-2 ring-red-500/50">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">{{ $transactionDetail->transaction->user->name }}</h3>
                    <div class="mt-4">
                        <p class="text-gray-600">Note Title: {{ $transactionDetail->note->title }}</p>
                        <p class="text-gray-600">
                            Note Text:
                            {!! Str::limit($transactionDetail->note->text, 200) !!}
                        </p>
                        <p class="text-gray-600">
                            Status:
                            @if ($transactionDetail->transaction->status == 'pending')
                            <span class="text-amber-500">pending</span>
                            @elseif ($transactionDetail->transaction->status == 'completed')
                            <span class="text-emerald-500">completed</span>
                            @endif
                        </p>
                    </div>
                    <div class="mt-6">
                        <form method="POST" action="{{ route('transaction_details.destroy', [$transactionDetail->transaction_id, $transactionDetail->note_id]) }}">
                            @csrf
                            @method('DELETE')
                            <x-danger-button>
                                {{ __('Remove Status') }}
                            </x-danger-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>