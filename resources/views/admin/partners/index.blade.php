@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-slate-900">Manajemen Partner</h1>
            <a href="{{ route('admin.partners.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition">
                + Tambah Partner
            </a>
        </div>

        <!-- Flash Messages -->
        @if ($message = Session::get('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ $message }}
            </div>
        @endif

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.partners.index') }}" class="bg-white rounded-lg p-4 shadow-sm border">
            <div class="flex gap-2">
                <input type="text" name="search" placeholder="Cari nama partner..." value="{{ $search }}"
                    class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition">
                    Cari
                </button>
                @if ($search)
                    <a href="{{ route('admin.partners.index') }}"
                        class="bg-slate-400 hover:bg-slate-500 text-white px-4 py-2 rounded-lg font-medium transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-sm font-semibold text-slate-700">No</th>
                        <th class="px-6 py-3 text-sm font-semibold text-slate-700">Logo</th>
                        <th class="px-6 py-3 text-sm font-semibold text-slate-700">Nama Partner</th>
                        <th class="px-6 py-3 text-sm font-semibold text-slate-700">Dibuat</th>
                        <th class="px-6 py-3 text-sm font-semibold text-slate-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($partners as $partner)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm">
                                {{ ($partners->currentPage() - 1) * $partners->perPage() + $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm">
                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                                    class="h-12 w-12 object-contain rounded">
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $partner->name }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $partner->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm flex gap-2">
                                <a href="{{ route('admin.partners.edit', $partner->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm font-medium transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Yakin hapus partner ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm font-medium transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                Belum ada data partner
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $partners->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
