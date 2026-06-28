<form method="POST" action="{{ $action }}" class="space-y-6">
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <x-input-label for="designation" :value="__('Designation')" />
        <x-text-input id="designation" name="designation" type="text" class="mt-1 block w-full" :value="old('designation', $profile->designation)" required />
        <x-input-error class="mt-2" :messages="$errors->get('designation')" />
    </div>

    <div>
        <x-input-label for="experience" :value="__('Experience')" />
        <textarea id="experience" name="experience" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('experience', $profile->experience) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('experience')" />
    </div>

    <div>
        <x-input-label for="bio" :value="__('Bio')" />
        <textarea id="bio" name="bio" rows="5" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('bio', $profile->bio) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('bio')" />
    </div>

    <div>
        <x-input-label :value="__('Skills')" />
        <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach ($skills as $skill)
                <label class="inline-flex items-center">
                    <input type="checkbox" name="skills[]" value="{{ $skill->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(in_array($skill->id, old('skills', $selectedSkills), true))>
                    <span class="ms-2 text-sm text-gray-700">{{ $skill->name }}</span>
                </label>
            @endforeach
        </div>
        <x-input-error class="mt-2" :messages="$errors->get('skills')" />
        <x-input-error class="mt-2" :messages="$errors->get('skills.*')" />
    </div>

    <x-primary-button>
        {{ __('Save Profile') }}
    </x-primary-button>
</form>
