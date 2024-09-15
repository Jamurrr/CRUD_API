<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 w-25">
        <h1>Edit Company</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Company Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $company->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Company Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $company->email) }}">
            </div>

            <div class="mb-3">
                <label for="website" class="form-label">Company Website</label>
                <input type="url" name="website" id="website" class="form-control" value="{{ old('website', $company->website) }}">
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label">Company Logo (min. 100x100px)</label>
                <input type="file" name="logo" id="logo" class="form-control">

                @if ($company->logo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" style="width: 100px; height: auto;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Company</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
