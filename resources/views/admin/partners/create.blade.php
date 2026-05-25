@extends('layouts.admin')

@section('content')
    <div class="space-y-6 max-w-2xl">
        <!-- Header -->
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Tambah Partner Baru</h1>
            <p class="text-slate-600 mt-2">Isi formulir di bawah untuk menambahkan partner baru</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <form action="{{ route('admin.partners.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nama Partner -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-900 mb-2">
                        Nama Partner <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" placeholder="Contoh: PT. ABC Indonesia"
                        value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                        required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Logo URL -->
                <div>
                    <label for="logo_url" class="block text-sm font-medium text-slate-900 mb-2">
                        Logo URL <span class="text-red-500">*</span>
                    </label>
                    <input type="url" id="logo_url" name="logo_url" placeholder="https://example.com/logo.png"
                        value="{{ old('logo_url') }}"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('logo_url') border-red-500 @enderror"
                        required>
                    @error('logo_url')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-slate-500 text-sm mt-2">Preview akan ditampilkan di homepage</p>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition">
                        Simpan Partner
                    </button>
                    <a href="{{ route('admin.partners.index') }}"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-900 px-6 py-2 rounded-lg font-medium transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
