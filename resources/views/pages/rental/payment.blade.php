<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
</head>
<body>
    <h1>Payment</h1>
    <button id="pay-button">Bayar</button>

    <script>
        document.getElementById('pay-button').onclick = function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert('Pembayaran berhasil!');
                    // Update status pembayaran di server
                    fetch(`/rental/update-payment-status/${result.order_id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ payment_status: 'paid' })
                    }).then(response => {
                        if (response.ok) {
                            window.location.href = '/'; // Redirect ke home
                        }
                    });
                },
                onPending: function(result) {
                    alert('Menunggu pembayaran.');
                },
                onError: function(result) {
                    alert('Pembayaran gagal.');
                },
                onClose: function() {
                    alert('Popup ditutup.');
                }
            });
        };
    </script>
</body>
</html>
