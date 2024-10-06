<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Lapangan</title>
</head>
<body>
    <p>Edit Lapangan</p>
    <form action="{{ route('field.update', $fields->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $fields->name) }}">
        <label for="price">Price</label>
        <input type="text" name="price" id="price" value="{{ old('price', $fields->price) }}">
        <label for="location">Location</label>
        <input type="text" name="location" id="location" value="{{ old('location', $fields->location) }}">
        <label for="description">Description</label>
        <input type="text" name="description" id="description" value="{{ old('description', $fields->description) }}">
        <label for="owner">Owner</label>
        <input type="text" name="owner_id" id="owner_id" value="{{ old('owner_id', $fields->owner_id) }}">
        <label for="image">Image</label>
        <input type="file" name="image" id="image">
        <button type="submit">Submit</button>
    </form>
</body>
</html>