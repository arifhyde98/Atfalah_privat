@extends('layouts.dashboard')

@section('page_title', 'Executive Admin Dashboard')
@section('page_subtitle', 'Pantau seluruh aktivitas operasional, santri, dewan guru, dan keuangan platform.')

@section('content')
<div class="space-y-8">
    <!-- Key Metric Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs text-slate-500 font-medium">Total Students</div>
                <div class="text-2xl font-bold text-slate-900">{{ $stats['total_students'] }}</div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center">
                <i data-lucide="graduation-cap" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs text-slate-500 font-medium">Dewan Pengajar</div>
                <div class="text-2xl font-bold text-slate-900">{{ $stats['total_teachers'] }}</div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center">
                <i data-lucide="school" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs text-slate-500 font-medium">Kelas Berjalan</div>
                <div class="text-2xl font-bold text-slate-900">{{ $stats['active_classes'] }}</div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-teal-100 text-teal-700 flex items-center justify-center">
                <i data-lucide="credit-card" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs text-slate-500 font-medium">Total Pembayaran</div>
                <div class="text-xl font-bold text-slate-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <!-- 2 Columns: Recent Enrollments & Recent Payments -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Recent Enrollments -->
        <div class="lg:col-span-6 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-base font-bold text-slate-900">Pendaftaran Terbaru (Enrollment)</h3>
                <a href="{{ route('admin.enrollments.index') }}" class="text-xs font-bold text-primary-700 hover:underline">Lihat Semua</a>
            </div>

            <div class="divide-y divide-slate-100 text-xs">
                @forelse($recentEnrollments as $enr)
                    <div class="py-3 flex items-center justify-between">
                        <div>
                            <div class="font-bold text-slate-900">{{ $enr->student->name }}</div>
                            <div class="text-slate-500 text-[11px]">{{ $enr->program->name }}</div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $enr->status == 'active' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ ucfirst($enr->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 py-4 text-center">Belum ada data pendaftaran.</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Payments -->
        <div class="lg:col-span-6 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-base font-bold text-slate-900">Transaksi & Invoice Terbaru</h3>
                <a href="{{ route('admin.payments.index') }}" class="text-xs font-bold text-primary-700 hover:underline">Lihat Semua</a>
            </div>

            <div class="divide-y divide-slate-100 text-xs">
                @forelse($recentPayments as $pay)
                    <div class="py-3 flex items-center justify-between">
                        <div>
                            <div class="font-bold text-slate-900">{{ $pay->student->name }}</div>
                            <div class="font-mono text-[11px] text-slate-400">{{ $pay->invoice_number }}</div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-slate-900">Rp {{ number_format($pay->amount, 0, ',', '.') }}</div>
                            <span class="text-[10px] font-semibold {{ $pay->status == 'paid' ? 'text-emerald-600' : 'text-amber-600' }}">
                                {{ ucfirst($pay->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 py-4 text-center">Belum ada transaksi pembayaran.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection