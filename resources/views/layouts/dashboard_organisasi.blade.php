<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SKPI UNAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a',
                    },
                },
            },
        };
    </script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
</head>

<body class="bg-white text-black dark:bg-gray-900 dark:text-white transition-all">
    <div class="flex flex-col min-h-screen">
        <!-- Konten Utama Tanpa Sidebar dan Footer -->
        <main class="p-6 flex-1 bg-white dark:bg-gray-800 rounded-lg shadow-inner">
            @yield('content')
        </main>
    </div>

    <script src="https://unpkg.com/alpinejs" defer></script>
</body>

</html>
