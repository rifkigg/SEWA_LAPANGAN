<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Lapangan</title>
</head>
<body>
    <a href="{{ route('field.index') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Back</a>
    <p>Tambah Lapangan</p>
    <form action="{{ route('field.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <label for="price">Price</label>
        <input type="text" name="price" id="price">
        <label for="location">Location</label>
        <input type="text" name="location" id="location">
        <label for="description">Description</label>
        <input type="text" name="description" id="description">
        <label for="owner">Owner</label>
        <select name="owner_id" id="owner_id">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->username }}</option>
            @endforeach
        </select>
        <label for="image">Image</label>
        <input type="file" name="image" id="image">
        <button type="submit">Submit</button>
    </form>
</body>
</html>