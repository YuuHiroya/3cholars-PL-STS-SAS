<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FAFAFA] min-h-screen flex flex-col items-center justify-center px-6">

    <!-- Logo -->
    <div class="mb-6">
        <img src="/image/Logo.png" alt="3cholars Logo" class="w-16 mx-auto">
    </div>

    <!-- Title -->
    <h1 class="text-2xl md:text-3xl font-bold text-center text-[#0d47a1] mb-3">
        Forgot Your Password?
    </h1>

    <!-- Description -->
    <p class="text-center text-[#838383] mb-4 max-w-3xl">
        Forgot your password? No problem. Just let us know your email address and we will
        email you a password reset link that will allow you to choose a new one.
    </p>

    <!-- Form -->
    <form action="{{ route('password.email') }}" method="POST" class="w-full max-w-md space-y-4">
        @csrf
        <!-- Email -->
        <div>
            <label for="email" class="block mb-1 text-gray-800 font-medium">Email</label>
            <input id="email" name="email" type="email" required placeholder="e.g email@gmail.com"
                class="block w-full rounded-md border-gray-300 focus:border-[#1565c0] focus:ring-[#1565c0]">
        </div>

        <!-- Button -->
        <div>
            <button type="submit"
                class="w-full py-3 bg-[#1565c0] text-[#FAFAFA] font-semibold rounded-md shadow-md hover:bg-[#0d47a1] transition">
                Send Email
            </button>
        </div>
    </form>

    <!-- ✅ Popup Berhasil -->
    @if (session('status'))
        <div id="popup-success" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-xl shadow-lg p-6 text-center max-w-sm">
                <h2 class="text-lg font-bold text-green-600 mb-2">Berhasil</h2>
                <p class="text-gray-700">{{ session('status') }}</p>
            </div>
        </div>

        <script>
            setTimeout(() => {
                window.location.href = "{{ route('login') }}"; // redirect ke login
            }, 2000);
        </script>
    @endif

    <!-- ❌ Popup Gagal -->
    @if ($errors->has('email'))
        <div id="popup-error" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-xl shadow-lg p-6 text-center max-w-sm">
                <h2 class="text-lg font-bold text-red-600 mb-2">Gagal</h2>
                <p class="text-gray-700">{{ $errors->first('email') }}</p>
            </div>
        </div>

        <script>
            setTimeout(() => {
                window.location.href = "{{ route('login') }}"; // redirect ke login
            }, 2000);
        </script>
    @endif


</body>

</html>