<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Profile: ') }} {{ $mentor->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col md:flex-row gap-8">
                <div class="md:w-1/3">
                    <h3 class="text-2xl font-bold">{{ $mentor->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $mentor->mentorProfile->designation }}</p>
                    
                    <h4 class="font-semibold mt-4">Skills</h4>
                    <div class="flex flex-wrap mt-2">
                        @foreach($mentor->mentorProfile->skills as $skill)
                            <span class="inline-block bg-blue-100 rounded-full px-3 py-1 text-sm font-semibold text-blue-800 mr-2 mb-2">{{ $skill->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="md:w-2/3">
                    <h4 class="font-semibold text-lg border-b pb-2">Experience</h4>
                    <p class="mt-2 text-gray-700 whitespace-pre-line">{{ $mentor->mentorProfile->experience }}</p>

                    <h4 class="font-semibold text-lg border-b pb-2 mt-6">Bio</h4>
                    <p class="mt-2 text-gray-700 whitespace-pre-line">{{ $mentor->mentorProfile->bio }}</p>

                    <div class="mt-8 border-t pt-6">
                        @if($pendingRequest)
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            You have a pending mentorship request with this mentor.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <form method="POST" action="{{ route('student.mentorship-requests.destroy', $pendingRequest->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Cancel Request
                                </button>
                            </form>
                        @else
                            <h4 class="font-semibold text-lg mb-4">Request Mentorship</h4>
                            <form method="POST" action="{{ route('student.mentorship-requests.store') }}">
                                @csrf
                                <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">
                                <div class="mb-4">
                                    <label for="message" class="block text-sm font-medium text-gray-700">Message to Mentor</label>
                                    <textarea name="message" id="message" rows="4" class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required placeholder="Introduce yourself and explain why you want this mentor..."></textarea>
                                </div>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Send Request
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
