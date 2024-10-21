<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="roles">Assign Role</label>
        <select name="roles[]" class="form-control" multiple>
            @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Update User</button>
</form>
