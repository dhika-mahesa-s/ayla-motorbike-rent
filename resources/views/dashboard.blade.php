@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Dashboard</h1>
                    <p class="text-gray-600 mt-1 text-sm sm:text-base">Welcome back, {{ auth()->user()->name }}</p>
                </div>
                <div class="w-full sm:w-auto">
                    <a href="{{ route('invoices.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-4 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-indigo-700 transition transform hover:scale-105 shadow-lg text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Buat Invoice Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
            <!-- Total Invoices -->
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 border-l-4 border-blue-500 transform hover:scale-105 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs sm:text-sm font-medium text-gray-600 mb-1">Total Invoices</p>
                        <h3 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ \App\Models\Invoice::count() }}</h3>
                    </div>
                    <div class="bg-blue-100 p-2 sm:p-3 rounded-full">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 border-l-4 border-purple-500 transform hover:scale-105 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs sm:text-sm font-medium text-gray-600 mb-1">Total Revenue</p>
                        <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">Rp {{ number_format(\App\Models\Invoice::sum('rental_fee'), 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-purple-100 p-2 sm:p-3 rounded-full">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Invoices -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-200">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900">Recent Invoices</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice #</th>
                            <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motor</th>
                            <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse(\App\Models\Invoice::latest()->take(10)->get() as $invoice)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span class="text-xs sm:text-sm font-medium text-purple-600">#{{ str_pad($invoice->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <div class="text-xs sm:text-sm font-medium text-gray-900">{{ $invoice->customer_name }}</div>
                                <div class="text-xs text-gray-500">{{ $invoice->phone }}</div>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <div class="text-xs sm:text-sm text-gray-900">{{ $invoice->motor_type }}</div>
                                <div class="text-xs text-gray-500">{{ $invoice->plate_number }}</div>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">
                                {{ optional($invoice->start_date)->format('d M Y') }}
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span class="text-xs sm:text-sm font-semibold text-gray-900">Rp {{ number_format($invoice->rental_fee, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm">
                                <a href="{{ route('invoices.show', $invoice) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Lihat</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 sm:px-6 py-8 text-center text-gray-500">
                                <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-sm sm:text-base">No invoices yet. Create your first invoice!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(\App\Models\Invoice::count() > 10)
            <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">
                <a href="{{ route('invoices.index') }}" class="text-xs sm:text-sm font-medium text-purple-600 hover:text-purple-800">
                    View all invoices →
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
