@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/mobil/create_ajax') }}')"
                    class="btn btn-sm btn-success mt-1">Tambah Mobil</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="merek" name="merek" required>
                                <option value="">- Semua -</option>
                                @foreach ($mobil->unique('merek') as $item)
                                    <option value="{{ $item->merek }}">{{ $item->merek }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Merek</small>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped table-hover table-sm" id="table_mobil">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Merek</th>
                        <th>Nama</th>
                        <th>Kode Mesin</th>
                        <th>Warna</th>
                        <th>Kondisi</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection
@push('css')
@endpush
@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
        var dataMobil;
        $(document).ready(function() {
            dataMobil = $('#table_mobil').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('mobil/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.merek = $('#merek').val();
                    }
                },
                columns: [{ // nomor urut dari laravel datatable addIndexColumn()
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "merek",
                    className: "",
                    orderable: false,
                    searchable: true
                }, {
                    data: "nama",
                    className: "",
                    orderable: false,
                    searchable: true
                }, {
                    data: "kode_mesin",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "warna",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "kondisi",
                    className: "",
                    orderable: false,
                    searchable: false
                }, {
                    data: "harga",
                    className: "",
                    orderable: true,
                    searchable: false
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });
            $('#merek').change(function() {
                dataMobil.ajax.reload();
            });
        });
    </script>
@endpush
