<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// Use the dompdf wrapper via the container to avoid facade resolution issues

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // use middleware class name to avoid alias-resolution issues
        $this->middleware(\App\Http\Middleware\EnsureAdmin::class);
    }

    public function index()
    {
        $invoices = Invoice::latest()->paginate(20);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        // Validate with Indonesian field names
        $validated = $request->validate([
            'nama_penyewa' => 'required|string|max:255',
            'no_ktp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:50',
            'tanggal_sewa' => 'nullable|date',
            'tanggal_kembali' => 'nullable|date',
            'no_plat' => 'nullable|string|max:100',
            'merk_motor' => 'nullable|string|max:255',
            'jumlah_helm' => 'nullable|integer|min:0',
            'jas_hujan' => 'nullable|boolean',
            'phone_holder' => 'nullable|boolean',
            'gembok_cakram' => 'nullable|boolean',
            'tempat_pengantaran' => 'nullable|string|max:255',
            'tempat_penjemputan' => 'nullable|string|max:255',
            'jaminan' => 'nullable|string|max:255',
            'biaya_sewa' => 'nullable|numeric',
            'uang_muka' => 'nullable|numeric',
            'keterangan_lain' => 'nullable|string',
            'cek_lampu_depan' => 'nullable|boolean',
            'cek_lampu_belakang' => 'nullable|boolean',
            'cek_lampu_signal_kanan' => 'nullable|boolean',
            'cek_lampu_signal_kiri' => 'nullable|boolean',
            'cek_kaca_spion' => 'nullable|boolean',
            'fuel_level' => 'nullable|integer|min:1|max:5',
        ]);

        // Map Indonesian field names to database column names (English)
        $data = [
            'customer_name' => $validated['nama_penyewa'],
            'id_number' => $validated['no_ktp'] ?? null,
            'address' => $validated['alamat'] ?? null,
            'phone' => $validated['no_hp'] ?? null,
            'start_date' => $validated['tanggal_sewa'] ?? null,
            'end_date' => $validated['tanggal_kembali'] ?? null,
            'plate_number' => $validated['no_plat'] ?? null,
            'motor_type' => $validated['merk_motor'] ?? null,
            'helmets' => $validated['jumlah_helm'] ?? 0,
            'raincoat' => $validated['jas_hujan'] ?? false,
            'phone_holder' => $validated['phone_holder'] ?? false,
            'disk_lock' => $validated['gembok_cakram'] ?? false,
            'delivery_place' => $validated['tempat_pengantaran'] ?? null,
            'pickup_place' => $validated['tempat_penjemputan'] ?? null,
            'guarantee' => $validated['jaminan'] ?? null,
            'rental_fee' => $validated['biaya_sewa'] ?? 0,
            'down_payment' => $validated['uang_muka'] ?? 0,
            'other_notes' => $validated['keterangan_lain'] ?? null,
            'cek_lampu_depan' => $validated['cek_lampu_depan'] ?? false,
            'cek_lampu_belakang' => $validated['cek_lampu_belakang'] ?? false,
            'cek_lampu_signal_kanan' => $validated['cek_lampu_signal_kanan'] ?? false,
            'cek_lampu_signal_kiri' => $validated['cek_lampu_signal_kiri'] ?? false,
            'cek_kaca_spion' => $validated['cek_kaca_spion'] ?? false,
            'fuel_level' => $validated['fuel_level'] ?? 4,
        ];

        $data['user_id'] = Auth::user()->id;

        $invoice = Invoice::create($data);

        return redirect()->route('invoices.show', $invoice->id)->with('success', 'Invoice berhasil dibuat!');
    }

    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    public function generatePdf(Invoice $invoice)
    {
        // admin middleware ensures user is admin
    $pdf = app('dompdf.wrapper')->loadView('invoices.pdf', compact('invoice'));

        $path = 'invoices/invoice-' . $invoice->id . '.pdf';
        Storage::disk('local')->put($path, $pdf->output());

        $invoice->update(['pdf_path' => $path]);

        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="invoice-'. $invoice->id .'.pdf"'
        ]);
    }

    public function download(Invoice $invoice)
    {
        if (!$invoice->pdf_path || !Storage::disk('local')->exists($invoice->pdf_path)) {
            // generate first
            $this->generatePdf($invoice);
        }

        return Storage::download($invoice->pdf_path, 'invoice-'.$invoice->id.'.pdf');
    }
}
