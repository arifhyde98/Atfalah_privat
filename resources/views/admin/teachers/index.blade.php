@extends('layouts.dashboard')

@section('page_title', 'Manajemen Dewan Guru (Teachers)')
@section('page_subtitle', 'Kelola profil asatidz/asatidzah, spesialisasi, dan status keaktifan.')

@section('content')
<div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-base font-bold text-slate-900">Daftar Dewan Pengajar</h3>
            <p class="text-xs text-slate-500">Total: {{ $teachers->total() }} ustadz/ustadzah</p>
        </div>
        <a href="{{ route('admin.teachers.create') }}" class="px-4 py-2.5 rounded-xl bg-rose-700 hover:bg-rose-800 text-white font-bold text-xs shadow flex items-center gap-1.5 transition-colors">
            <i data-lucide="user-plus" class="w-4 h-4"></i> Tambah Pengajar Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-600">
            <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] border-b border-slate-200">
                <tr>
                    <th class="py-3.5 px-4">Nama & Email</th>
                    <th class="py-3.5 px-4">Spesialisasi</th>
                    <th class="py-3.5 px-4">WhatsApp</th>
                    <th class="py-3.5 px-4">Status</th>
                    <th class="py-3.5 px-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($teachers as $tch)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-4">
                            <div class="font-bold text-slate-900">{{ $tch->name }}</div>
                            <div class="text-slate-400 text-[11px]">{{ $tch->email }}</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="text-xs font-semibold text-primary-700">{{ $tch->teacherProfile->specialization ?? '-' }}</span>
                        </td>
                        <td class="py-4 px-4">{{ $tch->teacherProfile->phone ?? '-' }}</td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $tch->status == 'active' ? 'bg-rose-100 text-emerald-800' : 'bg-slate-100 text-slate-800' }}">
                                {{ ucfirst($tch->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-right">
                            <a href="{{ route('admin.teachers.edit', $tch->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-100 font-semibold text-[11px]">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-400">Belum ada data teacher.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $teachers->links() }}
    </div>
</div>
@endsection