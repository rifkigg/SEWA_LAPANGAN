<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fields</title>
</head>
<body>
    <a href="{{ route('field.create') }}">Tambah Lapangan</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Location</th>
            <th>Description</th>
            <th>Owner</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        @foreach ($fields as $field)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $field->name }}</td>
                <td>{{ $field->price }}</td>
                <td>{{ $field->location }}</td>
                <td>{{ $field->description }}</td>
                <td>{{ $field->owner->username }}</td>
                <td><img src="{{ asset('storage/' . $field->image) }}" alt="{{ $field->image }}"></td>
                <td>
                    <form action="{{ route('field.destroy', $field->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini?');">
                        <a href="{{ route('field.edit', $field->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table> 
</body>
</html>