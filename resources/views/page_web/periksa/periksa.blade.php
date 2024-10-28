@extends('template_web.layout')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Data Pemeriksaan</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form Tambah -->
                    <form id="periksaForm" action="{{ route('periksa.store') }}" method="POST">
                        @csrf
                        <div id="updateMethod"></div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="pasien_id">Pasien</label>
                                    <select class="form-select @error('pasien_id') is-invalid @enderror" 
                                            id="pasien_id" name="pasien_id" required>
                                        <option value="">Pilih Pasien</option>
                                        @foreach($pasien as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('pasien_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="dokter_id">Dokter</label>
                                    <select class="form-select @error('dokter_id') is-invalid @enderror" 
                                            id="dokter_id" name="dokter_id" required>
                                        <option value="">Pilih Dokter</option>
                                        @foreach($dokter as $d)
                                            <option value="{{ $d->id }}">{{ $d->nama }} - {{ $d->spesialis }}</option>
                                        @endforeach
                                    </select>
                                    @error('dokter_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_periksa">Tanggal Periksa</label>
                                    <input type="date" class="form-control @error('tgl_periksa') is-invalid @enderror" 
                                           id="tgl_periksa" name="tgl_periksa" value="{{ old('tgl_periksa') }}" required>
                                    @error('tgl_periksa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="catatan">Catatan</label>
                                    <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                              id="catatan" name="catatan" rows="3" required>{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="obat">Obat</label>
                                    <textarea class="form-control @error('obat') is-invalid @enderror" 
                                              id="obat" name="obat" rows="3" required>{{ old('obat') }}</textarea>
                                    @error('obat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">Batal</button>
                    </form>

                    <!-- Tabel Data -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Pasien</th>
                                    <th>Dokter</th>
                                    <th>Tanggal Periksa</th>
                                    <th>Catatan</th>
                                    <th>Obat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($periksa as $index => $p)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $p->pasien->nama }}</td>
                                        <td>{{ $p->dokter->nama }} - {{ $p->dokter->spesialis }}</td>
                                        <td>{{ date('d/m/Y', strtotime($p->tgl_periksa)) }}</td>
                                        <td>{{ $p->catatan }}</td>
                                        <td>{{ $p->obat }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $p->id }}">
                                                <i class="bi bi-pencil"></i> Edit
                                            </button>
                                            <form action="{{ route('periksa.destroy', $p->id) }}" method="POST" 
                                                  class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit untuk setiap data pemeriksaan -->
@foreach($periksa as $p)
    <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Pemeriksaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('periksa.update', $p->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="pasien_id" class="form-label">Pasien</label>
                            <select class="form-select" name="pasien_id" required>
                                <option value="">Pilih Pasien</option>
                                @foreach($pasien as $pasienItem)
                                    <option value="{{ $pasienItem->id }}" {{ $pasienItem->id == $p->pasien_id ? 'selected' : '' }}>
                                        {{ $pasienItem->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dokter_id" class="form-label">Dokter</label>
                            <select class="form-select" name="dokter_id" required>
                                <option value="">Pilih Dokter</option>
                                @foreach($dokter as $dokterItem)
                                    <option value="{{ $dokterItem->id }}" {{ $dokterItem->id == $p->dokter_id ? 'selected' : '' }}>
                                        {{ $dokterItem->nama }} - {{ $dokterItem->spesialis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
                            <input type="date" class="form-control" name="tgl_periksa" value="{{ $p->tgl_periksa }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" name="catatan" rows="3" required>{{ $p->catatan }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="obat" class="form-label">Obat</label>
                            <textarea class="form-control" name="obat" rows="3" required>{{ $p->obat }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@push('scripts')
<script>
function resetForm() {
    document.getElementById('periksaForm').action = "{{ route('periksa.store') }}";
    document.getElementById('updateMethod').innerHTML = '';
    document.getElementById('periksaForm').reset();
}
</script>
@endpush
@endsection
