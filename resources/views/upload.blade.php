<!DOCTYPE html>
<html>
<head>
    <title>Upload Dictionary</title>
</head>
<body>
<h1>Upload Dictionary</h1>
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif
<form action="{{ route('file.upload') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="dictionary" accept=".txt" required>
    <button type="submit">Upload</button>
</form>
</body>
</html>
