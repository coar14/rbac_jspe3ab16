@extends('mainLayout')

@section('title', 'Manage Users')

@section('page-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('dash') }}" class="btn btn-secondary mb-3">Back</a>
            <h2>Manage Users</h2>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <form action="{{ route('admin.updateUserRoles', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="role-{{ $role->id }}-user-{{ $user->id }}" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role-{{ $role->id }}-user-{{ $user->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                                @endforeach
                            </td>
                            <td>
                                <button type="submit" class="btn btn-success">Update Roles</button>
                            </td>
                        </form>
                        <td>
                            <a href="{{ route('admin.editUserPermissions', $user->id) }}" class="btn btn-warning">Edit Permissions</a>
                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
