@empty($mobil)
<div class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5> Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/mobil') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
</div>
@else
<div class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th class="text-right col-3">Merek :</th>
                        <td class="col-9">{{ $mobil->merek }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Nama :</th>
                        <td class="col-9">{{ $mobil->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Warna :</th>
                        <td class="col-9">{{ $mobil->warna }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Kondisi :</th>
                        <td class="col-9">{{ $mobil->kondisi }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Harga :</th>
                        <td class="col-9">Rp {{ number_format($mobil->harga, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endempty
