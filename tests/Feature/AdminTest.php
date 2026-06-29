<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\MentorProfile;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private User $student;

    private User $mentor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $this->student = User::factory()->create(['role' => User::ROLE_STUDENT, 'is_active' => true]);

        $this->mentor = User::factory()->create(['role' => User::ROLE_MENTOR, 'is_active' => true]);
        MentorProfile::create([
            'user_id' => $this->mentor->id,
            'designation' => 'Developer',
            'experience' => '2 years',
            'bio' => 'A nice mentor.',
            'is_verified' => false,
        ]);
    }

    public function test_admin_can_view_dashboard()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);
    }

    public function test_student_cannot_view_admin_dashboard()
    {
        $response = $this->actingAs($this->student)->get(route('admin.dashboard'));
        $response->assertStatus(403);
    }

    public function test_admin_can_view_users_list()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.users.index'));
        $response->assertStatus(200);
        $response->assertSee($this->student->name);
    }

    public function test_admin_can_deactivate_user()
    {
        $response = $this->actingAs($this->admin)->patch(route('admin.users.updateStatus', $this->student), [
            'is_active' => 0,
        ]);

        $response->assertRedirect();
        $this->assertEquals(0, $this->student->fresh()->is_active);
    }

    public function test_admin_can_verify_mentor()
    {
        $mentorProfile = $this->mentor->mentorProfile;

        $response = $this->actingAs($this->admin)->patch(route('admin.mentors.verify', $mentorProfile), [
            'is_verified' => 1,
        ]);

        $response->assertRedirect();
        $this->assertTrue($mentorProfile->fresh()->is_verified);
    }

    public function test_admin_can_create_department()
    {
        $response = $this->actingAs($this->admin)->post(route('admin.departments.store'), [
            'name' => 'Computer Science',
        ]);

        $response->assertRedirect(route('admin.departments.index'));
        $this->assertDatabaseHas('departments', ['name' => 'Computer Science']);
    }

    public function test_admin_can_update_department()
    {
        $department = Department::create(['name' => 'Old Name']);

        $response = $this->actingAs($this->admin)->put(route('admin.departments.update', $department), [
            'name' => 'New Name',
        ]);

        $response->assertRedirect(route('admin.departments.index'));
        $this->assertDatabaseHas('departments', ['name' => 'New Name']);
    }

    public function test_admin_can_delete_department()
    {
        $department = Department::create(['name' => 'To Delete']);

        $response = $this->actingAs($this->admin)->delete(route('admin.departments.destroy', $department));

        $response->assertRedirect(route('admin.departments.index'));
        $this->assertDatabaseMissing('departments', ['name' => 'To Delete']);
    }

    public function test_admin_can_create_skill()
    {
        $response = $this->actingAs($this->admin)->post(route('admin.skills.store'), [
            'name' => 'PHP',
        ]);

        $response->assertRedirect(route('admin.skills.index'));
        $this->assertDatabaseHas('skills', ['name' => 'PHP']);
    }

    public function test_admin_can_delete_skill()
    {
        $skill = Skill::create(['name' => 'Laravel']);

        $response = $this->actingAs($this->admin)->delete(route('admin.skills.destroy', $skill));

        $response->assertRedirect(route('admin.skills.index'));
        $this->assertDatabaseMissing('skills', ['name' => 'Laravel']);
    }
}
