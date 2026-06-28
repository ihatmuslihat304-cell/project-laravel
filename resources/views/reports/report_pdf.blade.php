<html>
    <head>
        <title>Laporan Rekapitulasi Data SIPADU</title>
        <style>
            body{
                font-size: 12px;
                color: #2f0381 
            }
            .header{
                text-align: center;
                margin-bottom: 25px;
                border-bottom: 3px solid coral;
                padding-bottom: 10px;
            }
            .tittle{
                font-size: 18px;
                font-weight: bold;
            }
            table{
                width: 100%;
                border-collapse: collapse;
            }
            th{
                background-color: #f2f2f2;
                font-weight: bold;
                border: 1px solid #ddd;
                padding: 8px;
            }
            td{
                border: 1px solid #ddd;
                padding: 8px; 
            }
            .text-center{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="tittle">LAPORAN REKAPITULASI DATA SIPADU</div>
            <p>dicetak secara otomatis oleh sistem</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th>Jenis Surat</th>
                    <th>Total</th>
                    <th>Selesai</th>
                    <th>Ditolak</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $key => $r)
                    <tr>
                        <td class="text-center">{{ $key+1 }}</td>
                        <td> {{ $r->jenis_surat}}</td>
                        <td> {{ $r->total}}</td>
                        <td> {{ $r->selesai}}</td>
                        <td> {{ $r->ditolak}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
