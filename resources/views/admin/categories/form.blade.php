<div class="form-group">
    <label>Name</label>
    <input 
        type="text" 
        name="name" 
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $category->name ?? '') }}"
    >

    @error('name')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label>Description</label>
    <textarea 
        name="description" 
        class="form-control @error('description') is-invalid @enderror"
        rows="4"
    >{{ old('description', $category->description ?? '') }}</textarea>

    @error('description')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label>Status</label>
    <select name="status" class="form-control @error('status') is-invalid @enderror">
        <option value="1" {{ old('status', $category->status ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>
        <option value="0" {{ old('status', $category->status ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>
    </select>

    @error('status')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>