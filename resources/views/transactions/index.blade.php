<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Status') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('transactions.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('+ New Status') }}
                    </a>
                </div>

                <div class="bg-white overflow-x-auto overflow-y-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table class="table min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Created At
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        @foreach ($transaction->notes as $note)
                                        {{ $note->title }}<br>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        {{ $transaction->status }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        {{ $transaction->created_at->format('Y-m-d H:i:s') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium">
                                        <a href="{{ route('transactions.edit', $transaction) }}" class="text-cyan-500 hover:text-slate-900 text-lg"><i class="bi bi-pencil-square"></i></a>
                                        @if ($transaction->notes->isNotEmpty())
                                        <a href="{{ route('transaction_details.show', [$transaction->id, $transaction->notes->first()->pivot->note_id]) }}" class="text-fuchsia-500 hover:text-slate-900 text-lg ms-2"><i class="bi bi-eye"></i></a>
                                        @else
                                        <span class="text-gray-400">No Notes Status</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>