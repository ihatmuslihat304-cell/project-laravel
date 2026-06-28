<html>
    <head>
        <title>Tabel Laporan</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body class="p-4">
        @include('navbar')
        <div class="flex gap-2 mb-5">
            <button onclick="toggle_modal()" class="bg-blue-500 text-white px-4 py-2 rounded">
                + Tambah Surat
            </button>
            <a href="{{ route('reports.pdf') }}" class="bg-red-500 text-white px-4 py-2 rounded font-medium flex items-center gap-1 hover:bg-red-700 transition">
                <span class="material-icons text-sm">picture_as_pdf</span>Simpan Sebagai Pdf
            </a>
        </div>
        
        <table class="table-auto w-full mt-5">
            <thead>
                <tr class="bg-gray-300">
                    <th class="border p-2">Jenis Surat</th>
                    <th class="border p-2">Total</th>
                    <th class="border p-2">Selesai</th>
                    <th class="border p-2">Ditolak</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $r)
                  <tr>
                    <td class="border p-2">{{ $r->jenis_surat }}</td>
                    <td class="border p-2">{{ $r->total }}</td>
                    <td class="border p-2">{{ $r->selesai }}</td>
                    <td class="border p-2">{{ $r->ditolak }}</td>
                    <td class="border p-2 text-center">
                        <div class="flex items-center justify-center gap-4">
                            <button onclick="toggle_edit({{ $r }})" class="text-green-500 font-medium">
                                <span class="material-icons">edit</span>
                            </button>
                            <button onclick="if(confirm('Yakin ingin menghapus Surat ini?')) { document.getElementById('form-delete{{ $r->id }}').submit(); }" class="text-red-500 font-medium">
                                <span class="material-icons">delete</span>
                            </button>
                            <form id="form-delete{{ $r->id }}" action="{{ route('reports.destroy',$r->id) }}" method="post" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        {{-- modal tambah: --}}
        <div id="modal-tambah-surat"class="fixed inset-0 bg-black bg-opacity-50 hidden item-center justify-center">>
            <div class="bg-white p-6 rounded-2xl shadow-lg w-96">
                <h2 class="text-lg font-bold mb-4">Tambah Surat Baru</h2>
                <form action="{{ route('reports.store') }}" method="post">
                    @csrf
                    <label for="jenis_surat" class="text-sm">Jenis Surat</label>
                    <input type="text" name="jenis_surat" class="w-full border p-2 mb-3 rounded" required>
                    <label for="total" class="text-sm">Total</label>
                    <input type="number" name="total" class="w-full border p-2 mb-3 rounded" required>
                    <label for="selesai" class="text-sm">Selesai</label>
                    <input type="number" name="selesai" class="w-full border p-2 mb-3 rounded" required>
                    <label for="ditolak" class="text-sm">Ditolak</label>
                    <input type="number" name="ditolak" class="w-full border p-2 mb-3 rounded" required>
                    <div class="flex justify-end gap-3 mt-2">
                        <button type="button" onclick="toggel_modal()" class="text-grey-500">Batal</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-2xl">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- modal edit: --}}
        <div id="modal-edit-surat"class="fixed inset-0 bg-black bg-opacity-50 hidden item-center justify-center">
            <div class="bg-white p-6 rounded-2xl shadow-lg w-96">
                <h2 class="text-lg font-bold mb-4">Edit Surat</h2>
                <form id="form-edit" method="post">
                    @csrf
                    @method('PUT')
                    <label for="jenis_surat" class="text-sm">Jenis Surat</label>
                    <input type="text" id="edit_jenis_surat" name="jenis_surat" class="w-full border p-2 mb-3 rounded" required>
                    <label for="total" class="text-sm">Total</label>
                    <input type="number" id="edit_total" name="total" class="w-full border p-2 mb-3 rounded" required>
                    <label for="selesai" class="text-sm">Selesai</label>
                    <input type="number" id="edit_selesai" name="selesai" class="w-full border p-2 mb-3 rounded" required>
                    <label for="ditolak" class="text-sm">Ditolak</label>
                    <input type="number" id="edit_ditolak" name="ditolak" class="w-full border p-2 mb-3 rounded" required>
                    <div class="flex justify-end gap-3 mt-2">
                        <button type="button" onclick="document.getElementById('modal-edit-surat').classList.replace('flex','hidden')" class="text-grey-500">Batal</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-2xl">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function toggle_modal(){
                const modal = document.getElementById('modal-tambah-surat');
                modal.classList.toggle('hidden');
                modal.classList.toggle('flext');
            }
            function toggle_edit(surat){
                const modal = document.getElementById('modal-edit-surat');
                //mengatur route pada action form secara dinamis
                document.getElementById('form-edit').action = '/reports/'+ surat.id;
                //mengisi value input form dengan data surat yang dipilih:
                document.getElementById('edit_jenis_surat').value = surat.jenis_surat;
                document.getElementById('edit_total').value = surat.total;
                document.getElementById('edit_selesai').value = surat.selesai;
                document.getElementById('edit_ditolak').value = surat.ditolak;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        </script>
    </body>
</html>