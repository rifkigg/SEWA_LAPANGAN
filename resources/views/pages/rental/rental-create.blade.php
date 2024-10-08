<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Create</title>
</head>
<body>
    <p>Create Rental</p>
    <a href="{{ route('rental.index') }}" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Back</a>
    <form action="{{ route('rental.store') }} " method="POST" enctype="multipart/form-data">
        @csrf
        <label for="user_id">Name</label>
        <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" readonly>
        <label for="field_id">Field</label>
        <select name="field_id" id="field_id">
            @foreach($fields as $field)
                <option value="{{ $field->id }}">{{ $field->name }}</option>
            @endforeach
        </select>
        <label for="status">Status</label>
        <input type="text" name="status" id="status" value="pending" readonly>
        <label for="payment_status">Payment Status</label>
        <input type="text" name="payment_status" id="payment_status" value="unpaid" readonly>
        <label for="payment_method">Payment Method</label>
        <select name="payment_method" id="payment_method">
            <option value="cash">Cash</option>
            <option value="midtrans">Midtrans</option>
        </select>
        <label for="start_time">Start Time</label>
        <input type="time" name="start_time" id="start_time">
        <label for="end_time">End Time</label>
        <input type="time" name="end_time" id="end_time">
        <label for="booking_date">Date</label>
        <input type="date" name="booking_date" id="booking_date">
        <button type="submit">Submit</button>
    </form>
</body>
</html>