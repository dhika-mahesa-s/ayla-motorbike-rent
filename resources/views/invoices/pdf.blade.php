<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>
    @page { size: A4; margin: 8mm 10mm; }
    body { font-family: DejaVu Sans, sans-serif; font-size: 9px; margin:0; padding:0; line-height:1.4; }
    table { width: 100%; border-collapse: collapse; }
    .dotted-line { border-bottom: 1px dotted #000; padding: 3px 0; min-height: 14px; }
    .border-box { border: 1px solid #000; padding: 5px; }
</style>
</head>
<body>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
    <td width="18%" valign="top" style="padding-right:5px;">
        <div style="font-size:14px; font-weight:bold; line-height:0.9;">AYLA</div>
        <div style="font-size:6px;">Motorbike Rent</div>
    </td>
    <td width="64%" valign="top" align="center">
        <div style="font-size:8px; color:#555;">Rental Motor Padang</div>
        <div style="font-size:16px; font-weight:bold; line-height:1;">Ayla Motorbike Rent</div>
        <div style="font-size:7px; margin:1px 0;">Jl. Purus V, No. 96 - Padang Barat - No. WA (0852 7259 0220)</div>
        <div style="font-size:8px; font-weight:bold; border-top:1px solid #000; border-bottom:1px solid #000; padding:1px; margin-top:2px;">SURAT TANDA TERIMA RENTAL KENDARAAN</div>
    </td>
    <td width="18%" valign="top" align="right">
        <div style="background:#2a2a2a; color:#fff; padding:3px 5px; display:inline-block; font-size:9px; font-weight:bold;">RMI</div><br>
        <div style="background:#2a2a2a; color:#fff; padding:1px 3px; display:inline-block; font-size:4px; margin-top:1px;">RENTAL MOTOR<br>INDONESIA</div>
    </td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" width="100%" style="margin-top:1px;">
<tr>
    <td width="56%" valign="top" style="padding-right:5px;">
        <!-- LEFT COLUMN -->
        <table cellpadding="0" cellspacing="0" width="100%" style="font-size:8.5px;">
            <tr><td width="30%">Nama Penyewa</td><td width="2%">:</td><td width="68%" class="dotted-line">{{ $invoice->customer_name }}</td></tr>
            <tr><td>KTP/SIM</td><td>:</td><td class="dotted-line">{{ $invoice->id_number }}</td></tr>
            <tr><td>Alamat</td><td>:</td><td class="dotted-line">{{ $invoice->address }}</td></tr>
            <tr><td>No. Telp.</td><td>:</td><td class="dotted-line">{{ $invoice->phone }}</td></tr>
            <tr><td>Tanggal Sewa</td><td>:</td><td class="dotted-line">{{ optional($invoice->start_date)->format('d/m/Y') }}</td></tr>
            <tr><td>Tanggal Kembali</td><td>:</td><td class="dotted-line">{{ optional($invoice->end_date)->format('d/m/Y') }}</td></tr>
            <tr><td>No. Polisi</td><td>:</td><td class="dotted-line">{{ $invoice->plate_number }}</td></tr>
            <tr><td>Tipe Motor</td><td>:</td><td class="dotted-line">{{ $invoice->motor_type }}</td></tr>
            <tr><td>Jumlah Helm</td><td>:</td><td class="dotted-line">{{ $invoice->helmets }}</td></tr>
            <tr><td>Jas Hujan</td><td>:</td><td class="dotted-line">{{ $invoice->raincoat ? 'Ya' : 'Tidak' }}</td></tr>
            <tr><td>Phone Holder</td><td>:</td><td class="dotted-line">{{ $invoice->phone_holder ? 'Ya' : 'Tidak' }}</td></tr>
            <tr><td>Gembok Cakram</td><td>:</td><td class="dotted-line">{{ $invoice->disk_lock ? 'Ya' : 'Tidak' }}</td></tr>
            <tr><td>Tempat Pengantaran</td><td>:</td><td class="dotted-line">{{ $invoice->delivery_place }}</td></tr>
            <tr><td>Tempat Penjemputan</td><td>:</td><td class="dotted-line">{{ $invoice->pickup_place }}</td></tr>
            <tr><td>Jaminan</td><td>:</td><td class="dotted-line">{{ $invoice->guarantee }}</td></tr>
            <tr><td>Biaya Sewa</td><td>:</td><td class="dotted-line">{{ number_format($invoice->rental_fee ?? 0, 0, ',', '.') }}</td></tr>
            <tr><td>Keterangan Lain</td><td>:</td><td class="dotted-line">{{ $invoice->other_notes }}</td></tr>
        </table>
        
        <table cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px; font-size:7.5px;">
            <tr>
                <td width="50%" align="center" valign="top">
                    <div>Pemilik Kendaraan /</div>
                    <div>yang diberi kuasa</div>
                    <div style="margin-top:40px; border-bottom:1px dotted #000; width:85%;">&nbsp;</div>
                </td>
                <td width="50%" align="center" valign="top">
                    <div>Penyewa Kendaraan</div>
                    <div>menyetujui ketentuan diatas</div>
                    <div style="margin-top:40px; border-bottom:1px dotted #000; width:85%;">&nbsp;</div>
                </td>
            </tr>
        </table>
        
        <div style="margin-top:20px; font-size:7.5px;">
            <div style="font-weight:bold; margin-bottom:3px;">Nota :</div>
            <div style="color:#c00; line-height:1.5;"><strong>Cancel ✕ DP Hangus</strong></div>
            <div style="color:#c00; line-height:1.5;"><strong>Jika Sudah Akad Sewa ✕ Tidak bisa refund</strong></div>
        </div>
    </td>
    
    <td width="44%" valign="top">
        <!-- RIGHT COLUMN -->
        <div class="border-box" style="margin-bottom:6px;">
            <div style="text-align:center; font-size:8px; font-weight:bold; margin-bottom:4px; line-height:1.3;">PENTING, KETAHUI KETENTUAN - KETENTUAN<br>DI BAWAH INI :</div>
            <ol style="margin:0; padding-left:12px; font-size:7px; line-height:1.5;">
                <li style="margin-bottom:3px;">Kendaraan (Motor) yang tersebut di atas (disewakan) tidak dapat dipindah tangan kepada pihak lain tanpa seizin pemilik kendaraan</li>
                <li style="margin-bottom:3px;">Kendaraan (Motor) tersebut tidak dapat dijadikan jaminan/digadokan dengan tujuan apapun kepada siapapun</li>
                <li style="margin-bottom:3px;">Pelanggaran No. 1 & 2 akan di proses melalui jalur hukum/Pidana dan pemilik kendaraan berhak untuk mengambil kembali kendaraan (menuntut) apabila terjadi pelanggaran atau terdapat kecurigaan lainnya mengenai penggunaan kendaraan dimana dirasakan oleh pemilik kendaraan tersebut</li>
                <li style="margin-bottom:3px;">Pengembalian kendaraan (Motor) harus dalam keadaan seperti pada saat ditanda tanganinya surat tanda terima ini, jika terjadi lecet/tabrakan adalah tanggung jawab pihak penyewa</li>
                <li style="margin-bottom:3px;">Jika terjadi keterlambatan pengembalian kendaraan akan di kenakan DENDA per/jam sebesar Rp. 20.000</li>
                <li style="margin-bottom:3px;">Bahan Bakar minyak (BBM) ditanggung oleh penyewa, harus dikembalikan sama seperti serah terima awal</li>
                <li style="margin-bottom:3px;">Jika terjadi kerusakan atau kehilangan motor beserta kelengkapannya (STNK, Helm, Jas Hujan, Gembok Cakram, dll) maka penyewa wajib mengganti semua kerugian yang di timbulkan</li>
                <li>Dilarang keras membawa motor ke luar provinsi Sumatera Barat dan dilarang keras membawa motor menyebrangi ke pulau</li>
            </ol>
        </div>
        
        @php
            $fuelLevel = $invoice->fuel_level ?? 4;
            $fuelLabels = [1 => 'E', 2 => '1/4', 3 => '1/2', 4 => '3/4', 5 => 'F'];
        @endphp
        <div class="border-box" style="margin-bottom:8px; background:#f8f8f8;">
            <div style="font-weight:bold; font-size:8.5px; margin-bottom:4px;">BBM (Bahan Bakar)</div>
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="20%" style="font-size:7.5px; vertical-align:middle;">Level:</td>
                    <td width="80%" style="vertical-align:middle;">
                        <table cellpadding="0" cellspacing="0" width="100%" style="border:1px solid #000;">
                            <tr>
                                @for($i = 5; $i >= 1; $i--)
                                <td width="20%" align="center" style="border-right:{{ $i > 1 ? '1px solid #ccc' : '0' }}; padding:5px 0; font-size:7.5px; {{ $fuelLevel >= $i ? 'background:#333; color:#fff; font-weight:bold;' : 'background:#fff;' }}">
                                    {{ $fuelLabels[$i] }}
                                </td>
                                @endfor
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="border-box" style="background:#f8f8f8; margin-bottom:8px;">
            <div style="font-weight:bold; font-size:8.5px; margin-bottom:4px;">CEK FISIK</div>
            <table cellpadding="0" cellspacing="0" width="100%" style="font-size:7.5px;">
                <tr>
                    <td width="50%" style="line-height:1.6;">
                        <div>{{ $invoice->cek_lampu_depan ? '☑' : '☐' }} Lampu Depan</div>
                        <div>{{ $invoice->cek_lampu_belakang ? '☑' : '☐' }} Lampu Belakang</div>
                        <div>{{ $invoice->cek_kaca_spion ? '☑' : '☐' }} Kaca Spion</div>
                    </td>
                    <td width="50%" style="line-height:1.6;">
                        <div>{{ $invoice->cek_lampu_signal_kanan ? '☑' : '☐' }} Signal Kanan</div>
                        <div>{{ $invoice->cek_lampu_signal_kiri ? '☑' : '☐' }} Signal Kiri</div>
                    </td>
                </tr>
            </table>
        </div>
        
        <table cellpadding="0" cellspacing="0" width="100%" style="font-size:8.5px; line-height:1.6;">
            <tr><td width="42%">Total Sewa</td><td width="3%">:</td><td width="55%">Rp {{ number_format($invoice->rental_fee ?? 0, 0, ',', '.') }}</td></tr>
            <tr><td>Uang Muka</td><td>:</td><td>Rp {{ number_format($invoice->down_payment ?? 0, 0, ',', '.') }}</td></tr>
            <tr><td>Kekurangan</td><td>:</td><td>Rp {{ number_format((($invoice->rental_fee ?? 0) - ($invoice->down_payment ?? 0)), 0, ',', '.') }}</td></tr>
        </table>
    </td>
</tr>
</table>

</body>
</html>
