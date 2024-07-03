@extends('mainLayout')

@section('title', 'Edit User Roles')

@section('page-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('usertool') }}" class="btn btn-secondary mb-3">Back</a>
            <h2>Edit Roles for {{ $user->name }}</h2>
            <form action="{{ route('admin.updateUserRoles', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                @foreach ($roles as $role)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="role-{{ $role->id }}">
                        {{ $role->name }}
                    </label>
                </div>
                @endforeach
                <button type="submit" class="btn btn-success mt-3">Update Roles</button>
            </form>
        </div>
    </div>
</div>
@endsection
