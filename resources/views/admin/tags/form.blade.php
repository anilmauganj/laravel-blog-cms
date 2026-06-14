<div class="form-group">
    <label>Name</label>

    <input
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', optional($tag ?? null)->name) }}"
    >

    @error('name')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label>Status</label>

    <select name="status" class="form-control @error('status') is-invalid @enderror">
        <option value="1" {{ old('status', optional($tag ?? null)->status ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>

        <option value="0" {{ old('status', optional($tag ?? null)->status ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>
    </select>

    @error('status')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>