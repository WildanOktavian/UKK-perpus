<div>
    
     <table class="table">
        <thead>
            @if(Auth::user()->role == 'admin')
            <a href="{{ route('export-dashboard-peminjaman') }}" class="btn btn-success">Ekspor Peminjaman admin (CSV)</a>
            @else
            <a href="{{ route('export-peminjaman-user') }}" class="btn btn-success">Ekspor Peminjaman (CSV)</a>
            @endif
            <tr>
                <th>No</th>
                <th>Pengguna</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Pengembalian</th>
                {{-- <th>Tanggal Pengembalian Sebenarnya</th> --}}
                {{-- <th>Status</th> --}}
                <th>Gambar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($browwing as $item)
            <tr class="{{ $item->actual_return_date == null ? '' : ($item->return_date < $item->actual_return_date ? 'text-bg-danger' : 'text-bg-success') }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->username }}</td>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->rent_date }}</td>
                    <td>{{ $item->return_date }}</td>
                    {{-- <td>{{ $item->actual_return_date }}</td> --}}
                    {{-- <td>{{ $item->book->status }}</td> --}}
                    <td>
                        <img src="{{ asset('storage/cover/' . $item->book->cover) }}" alt="Gambar Prestasi" style="max-width: 150px;">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>