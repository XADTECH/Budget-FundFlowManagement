<form action="{{ route('supplier-import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="file" class="form-label">Upload Excel File</label>
        <input type="file" class="form-control" name="file" required>
    </div>
    <button type="submit" class="btn btn-primary">Import</button>
</form>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
