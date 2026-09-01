@extends('layouts.dashboard')

@section('page_title', 'Manajemen Data Students')
@section('page_subtitle', 'Kelola data seluruh santri, status keaktifan, dan profil.')

@section('content')
<div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-base font-bold text-slate-900">Daftar Student Terdaftar</h3>
            <p class="text-xs text-slate-500">Total: {{ $students->total() }} santri</p>
        </div>
        <a href="{{ route('admin.students.create') }}" class="px-4 py-2.5 rounded-xl bg-rose-700 hover:bg-rose-800 text-white font-bold text-xs shadow flex items-center gap-1.5 transition-colors">
            <i data-lucide="user-plus" class="w-4 h-4"></i> Tambah Student Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-600">
            <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] border-b border-slate-200">
                <tr>
                    <th class="py-3.5 px-4">Nama & Email</th>
                    <th class="py-3.5 px-4">WhatsApp</th>
                    <th class="py-3.5 px-4">Program Aktif</th>
                    <th class="py-3.5 px-4">Status</th>
                    <th class="py-3.5 px-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($students as $std)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-4">
                            <div class="font-bold text-slate-900">{{ $std->name }}</div>
                            <div class="text-slate-400 text-[11px]">{{ $std->email }}</div>
                        </td>
                        <td class="py-4 px-4">{{ $std->studentProfile->phone ?? '-' }}</td>
                        <td class="py-4 px-4">
                            @if($std->enrollments->count() > 0)
                                <span class="font-semibold text-primary-700">{{ $std->enrollments->first()->program->name }}</span>
                            @else
                                <span class="text-slate-400 italic">-</span>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $std->status == 'active' ? 'bg-rose-100 text-emerald-800' : 'bg-slate-100 text-slate-800' }}">
                                {{ ucfirst($std->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-right">
                            <a href="{{ route('admin.students.edit', $std->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-100 font-semibold text-[11px]">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-400">Belum ada data student.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $students->links() }}
    </div>
</div>
@endsection