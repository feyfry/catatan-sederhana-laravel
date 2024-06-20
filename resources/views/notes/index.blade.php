<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ request()->routeIs('notes.index') ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="sm:container sm:mx-auto px-4 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            @if (request()->routeIs('notes.index'))
            <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                <div class="flex border rounded-md overflow-hidden mb-4 md:mb-0">
                    <div class="px-4 py-2 bg-white border-r">
                        <p class="text-sm text-gray-600">Total Notes</p>
                        <p class="text-lg font-semibold">{{ Auth::user()->notes->count() }}</p>
                    </div>
                    <div class="px-4 py-2 bg-white border-r">
                        <p class="text-sm text-gray-600">Pending</p>
                        <p class="text-lg font-semibold text-amber-500">{{ Auth::user()->notes->filter(fn($note) => $note->transactions->contains('status', 'pending'))->count() }}</p>
                    </div>
                    <div class="px-4 py-2 bg-white">
                        <p class="text-sm text-gray-600">Completed</p>
                        <p class="text-lg font-semibold text-emerald-500">{{ Auth::user()->notes->filter(fn($note) => $note->transactions->contains('status', 'completed'))->count() }}</p>
                    </div>
                </div>
                <a href="{{ route('notes.create') }}" class="btn-link btn-lg">+ New Note</a>
            </div>
            @endif

            @forelse ($notes as $note)
            @php
            $ringColor = 'border-4 border-l-slate-500';
            foreach ($note->transactions as $transaction) {
            if ($transaction->status == 'pending') {
            $ringColor = 'border-4 border-l-amber-500';
            break;
            } elseif ($transaction->status == 'completed') {
            $ringColor = 'border-4 border-l-emerald-500';
            break;
            }
            }
            @endphp
            <div class="my-6 p-6 bg-white shadow-sm sm:rounded-lg {{ $ringColor }}">
                <h2 class=" font-bold   text-xl">
                    <a @if (request()->routeIs('notes.index'))
                        href="{{route('notes.show',$note)}}"
                        @else
                        href="{{route('trashed.show',$note)}}"
                        @endif >
                        {{$note->title}}
                    </a>

                </h2>
                <p class="mt-2 text-xl">
                    {!! Str::limit($note->text, 200) !!}
                </p>
                @foreach ($note->transactions as $transaction)
                <span class="block mt-4 text-sm opacity-80">
                    Status:
                    @if ($transaction->status == 'pending')
                    <span class="text-amber-500">pending</span>
                    @elseif ($transaction->status == 'completed')
                    <span class="text-emerald-500">completed</span>
                    @endif
                </span>
                @endforeach
                <span class="block mt-2 text-sm opacity-70">updated: {{ $note->updated_at->diffForHumans() }}</span>
            </div>
            @empty
            @if (request()->routeIs('notes.index'))
            <div class="my-6 mt-3 p-6 bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 selection:bg-neutral-300 selection:text-neutral-900 shadow-sm sm:rounded-lg">
                <p class="font-bold text-white text-xl text-center">You have no notes yet!</p>
            </div>
            @else
            <div class="my-6 mt-3 p-6 bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 selection:bg-neutral-300 selection:text-neutral-900 shadow-sm sm:rounded-lg">
                <p class="font-bold text-white text-xl text-center">No Items in the Trash</p>
            </div>
            @endif
            @endforelse

            {{-- pagination --}}
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>