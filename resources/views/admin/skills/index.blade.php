@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-soft">
    <div>
        <h4 class="fw-bold mb-0">Skills Management</h4>
        <p class="text-muted small mb-0">Manage the skills available for mentor profiles</p>
    </div>
    <a href="{{ route('admin.skills.create') }}" class="btn btn-primary hover-lift-btn" id="btn-add-skill">
        <i class="bi bi-plus-lg me-1"></i>Add Skill
    </a>
</div>

<div class="card card-elevated border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="skills-table">
                <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Skill Name</th>
                        <th>Created</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($skills as $skill)
                        <tr>
                            <td class="ps-4 text-muted small">#{{ $skill->id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-2"
                                         style="width:36px;height:36px;background:#ede9fe;flex-shrink:0;">
                                        <i class="bi bi-lightning-fill text-primary" style="font-size:.9rem;"></i>
                                    </div>
                                    <span class="fw-semibold">{{ $skill->name }}</span>
                                </div>
                            </td>
                            <td>
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $skill->created_at->format('M d, Y') }}
                                </small>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.skills.edit', $skill) }}"
                                       class="btn btn-sm rounded-pill px-3"
                                       id="btn-edit-skill-{{ $skill->id }}"
                                       style="background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;font-weight:600;">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}"
                                          class="d-inline" id="delete-skill-{{ $skill->id }}"
                                          onsubmit="return confirm('Delete this skill? This may affect mentor profiles.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                            <i class="bi bi-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state m-2" id="empty-skills">
                                    <div class="empty-state-icon">
                                        <i class="bi bi-lightning"></i>
                                    </div>
                                    <h5>No Skills Found</h5>
                                    <p>Add skills that mentors can associate with their profiles.</p>
                                    <a href="{{ route('admin.skills.create') }}" class="btn btn-primary mt-3 rounded-pill px-4">
                                        <i class="bi bi-plus-lg me-2"></i>Add First Skill
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($skills->hasPages())
        <div class="card-footer bg-white border-top border-soft pt-3 px-4">
            {{ $skills->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@endsection
