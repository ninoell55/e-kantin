<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    {{-- Letakkan di bawah @include('sweetalert::alert') pada layout master --}}
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Ambil semua pesan error validasi dari Laravel dan gabungkan dengan baris baru (\n)
                let errorMessages = `{!! implode('\n', $errors->all()) !!}`;

                // Cek apakah mode gelap aktif
                const isDark = document.documentElement.classList.contains("dark");

                window.Swal.fire({
                    title: `<span class="text-xl font-black uppercase tracking-tight text-red-600">Gagal Validasi!</span>`,
                    html: `<pre class="text-[11px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest leading-relaxed mt-3 text-left bg-gray-50 dark:bg-gray-900 p-4 rounded-2xl border border-gray-100 dark:border-gray-800 font-sans whitespace-pre-line">${errorMessages}</pre>`,
                    icon: "error",
                    iconColor: "#730f00", // Warna marun Foody untuk error
                    confirmButtonText: "PERBAIKI DATA",
                    background: isDark ? "#030712" : "#ffffff",
                    color: isDark ? "#ffffff" : "#111827",
                    customClass: {
                        popup: "rounded-[2.5rem] border border-gray-100 dark:border-gray-900 shadow-2xl p-7 max-w-md",
                        confirmButton: "w-full px-6 py-3.5 text-[10px] font-black uppercase tracking-widest rounded-2xl text-white bg-[#730f00] hover:bg-[#590c00] border-0 transition-all duration-200 active:scale-95 focus:ring-0",
                    },
                    buttonsStyling: false
                });
            });
        </script>
    @endif

    @yield('navigation')
    @include('sweetalert::alert')

    <main>
        @yield('content')
    </main>
</body>

</html>
