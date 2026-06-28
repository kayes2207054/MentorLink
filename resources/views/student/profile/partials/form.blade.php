<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <x-input-label for="student_id" :value="__('Student ID')" />
        <x-text-input id="student_id" name="student_id" type="text" class="mt-1 block w-full" :value="old('student_id', $profile->student_id)" required />
        <x-input-error class="mt-2" :messages="$errors->get('student_id')" />
    </div>

    <div>
        <x-input-label for="department_id" :value="__('Department')" />
        <select id="department_id" name="department_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
            <option value="">{{ __('Select department') }}</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" @selected((int) old('department_id', $profile->department_id) === $department->id)>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('department_id')" />
    </div>

    <div>
        <x-input-label for="academic_year" :value="__('Academic Year')" />
        <x-text-input id="academic_year" name="academic_year" type="text" class="mt-1 block w-full" :value="old('academic_year', $profile->academic_year)" required />
        <x-input-error class="mt-2" :messages="$errors->get('academic_year')" />
    </div>

    <div>
        <x-input-label for="semester" :value="__('Semester')" />
        <x-text-input id="semester" name="semester" type="text" class="mt-1 block w-full" :value="old('semester', $profile->semester)" required />
        <x-input-error class="mt-2" :messages="$errors->get('semester')" />
    </div>

    <div>
        <x-input-label for="bio" :value="__('Bio')" />
        <textarea id="bio" name="bio" rows="5" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('bio', $profile->bio) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('bio')" />
    </div>

    <div>
        <x-input-label for="profile_photo" :value="__('Profile Photo')" />
        <input id="profile_photo" name="profile_photo" type="file" class="mt-1 block w-full text-sm text-gray-700">
        <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
    </div>

    <x-primary-button>
        {{ __('Save Profile') }}
    </x-primary-button>
</form>
