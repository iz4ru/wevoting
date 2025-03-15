<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Wevoting</title> <!-- Pastikan ini muncul lebih dulu -->

    <!-- Redirect lebih awal agar tidak ada render delay -->
    <meta http-equiv="refresh" content="0; url={{ route('register.admin') }}">
    
    <script>
        document.title = "Admin - Wevoting"; // Set title paksa sebelum redirect
        window.location.href = "{{ route('register.admin') }}";
    </script>
</head>
<body>
</body>
</html>
