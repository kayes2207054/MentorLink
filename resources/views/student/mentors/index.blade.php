<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentor Directory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="GET" action="{{ route('student.mentors.index') }}" class="mb-6 flex space-x-4">
                    <input type="text" name="search" placeholder="Search by name..." value="{{ request('search') }}" class="border-gray-300 rounded-md shadow-sm">
                    
                    <select name="skill" class="border-gray-300 rounded-md shadow-sm">
                        <option value="">All Skills</option>
                        @foreach($skills as $skill)
                            <option value="{{ $skill->id }}" {{ request('skill') == $skill->id ? 'selected' : '' }}>{{ $skill->name }}</option>
                        @endforeach
                    </select>

                    <select name="department" class="border-gray-300 rounded-md shadow-sm">
                        <option value="">All Departments</option>
                    </select>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Filter
                    </button>
                    <a href="{{ route('student.mentors.index') }}" class="text-gray-500 py-2 px-4">Clear</a>
                </form>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($mentors as $mentor)
                        <div class="border rounded-lg p-4 shadow-sm">
                            <h3 class="text-lg font-bold">{{ $mentor->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $mentor->mentorProfile->designation }}</p>
                            <div class="mt-4">
                                @foreach($mentor->mentorProfile->skills as $skill)
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">{{ $skill->name }}</span>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('student.mentors.show', $mentor->id) }}" class="text-blue-500 hover:underline">View Profile &rarr;</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    {{ $mentors->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
