<!DOCTYPE html>
<html>
<head>
    <title>Tailwind Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Test different Tailwind classes -->
    <div class="bg-blue-500 text-white p-8 m-4 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-4">Tailwind CSS Test</h1>
        <p class="text-lg">Jodi ei text blue background e white color e dekhen, tahole Tailwind working!</p>
    </div>

    <div class="bg-green-400 p-4 m-4 rounded">
        <p class="text-gray-800 font-semibold">Green box - Tailwind responsive!</p>
    </div>

    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300">
        Hover Effect Test
    </button>
</body>
</html>
