<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Edit</title>
</head>
<body>
    <p>Edit Rental</p>
    <a href="{{ route('rental.index') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Back</a>
    <form action="{{ route('rental.update', $rental->id) }} " method="POST" enctype="multipart/form-data" style="display: flex;flex-direction: column">
        @csrf
        @method('PUT')
        <label for="user_id">Name</label>
        <input type="text" name="user_id" id="user_id" value="{{ old('user_id', $rental->user_id) }}" readonly>
        <label for="field_id">Field</label>
        <input type="text" name="field_id" id="field_id" value="{{ old('field_id', $rental->field_id) }}" readonly>
        {{-- <select name="field_id" id="field_id">
            @foreach($fields as $field)
                <option value="{{ $field->id }}" {{ old('field_id', $field->id) == $field->id ? 'selected' : '' }}>{{ $field->name }}</option>
            @endforeach
        </select> --}}
        <label for="status">Status</label>
        <input type="text" name="status" id="status" value="{{ old('status', $rental->status) }}" readonly>
        <label for="payment_status">Payment Status</label>
        <input type="text" name="payment_status" id="payment_status" value="{{ old('payment_status', $rental->payment_status) }}" readonly>
        <label for="payment_method">Payment Method</label>
        <select name="payment_method" id="payment_method" value="{{ old('payment_method', $rental->payment_method) }}">
            <option value="cash" {{ old('payment_method', 'cash') == 'cash' ? 'selected' : '' }}>Cash</option>
            <option value="midtrans" {{ old('payment_method', 'midtrans') == 'midtrans' ? 'selected' : '' }}>Midtrans</option>
        </select>
        <label for="start_time">Start Time</label>
        <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $rental->start_time) }}">
        <label for="end_time">End Time</label>
        <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $rental->end_time) }}">
        <label for="booking_date">Date</label>
        <input type="date" name="booking_date" id="booking_date" value="{{ old('booking_date', $rental->booking_date) }}">
        <button type="submit">Submit</button>
    </form>
</body>
</html>