<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Welcome to the mentor area.') }}
                    <x-auth-session-status class="mb-4 mt-4" :status="session('status')" />

                    <h3 class="text-xl font-bold mt-8 mb-4">Pending Requests</h3>
                    @if($pendingRequests->count() > 0)
                        <div class="space-y-4">
                            @foreach($pendingRequests as $request)
                                <div class="border p-4 rounded bg-yellow-50">
                                    <p class="font-bold">{{ $request->student->name }}</p>
                                    <p class="text-gray-700 italic">"{{ $request->message }}"</p>
                                    <div class="mt-4 flex space-x-2">
                                        <form method="POST" action="{{ route('mentor.mentorship-requests.update', $request) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">Accept</button>
                                        </form>
                                        <form method="POST" action="{{ route('mentor.mentorship-requests.update', $request) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Reject</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No pending requests.</p>
                    @endif

                    <h3 class="text-xl font-bold mt-8 mb-4">Accepted Requests</h3>
                    @if($acceptedRequests->count() > 0)
                        <div class="space-y-4">
                            @foreach($acceptedRequests as $request)
                                <div class="border p-4 rounded bg-green-50">
                                    <p class="font-bold">{{ $request->student->name }}</p>
                                    <p class="text-gray-700 italic">"{{ $request->message }}"</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No accepted requests yet.</p>
                    @endif

                    <h3 class="text-xl font-bold mt-8 mb-4">Rejected Requests</h3>
                    @if($rejectedRequests->count() > 0)
                        <div class="space-y-4">
                            @foreach($rejectedRequests as $request)
                                <div class="border p-4 rounded bg-red-50">
                                    <p class="font-bold">{{ $request->student->name }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No rejected requests.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
