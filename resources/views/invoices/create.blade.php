@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-4 sm:py-6 lg:py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 sm:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Buat Invoice Baru</h1>
                    <p class="text-gray-600 mt-1 text-sm sm:text-base">Isi detail rental di bawah ini</p>
                </div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
                <div class="flex">
                    <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-red-800 mb-2">Please fix the following errors:</h3>
                        <ul class="list-disc list-inside text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf

            <!-- Customer Information -->
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-lg sm:text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Informasi Pelanggan
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Penyewa <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_penyewa" value="{{ old('nama_penyewa') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                            placeholder="John Doe" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. KTP/SIM</label>
                        <input type="text" name="no_ktp" value="{{ old('no_ktp') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                            placeholder="3201234567890001">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                            placeholder="08123456789">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <textarea name="alamat" rows="2" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                            placeholder="Jl. Contoh No. 123, Jakarta">{{ old('alamat') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Rental Details -->
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Detail Rental
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Sewa</label>
                        <input type="text" id="tanggal_sewa_display" readonly
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition cursor-pointer bg-white"
                            placeholder="Pilih tanggal">
                        <input type="hidden" name="tanggal_sewa" id="tanggal_sewa" value="{{ old('tanggal_sewa', date('Y-m-d')) }}">
                        <p class="mt-1 text-xs text-gray-500">Klik untuk memilih tanggal</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kembali</label>
                        <input type="text" id="tanggal_kembali_display" readonly
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition cursor-pointer bg-white"
                            placeholder="Pilih tanggal">
                        <input type="hidden" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali') }}">
                        <p class="mt-1 text-xs text-gray-500">Klik untuk memilih tanggal</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Merk Motor</label>
                        <input type="text" name="merk_motor" value="{{ old('merk_motor') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                            placeholder="Honda Beat">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. Plat</label>
                        <input type="text" name="no_plat" value="{{ old('no_plat') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                            placeholder="B 1234 XYZ">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Pengantaran</label>
                        <input type="text" name="tempat_pengantaran" value="{{ old('tempat_pengantaran') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                            placeholder="Hotel XYZ">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Penjemputan</label>
                        <input type="text" name="tempat_penjemputan" value="{{ old('tempat_penjemputan') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                            placeholder="Bandara">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jaminan</label>
                        <input type="text" name="jaminan" value="{{ old('jaminan') }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                            placeholder="KTP">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Helm</label>
                        <input type="number" name="jumlah_helm" value="{{ old('jumlah_helm', 1) }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition">
                    </div>
                </div>
            </div>

            <!-- Equipment -->
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Perlengkapan Tambahan
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-purple-400 transition">
                        <input type="checkbox" name="jas_hujan" value="1" id="jas_hujan" 
                            class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500" {{ old('jas_hujan') ? 'checked' : '' }}>
                        <label for="jas_hujan" class="ml-3 text-gray-700 font-medium cursor-pointer">Jas Hujan</label>
                    </div>
                    <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-purple-400 transition">
                        <input type="checkbox" name="phone_holder" value="1" id="phone_holder" 
                            class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500" {{ old('phone_holder') ? 'checked' : '' }}>
                        <label for="phone_holder" class="ml-3 text-gray-700 font-medium cursor-pointer">Phone Holder</label>
                    </div>
                    <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-purple-400 transition">
                        <input type="checkbox" name="gembok_cakram" value="1" id="gembok_cakram" 
                            class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500" {{ old('gembok_cakram') ? 'checked' : '' }}>
                        <label for="gembok_cakram" class="ml-3 text-gray-700 font-medium cursor-pointer">Gembok Cakram</label>
                    </div>
                </div>
            </div>

            <!-- CEK FISIK -->
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    Cek Fisik
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-purple-400 transition">
                        <input type="checkbox" name="cek_lampu_depan" value="1" id="cek_lampu_depan" 
                            class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500" {{ old('cek_lampu_depan') ? 'checked' : '' }}>
                        <label for="cek_lampu_depan" class="ml-3 text-gray-700 font-medium cursor-pointer">Lampu Depan</label>
                    </div>
                    <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-purple-400 transition">
                        <input type="checkbox" name="cek_lampu_belakang" value="1" id="cek_lampu_belakang" 
                            class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500" {{ old('cek_lampu_belakang') ? 'checked' : '' }}>
                        <label for="cek_lampu_belakang" class="ml-3 text-gray-700 font-medium cursor-pointer">Lampu Belakang</label>
                    </div>
                    <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-purple-400 transition">
                        <input type="checkbox" name="cek_lampu_signal_kanan" value="1" id="cek_lampu_signal_kanan" 
                            class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500" {{ old('cek_lampu_signal_kanan') ? 'checked' : '' }}>
                        <label for="cek_lampu_signal_kanan" class="ml-3 text-gray-700 font-medium cursor-pointer">Lampu Signal Kanan</label>
                    </div>
                    <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-purple-400 transition">
                        <input type="checkbox" name="cek_lampu_signal_kiri" value="1" id="cek_lampu_signal_kiri" 
                            class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500" {{ old('cek_lampu_signal_kiri') ? 'checked' : '' }}>
                        <label for="cek_lampu_signal_kiri" class="ml-3 text-gray-700 font-medium cursor-pointer">Lampu Signal Kiri</label>
                    </div>
                    <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-purple-400 transition">
                        <input type="checkbox" name="cek_kaca_spion" value="1" id="cek_kaca_spion" 
                            class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500" {{ old('cek_kaca_spion') ? 'checked' : '' }}>
                        <label for="cek_kaca_spion" class="ml-3 text-gray-700 font-medium cursor-pointer">Kaca Spion</label>
                    </div>
                </div>
            </div>

            <!-- Fuel Level -->
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Bar Bensin (BBM)
                </h2>
                <div class="flex items-center space-x-4">
                    <div class="flex-1">
                        <div class="flex items-end space-x-2 h-32">
                            <label class="flex flex-col items-center cursor-pointer group flex-1">
                                <div class="w-full bg-gray-200 rounded-t-lg transition-all duration-200 group-hover:bg-purple-300" 
                                     :class="fuelLevel === 1 ? 'h-6 bg-purple-600' : 'h-6'">
                                </div>
                                <input type="radio" name="fuel_level" value="1" class="mt-2" {{ old('fuel_level', 4) == 1 ? 'checked' : '' }} 
                                       @click="fuelLevel = 1">
                                <span class="text-xs font-medium text-gray-600 mt-1">E</span>
                            </label>
                            <label class="flex flex-col items-center cursor-pointer group flex-1">
                                <div class="w-full bg-gray-200 rounded-t-lg transition-all duration-200 group-hover:bg-purple-300" 
                                     :class="fuelLevel === 2 ? 'h-12 bg-purple-600' : 'h-12'">
                                </div>
                                <input type="radio" name="fuel_level" value="2" class="mt-2" {{ old('fuel_level', 4) == 2 ? 'checked' : '' }} 
                                       @click="fuelLevel = 2">
                                <span class="text-xs font-medium text-gray-600 mt-1">1/4</span>
                            </label>
                            <label class="flex flex-col items-center cursor-pointer group flex-1">
                                <div class="w-full bg-gray-200 rounded-t-lg transition-all duration-200 group-hover:bg-purple-300" 
                                     :class="fuelLevel === 3 ? 'h-20 bg-purple-600' : 'h-20'">
                                </div>
                                <input type="radio" name="fuel_level" value="3" class="mt-2" {{ old('fuel_level', 4) == 3 ? 'checked' : '' }} 
                                       @click="fuelLevel = 3">
                                <span class="text-xs font-medium text-gray-600 mt-1">1/2</span>
                            </label>
                            <label class="flex flex-col items-center cursor-pointer group flex-1">
                                <div class="w-full bg-gray-200 rounded-t-lg transition-all duration-200 group-hover:bg-purple-300" 
                                     :class="fuelLevel === 4 ? 'h-24 bg-purple-600' : 'h-24'">
                                </div>
                                <input type="radio" name="fuel_level" value="4" class="mt-2" {{ old('fuel_level', 4) == 4 ? 'checked' : '' }} 
                                       @click="fuelLevel = 4">
                                <span class="text-xs font-medium text-gray-600 mt-1">3/4</span>
                            </label>
                            <label class="flex flex-col items-center cursor-pointer group flex-1">
                                <div class="w-full bg-gray-200 rounded-t-lg transition-all duration-200 group-hover:bg-purple-300" 
                                     :class="fuelLevel === 5 ? 'h-32 bg-purple-600' : 'h-32'">
                                </div>
                                <input type="radio" name="fuel_level" value="5" class="mt-2" {{ old('fuel_level', 4) == 5 ? 'checked' : '' }} 
                                       @click="fuelLevel = 5">
                                <span class="text-xs font-medium text-gray-600 mt-1">F</span>
                            </label>
                        </div>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-4">Select the current fuel level of the motorcycle</p>
            </div>

            <!-- Financial -->
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Detail Keuangan
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Biaya Sewa</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2.5 text-gray-500">Rp</span>
                            <input type="number" name="biaya_sewa" id="biaya_sewa" value="{{ old('biaya_sewa', ) }}" 
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                                placeholder="0" onchange="hitungKekurangan()">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Uang Muka (DP)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2.5 text-gray-500">Rp</span>
                            <input type="number" name="uang_muka" id="uang_muka" value="{{ old('uang_muka', ) }}" 
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                                placeholder="0" onchange="hitungKekurangan()">
                        </div>
                    </div>
                </div>
                
                <!-- Auto-calculated Sisa Pembayaran (display only) -->
                <div class="mt-4 p-4 bg-purple-50 border border-purple-200 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-purple-900">Sisa Pembayaran (Otomatis):</span>
                        <span class="text-lg font-bold text-purple-700" id="sisa_pembayaran_display">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Keterangan Lainnya  
                </h2>
                <textarea name="keterangan_lain" rows="3" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" 
                    placeholder="Tambahan informasi lainnya">{{ old('keterangan_lain') }}</textarea>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('invoices.create') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-indigo-700 transition transform hover:scale-105 shadow-lg">
                    Create Invoice
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Format tanggal ke "8 November 2025"
    function formatTanggalIndonesia(dateString) {
        if (!dateString) return '';
        
        const bulanIndonesia = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        const date = new Date(dateString);
        const tanggal = date.getDate();
        const bulan = bulanIndonesia[date.getMonth()];
        const tahun = date.getFullYear();
        
        return `${tanggal} ${bulan} ${tahun}`;
    }

    // Konversi tanggal dari format Indonesia ke Y-m-d
    function parseTanggalIndonesia(dateString) {
        const bulanIndonesia = {
            'Januari': 0, 'Februari': 1, 'Maret': 2, 'April': 3, 'Mei': 4, 'Juni': 5,
            'Juli': 6, 'Agustus': 7, 'September': 8, 'Oktober': 9, 'November': 10, 'Desember': 11
        };
        
        const parts = dateString.split(' ');
        if (parts.length === 3) {
            const tanggal = parseInt(parts[0]);
            const bulan = bulanIndonesia[parts[1]];
            const tahun = parseInt(parts[2]);
            
            const date = new Date(tahun, bulan, tanggal);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            
            return `${year}-${month}-${day}`;
        }
        return '';
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi hitung kekurangan pembayaran
        window.hitungKekurangan = function() {
            const biayaSewa = parseFloat(document.getElementById('biaya_sewa').value) || 0;
            const uangMuka = parseFloat(document.getElementById('uang_muka').value) || 0;
            const sisaPembayaran = biayaSewa - uangMuka;
            
            document.getElementById('sisa_pembayaran_display').textContent = 
                'Rp ' + sisaPembayaran.toLocaleString('id-ID');
        };
        
        // Inisialisasi tanggal sewa dengan tanggal hari ini
        const tanggalSewaInput = document.getElementById('tanggal_sewa');
        const tanggalSewaDisplay = document.getElementById('tanggal_sewa_display');
        const tanggalKembaliInput = document.getElementById('tanggal_kembali');
        const tanggalKembaliDisplay = document.getElementById('tanggal_kembali_display');
        
        // Set initial value untuk tanggal sewa
        if (tanggalSewaInput.value) {
            tanggalSewaDisplay.value = formatTanggalIndonesia(tanggalSewaInput.value);
        }
        
        // Set initial value untuk tanggal kembali jika ada
        if (tanggalKembaliInput.value) {
            tanggalKembaliDisplay.value = formatTanggalIndonesia(tanggalKembaliInput.value);
        }
        
        // Buat date picker untuk tanggal sewa
        tanggalSewaDisplay.addEventListener('click', function() {
            const tempInput = document.createElement('input');
            tempInput.type = 'date';
            tempInput.min = '{{ date('Y-m-d') }}';
            tempInput.value = tanggalSewaInput.value || '{{ date('Y-m-d') }}';
            tempInput.style.position = 'absolute';
            tempInput.style.opacity = '0';
            tempInput.style.pointerEvents = 'none';
            document.body.appendChild(tempInput);
            
            tempInput.addEventListener('change', function() {
                if (this.value) {
                    tanggalSewaInput.value = this.value;
                    tanggalSewaDisplay.value = formatTanggalIndonesia(this.value);
                    
                    // Update min date untuk tanggal kembali
                    tanggalKembaliInput.setAttribute('data-min', this.value);
                }
                document.body.removeChild(tempInput);
            });
            
            tempInput.showPicker();
        });
        
        // Buat date picker untuk tanggal kembali
        tanggalKembaliDisplay.addEventListener('click', function() {
            const tempInput = document.createElement('input');
            tempInput.type = 'date';
            const minDate = tanggalSewaInput.value || '{{ date('Y-m-d') }}';
            tempInput.min = minDate;
            tempInput.value = tanggalKembaliInput.value || minDate;
            tempInput.style.position = 'absolute';
            tempInput.style.opacity = '0';
            tempInput.style.pointerEvents = 'none';
            document.body.appendChild(tempInput);
            
            tempInput.addEventListener('change', function() {
                if (this.value) {
                    tanggalKembaliInput.value = this.value;
                    tanggalKembaliDisplay.value = formatTanggalIndonesia(this.value);
                }
                document.body.removeChild(tempInput);
            });
            
            tempInput.showPicker();
        });

        // Simple fuel level indicator (without Alpine.js, using vanilla JS)
        const radios = document.querySelectorAll('input[name="fuel_level"]');
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                const value = parseInt(this.value);
                radios.forEach(r => {
                    const bar = r.parentElement.querySelector('div');
                    if (parseInt(r.value) === value) {
                        bar.classList.add('bg-purple-600');
                        bar.classList.remove('bg-gray-200');
                    } else {
                        bar.classList.remove('bg-purple-600');
                        bar.classList.add('bg-gray-200');
                    }
                });
            });
        });
        
        // Trigger initial state
        const checked = document.querySelector('input[name="fuel_level"]:checked');
        if (checked) {
            checked.dispatchEvent(new Event('change'));
        }
        
        // Calculate sisa pembayaran on page load
        hitungKekurangan();
    });
</script>
@endsection
