<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan - SM Sport Center</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 20px; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0 0 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f3f4f6; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>Laporan Penggunaan Lapangan</h2>
        <h2>SM Sport Center</h2>
        @if(request('start_date') && request('end_date'))
            <p>Periode: {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }} s/d {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}</p>
        @else
            <p>Periode: Semua Waktu</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama Penyewa</th>
                <th>Lapangan</th>
                <th>Jenis</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Jam</th>
                <th class="text-center">Durasi</th>
                <th>Status</th>
                <th class="text-right">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPendapatan = 0; @endphp
            @forelse($reservasis as $index => $reservasi)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $reservasi->user->name ?? '-' }}</td>
                <td>{{ $reservasi->lapangan->nama_lapangan ?? '-' }}</td>
                <td>{{ $reservasi->lapangan->jenis_lapangan ?? '-' }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($reservasi->tanggal)->format('d-m-Y') }}</td>
                <td class="text-center">{{ $reservasi->jam_mulai }}</td>
                <td class="text-center">{{ $reservasi->durasi_jam }} Jam</td>
                <td>{{ $reservasi->status }}</td>
                <td class="text-right">Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}</td>
            </tr>
            @php 
                // Hanya hitung pendapatan dari reservasi yang Lunas
                if($reservasi->status == 'Lunas') {
                    $totalPendapatan += $reservasi->total_bayar; 
                }
            @endphp
            @empty
            <tr>
                <td colspan="9" class="text-center">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="8" class="text-right">Total Pendapatan (Status Lunas):</th>
                <th class="text-right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

</body>
</html>