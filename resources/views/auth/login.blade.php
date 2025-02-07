<x-layout>
    <h1 class="text-2xl font-semibold text-gray-700 text-center mb-6">Masuk Akun</h1>
    <div class="max-w-md mx-auto bg-white shadow-md rounded-md p-6">
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            @error('error')
            <p class=" text-xs text-red-500">{{$message}}</p>
            @enderror
            {{-- Email --}}
            <div>
                <label for="email" class="block text-gray-700 font-medium">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-gray-700 font-medium">Kata sandi</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me and Forgot Password --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Ingat Saya</label>
                </div>
                <a href="#" class="text-sm text-blue-600 hover:underline">Lupa Kata Sandi?</a>
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Masuk
            </button>
        </form>
    </div>
</x-layout>
