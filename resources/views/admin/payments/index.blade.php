@extends('layouts.dashboard')

@section('page_title', 'Manajemen Keuangan & Invoice')
@section('page_subtitle', 'Terbitkan tagihan pembayaran paket belajar dan catat konfirmasi.')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Generate Invoice Form -->
    <div class="lg:col-span-4 bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-4">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Terbitkan Invoice Baru</h3>
        <form action="{{ route('admin.payments.store') }}" method="POST" class="space-y-3 text-xs">
            @csrf
            <div>
                <label class="font-semibold text-slate-700 block mb-1">Pilih Santri *</label>
                <select name="student_id" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="">-- Pilih Santri --</option>
                    @foreach($students as $std)
                        <option value="{{ $std->id }}">{{ $std->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Nominal Tagihan (Rp) *</label>
                <input type="number" name="amount" placeholder="750000" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Tanggal Jatuh Tempo</label>
                <input type="date" name="due_date" value="{{ date('Y-m-d', strtotime('+7 days')) }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Metode Pembayaran</label>
                <input type="text" name="payment_method" placeholder="Bank Transfer (BSI / Mandiri)" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="pending">Pending (Belum Lunas)</option>
                    <option value="paid">Paid (Lunas)</option>
                </select>
            </div>

            <button type="submit" class="w-full py-2.5 bg-primary-700 hover:bg-primary-800 text-white font-bold rounded-xl shadow transition-colors">
                Terbitkan Invoice
            </button>
        </form>
    </div>

    <!-- Payments Table -->
    <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Daftar Seluruh Invoice Tagihan</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4">Invoice</th>
                        <th class="py-3.5 px-4">Santri</th>
                        <th class="py-3.5 px-4">Nominal</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($payments as $pay)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4 font-mono font-bold text-slate-900">{{ $pay->invoice_number }}</td>
                            <td class="py-4 px-4 font-medium text-slate-800">{{ $pay->student->name }}</td>
                            <td class="py-4 px-4 font-bold text-slate-900">Rp {{ number_format($pay->amount, 0, ',', '.') }}</td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $pay->status == 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ ucfirst($pay->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-right">
                                @if($pay->status == 'pending')
                                    <form action="{{ route('admin.payments.updateStatus', $pay->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="paid">
                                        <button type="submit" class="px-2.5 py-1 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-[10px] font-bold">
                                            Tandai Lunas
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">Belum ada tagihan invoice.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>
            {{ $payments->links() }}
        </div>
    </div>
</div>
@endsection