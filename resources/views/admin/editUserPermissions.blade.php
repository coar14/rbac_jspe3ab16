@extends('mainLayout')

@section('title', 'Edit User Permissions')

@section('page-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('usertool') }}" class="btn btn-secondary mb-3">Back</a>
            <h2>Edit Permissions for {{ $user->name }}</h2>
            <form action="{{ route('admin.updateUserPermissions', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                @foreach ($permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="permission-{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" {{ $user->roles->flatMap->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                        {{ $permission->name }}
                    </label>
                </div>
                @endforeach
                <button type="submit" class="btn btn-success mt-3"> Update Permissions</button>
            </form>
        </div>
    </div>
</div>
@endsection
