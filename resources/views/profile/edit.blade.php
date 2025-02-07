<x-layout title="Edit Profile">
    <div class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-black text-white py-6 px-8">
            <h2 class="text-3xl font-semibold">Ubah Profil</h2>
        </div>

        <div class="p-8">
            @if ($errors->any())
                <div class="bg-red-50 border border-red-400 text-red-600 p-4 rounded-lg mb-6">
                    <ul class="mt-2 space-y-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                               class="mt-1 block w-full rounded-md shadow-sm border-2 border-gray-400 p-2">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                               class="mt-1 block w-full rounded-md shadow-sm border-2 border-gray-400 p-2">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                        <input type="password" name="password" id="password"
                               class="mt-1 block w-full rounded-md shadow-sm border-2 border-gray-400 p-2">
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="mt-1 block w-full rounded-md shadow-sm border-2 border-gray-400 p-2">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-black text-white font-medium py-2 px-6 rounded-md shadow-md">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
