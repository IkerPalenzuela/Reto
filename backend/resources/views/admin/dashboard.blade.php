<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control de Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h4 class="text-sm font-medium text-gray-500 uppercase">Usuarios del Sistema</h4>
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalUsers }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h4 class="text-sm font-medium text-gray-500 uppercase">Juegos en BD</h4>
                    <p class="text-3xl font-bold text-green-600">{{ $totalGames }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow border-2 border-indigo-200">
                    <h4 class="text-sm font-medium text-gray-500 uppercase font-bold text-indigo-800">Estado API Reseñas</h4>
                    <p class="text-3xl font-bold text-blue-500">Activa</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2 text-indigo-700">Gestión de Contenidos</h3>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="border p-4 rounded bg-gray-50">
                            <h4 class="font-bold mb-2">Últimos Usuarios Registrados</h4>
                            <ul class="text-sm space-y-2">
                                @forelse($latestUsers as $user)
                                    <li class="flex justify-between items-center border-b pb-1">
                                        <div>
                                            <span class="font-medium">{{ $user->name }}</span>
                                            <span class="text-xs text-gray-400 ml-2">({{ $user->email }})</span>
                                        </div>
                                        <span class="text-xs bg-gray-200 px-2 py-1 rounded">
                                            {{ $user->created_at->diffForHumans() }}
                                        </span>
                                    </li>
                                @empty
                                    <li class="text-gray-500 italic">No hay usuarios registrados aún.</li>
                                @endforelse
                            </ul>
                            <div class="mt-4 space-x-2">
                                <button class="bg-blue-600 text-white px-3 py-1 rounded text-xs opacity-50 cursor-not-allowed">Añadir</button>
                                <button class="bg-red-600 text-white px-3 py-1 rounded text-xs opacity-50 cursor-not-allowed">Eliminar</button>
                            </div>
                        </div>

                        <div class="border p-4 rounded bg-gray-50">
                            <h4 class="font-bold mb-2">Mantenimiento de Datos</h4>
                            <p class="text-xs text-gray-600 mb-4">Control de videojuegos, empresas (1:N) y géneros (N:M).</p>
                            <div class="flex flex-col space-y-2">
                                <a href="{{ route('games') }}" class="inline-flex items-center text-sm text-indigo-600 hover:underline">
                                    → Ver catálogo completo de juegos
                                </a>
                                <a href="{{ route('companies.index') }}" class="inline-flex items-center text-sm text-indigo-600 hover:underline">
                                    → Ver catálogo de empresas
                                </a>
                                <a href="#" class="inline-flex items-center text-sm text-indigo-600 hover:underline font-bold text-blue-700">
                                    → Configuración de API de Reseñas (Punto PD5)
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 p-4 bg-yellow-50 border-l-4 border-yellow-400 text-sm">
                        <p class="text-yellow-700 font-bold">Nota del Desarrollador:</p>
                        <p class="text-yellow-600 italic">Este panel visualiza el estado real del sistema conectado a la base de datos MariaDB/MySQL.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>