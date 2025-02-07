<x-layout>
    <h1 class="text-2xl font-semibold text-gray-700 text-center mb-6">Daftar Akun</h1>
    <div class="max-w-md mx-auto bg-white shadow-md rounded-md p-6">
        <form action="{{route('register')}}" method="POST" class="space-y-4">
            @csrf
            {{-- Username --}}
            <div>
                <label for="name" class="block text-gray-700 font-medium">Nama</label>
                <input type="text" name="name" id="name" value="{{old('name')}}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name')
                        <p class=" text-xs text-red-500">{{$message}}</p>
                    @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-gray-700 font-medium">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{old('email')}}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email')
                        <p class=" text-xs text-red-500">{{$message}}</p>
                    @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-gray-700 font-medium">Kata sandi</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password')
                        <p class=" text-xs text-red-500">{{$message}}</p>
                    @enderror
            </div>

            {{-- Confirm Password --}}
            <div>
                <label for="password_confirmation" class="block text-gray-700 font-medium">Konfirmasi Kata sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Daftar
            </button>
        </form>
    </div>
</x-layout>
