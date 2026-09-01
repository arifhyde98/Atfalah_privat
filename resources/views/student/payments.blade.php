@extends('layouts.dashboard')

@section('page_title', 'Tagihan & Riwayat Pembayaran')
@section('page_subtitle', 'Informasi invoice dan status pembayaran paket belajar.')

@section('content')
<div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-600">
            <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] border-b border-slate-200">
                <tr>
                    <th class="py-3.5 px-4">Nomor Invoice</th>
                    <th class="py-3.5 px-4">Program Belajar</th>
                    <th class="py-3.5 px-4">Nominal</th>
                    <th class="py-3.5 px-4">Status</th>
                    <th class="py-3.5 px-4">Jatuh Tempo</th>
                    <th class="py-3.5 px-4">Waktu Lunas</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($payments as $pay)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-4 font-mono font-bold text-slate-900">{{ $pay->invoice_number }}</td>
                        <td class="py-4 px-4 font-medium text-slate-800">{{ $pay->enrollment->program->name ?? 'Paket Pembelajaran' }}</td>
                        <td class="py-4 px-4 font-bold text-slate-900">Rp {{ number_format($pay->amount, 0, ',', '.') }}</td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $pay->status == 'paid' ? 'bg-rose-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ ucfirst($pay->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-4">{{ $pay->due_date ? \Carbon\Carbon::parse($pay->due_date)->format('d M Y') : '-' }}</td>
                        <td class="py-4 px-4 text-emerald-700 font-medium">{{ $pay->paid_at ? \Carbon\Carbon::parse($pay->paid_at)->format('d M Y H:i') : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-400">Belum ada catatan invoice pembayaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $payments->links() }}
    </div>
</div>
@endsection