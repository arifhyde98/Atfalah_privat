@extends('layouts.dashboard')

@section('page_title', 'Pendaftaran & Enrollments')
@section('page_subtitle', 'Kelola status pendaftaran santri ke dalam program belajar.')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Form Manual Enrollment -->
    <div class="lg:col-span-4 bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-4">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Daftarkan Santri Manual</h3>
        <form action="{{ route('admin.enrollments.store') }}" method="POST" class="space-y-3 text-xs">
            @csrf
            <div>
                <label class="font-semibold text-slate-700 block mb-1">Pilih Santri</label>
                <select name="student_id" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="">-- Pilih --</option>
                    @foreach($students as $std)
                        <option value="{{ $std->id }}">{{ $std->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Pilih Program</label>
                <select name="program_id" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="">-- Pilih --</option>
                    @foreach($programs as $prog)
                        <option value="{{ $prog->id }}">{{ $prog->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <button type="submit" class="w-full py-2.5 bg-primary-700 hover:bg-primary-800 text-white font-bold rounded-xl shadow transition-colors">
                Simpan Enrollment
            </button>
        </form>
    </div>

    <!-- Enrollments Table -->
    <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Daftar Enrollment</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4">Santri</th>
                        <th class="py-3.5 px-4">Program</th>
                        <th class="py-3.5 px-4">Tanggal Mulai</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($enrollments as $enr)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4 font-bold text-slate-900">{{ $enr->student->name }}</td>
                            <td class="py-4 px-4 font-medium text-slate-800">{{ $enr->program->name }}</td>
                            <td class="py-4 px-4">{{ \Carbon\Carbon::parse($enr->start_date)->format('d M Y') }}</td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $enr->status == 'active' ? 'bg-emerald-100 text-emerald-800' : ($enr->status == 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-800') }}">
                                    {{ ucfirst($enr->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-right">
                                @if($enr->status == 'pending')
                                    <form action="{{ route('admin.enrollments.updateStatus', $enr->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="active">
                                        <button type="submit" class="px-2.5 py-1 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-[10px] font-bold">
                                            Aktifkan
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">Belum ada enrollment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>
            {{ $enrollments->links() }}
        </div>
    </div>
</div>
@endsection