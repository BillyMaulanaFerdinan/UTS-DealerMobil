@empty($mobil)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5> Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/mobil') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/mobil/' . $mobil->mobil_id . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Mobil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Merek</label>
                        <select name="merek" id="merek" class="form-control" required>
                            <option value="">- Pilih Merek -</option>
                            @foreach ($data->unique('merek') as $item)
                                <option value="{{ $item->merek }}" {{ $mobil->merek == $item->merek ? 'selected' : '' }}>
                                    {{ $item->merek }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-merek" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $mobil->nama }}"
                            required>
                        <small id="error-nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Kode Mesin</label>
                        <input type="text" name="kode_mesin" id="kode_mesin" class="form-control" value="{{ $mobil->kode_mesin }}"
                            required>
                        <small id="error-kode_mesin" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Warna</label>
                        <input type="text" name="warna" id="warna" class="form-control" value="{{ $mobil->warna }}"
                            required>
                        <small id="error-warna" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Kondisi</label>
                        <select name="kondisi" id="kondisi" class="form-control" required>
                            <option value="">- Pilih kondisi -</option>
                            @foreach ($data->unique('kondisi') as $item)
                                <option value="{{ $item->kondisi }}"
                                    {{ $mobil->kondisi == $item->kondisi ? 'selected' : '' }}>
                                    {{ $item->kondisi }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-kondisi" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control"
                            value="{{ $mobil->harga }}" required>
                        <small id="error-harga" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
<script>
    $(document).ready(function() {
        $("#form-edit").validate({
            rules: {
                merek: {
                    required: true,
                },
                nama: {
                    required: true,
                },
                kode_mesin: {
                    required: true,
                    minlength: 15,
                    maxlength: 15
                },
                warna: {
                    required: true,
                },
                kondisi: {
                    required: true,
                },
                harga: {
                    required: true,
                    number: true
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataHP.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script> @endempty
