@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-4 sm:py-6 lg:py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 sm:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Invoice #{{ str_pad($invoice->id, 4, '0', STR_PAD_LEFT) }}</h1>
                    <p class="text-gray-600 mt-1 text-sm sm:text-base">Dibuat pada {{ $invoice->created_at->format('d M Y, H:i') }}</p>
                </div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg">
                <div class="flex">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
                <div class="flex">
                    <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Status and Actions -->
        <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-4 sm:mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Aksi Invoice</p>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    <a href="{{ route('invoices.download', $invoice) }}" 
                       class="inline-flex justify-center items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Unduh PDF
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
            <!-- Customer Information -->
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Informasi Pelanggan
                </h2>
                <dl class="space-y-3">
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm font-medium text-gray-600">Nama:</dt>
                        <dd class="text-sm text-gray-900 font-semibold">{{ $invoice->customer_name }}</dd>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm font-medium text-gray-600">Nomor ID:</dt>
                        <dd class="text-sm text-gray-900">{{ $invoice->id_number ?: '-' }}</dd>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm font-medium text-gray-600">Telepon:</dt>
                        <dd class="text-sm text-gray-900">{{ $invoice->phone ?: '-' }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-600 mb-1">Alamat:</dt>
                        <dd class="text-sm text-gray-900">{{ $invoice->address ?: '-' }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Rental Information -->
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Detail Rental
                </h2>
                <dl class="space-y-3">
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm font-medium text-gray-600">Tanggal Sewa:</dt>
                        <dd class="text-sm text-gray-900">{{ $invoice->start_date ? \Carbon\Carbon::parse($invoice->start_date)->format('d M Y') : '-' }}</dd>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm font-medium text-gray-600">Tanggal Kembali:</dt>
                        <dd class="text-sm text-gray-900">{{ $invoice->end_date ? \Carbon\Carbon::parse($invoice->end_date)->format('d M Y') : '-' }}</dd>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm font-medium text-gray-600">Tipe Motor:</dt>
                        <dd class="text-sm text-gray-900 font-semibold">{{ $invoice->motor_type ?: '-' }}</dd>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm font-medium text-gray-600">Nomor Plat:</dt>
                        <dd class="text-sm text-gray-900 font-semibold">{{ $invoice->plate_number ?: '-' }}</dd>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm font-medium text-gray-600">Tempat Pengiriman:</dt>
                        <dd class="text-sm text-gray-900">{{ $invoice->delivery_place ?: '-' }}</dd>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <dt class="text-sm font-medium text-gray-600">Tempat Pengambilan:</dt>
                        <dd class="text-sm text-gray-900">{{ $invoice->pickup_place ?: '-' }}</dd>
                    </div>
                    <div class="flex justify-between py-2">
                        <dt class="text-sm font-medium text-gray-600">Jaminan:</dt>
                        <dd class="text-sm text-gray-900">{{ $invoice->guarantee ?: '-' }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Equipment -->
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Perlengkapan & Level Bensin
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm text-gray-700">Helm: <strong>{{ $invoice->helmets }}</strong></span>
                    </div>
                    <div class="flex items-center p-3 {{ $invoice->raincoat ? 'bg-green-50' : 'bg-gray-50' }} rounded-lg">
                        @if($invoice->raincoat)
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                        <span class="text-sm {{ $invoice->raincoat ? 'text-green-700 font-semibold' : 'text-gray-500' }}">Jas Hujan</span>
                    </div>
                    <div class="flex items-center p-3 {{ $invoice->phone_holder ? 'bg-green-50' : 'bg-gray-50' }} rounded-lg">
                        @if($invoice->phone_holder)
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                        <span class="text-sm {{ $invoice->phone_holder ? 'text-green-700 font-semibold' : 'text-gray-500' }}">Holder HP</span>
                    </div>
                    <div class="flex items-center p-3 {{ $invoice->disk_lock ? 'bg-green-50' : 'bg-gray-50' }} rounded-lg">
                        @if($invoice->disk_lock)
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                        <span class="text-sm {{ $invoice->disk_lock ? 'text-green-700 font-semibold' : 'text-gray-500' }}">Kunci Disk</span>
                    </div>
                </div>
                
                <!-- Fuel Level Display -->
                <div class="mt-4 p-4 bg-purple-50 rounded-lg border border-purple-200">
                    <p class="text-sm font-medium text-gray-700 mb-2">Level Bensin:</p>
                    <div class="flex items-end space-x-2 h-20">
                        @php
                            $fuelLevel = $invoice->fuel_level ?? 4;
                            $levels = [
                                1 => ['height' => 'h-4', 'label' => 'E'],
                                2 => ['height' => 'h-8', 'label' => '1/4'],
                                3 => ['height' => 'h-12', 'label' => '1/2'],
                                4 => ['height' => 'h-16', 'label' => '3/4'],
                                5 => ['height' => 'h-20', 'label' => 'F'],
                            ];
                        @endphp
                        @for($i = 1; $i <= 5; $i++)
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full {{ $levels[$i]['height'] }} rounded-t-lg {{ $i <= $fuelLevel ? 'bg-purple-600' : 'bg-gray-300' }}"></div>
                                <span class="text-xs font-medium text-gray-600 mt-1 {{ $i == $fuelLevel ? 'text-purple-700 font-bold' : '' }}">{{ $levels[$i]['label'] }}</span>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Financial -->
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Detail Keuangan
                </h2>
                <dl class="space-y-3">
                    <div class="flex justify-between py-3 border-b border-gray-100">
                        <dt class="text-sm font-medium text-gray-600">Biaya Sewa:</dt>
                        <dd class="text-sm text-gray-900 font-semibold">Rp {{ number_format($invoice->rental_fee ?? 0, 0, ',', '.') }}</dd>
                    </div>
                    <div class="flex justify-between py-3 border-b border-gray-100">
                        <dt class="text-sm font-medium text-gray-600">DP:</dt>
                        <dd class="text-sm text-gray-900 font-semibold">Rp {{ number_format($invoice->down_payment ?? 0, 0, ',', '.') }}</dd>
                    </div>
                    <div class="flex justify-between py-3 bg-purple-50 px-4 rounded-lg">
                        <dt class="text-base font-bold text-purple-900">Sisa Pembayaran:</dt>
                        <dd class="text-base text-purple-900 font-bold">Rp {{ number_format((($invoice->rental_fee ?? 0) - ($invoice->down_payment ?? 0)), 0, ',', '.') }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Physical Check -->
        @if($invoice->cek_lampu_depan || $invoice->cek_lampu_belakang || $invoice->cek_lampu_signal_kanan || $invoice->cek_lampu_signal_kiri || $invoice->cek_kaca_spion)
        <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mt-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
                Physical Check (Cek Fisik)
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <div class="flex items-center p-3 {{ $invoice->cek_lampu_depan ? 'bg-green-50' : 'bg-gray-50' }} rounded-lg">
                    <span class="text-2xl mr-2">{{ $invoice->cek_lampu_depan ? '☑' : '☐' }}</span>
                    <span class="text-sm {{ $invoice->cek_lampu_depan ? 'text-green-700 font-semibold' : 'text-gray-500' }}">Lampu Depan</span>
                </div>
                <div class="flex items-center p-3 {{ $invoice->cek_lampu_belakang ? 'bg-green-50' : 'bg-gray-50' }} rounded-lg">
                    <span class="text-2xl mr-2">{{ $invoice->cek_lampu_belakang ? '☑' : '☐' }}</span>
                    <span class="text-sm {{ $invoice->cek_lampu_belakang ? 'text-green-700 font-semibold' : 'text-gray-500' }}">Lampu Belakang</span>
                </div>
                <div class="flex items-center p-3 {{ $invoice->cek_lampu_signal_kanan ? 'bg-green-50' : 'bg-gray-50' }} rounded-lg">
                    <span class="text-2xl mr-2">{{ $invoice->cek_lampu_signal_kanan ? '☑' : '☐' }}</span>
                    <span class="text-sm {{ $invoice->cek_lampu_signal_kanan ? 'text-green-700 font-semibold' : 'text-gray-500' }}">Signal Kanan</span>
                </div>
                <div class="flex items-center p-3 {{ $invoice->cek_lampu_signal_kiri ? 'bg-green-50' : 'bg-gray-50' }} rounded-lg">
                    <span class="text-2xl mr-2">{{ $invoice->cek_lampu_signal_kiri ? '☑' : '☐' }}</span>
                    <span class="text-sm {{ $invoice->cek_lampu_signal_kiri ? 'text-green-700 font-semibold' : 'text-gray-500' }}">Signal Kiri</span>
                </div>
                <div class="flex items-center p-3 {{ $invoice->cek_kaca_spion ? 'bg-green-50' : 'bg-gray-50' }} rounded-lg">
                    <span class="text-2xl mr-2">{{ $invoice->cek_kaca_spion ? '☑' : '☐' }}</span>
                    <span class="text-sm {{ $invoice->cek_kaca_spion ? 'text-green-700 font-semibold' : 'text-gray-500' }}">Kaca Spion</span>
                </div>
            </div>
        </div>
        @endif

        <!-- Notes -->
        @if($invoice->other_notes)
        <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mt-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Catatan Tambahan
            </h2>
            <p class="text-gray-700 whitespace-pre-wrap">{{ $invoice->other_notes }}</p>
        </div>
        @endif
    </div>
</div>
@endsection
