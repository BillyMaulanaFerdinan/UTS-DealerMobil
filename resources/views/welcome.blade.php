@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    {{-- Card: Jumlah Mobil --}}
                    <div class="col-lg-6 col-md-6 col-12 mb-4">
                        <div class="small-box bg-info shadow">
                            <div class="inner">
                                <h3>{{ $data['jumlahMobil'] }}</h3>
                                <p>Jumlah Mobil</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-car-alt"></i>
                            </div>
                            <span class="small-box-footer">Total unit tersedia</span>
                        </div>
                    </div>

                    {{-- Card: Total Omset --}}
                    <div class="col-lg-6 col-md-6 col-12 mb-4">
                        <div class="small-box bg-success shadow">
                            <div class="inner">
                                <h3>Rp{{ number_format($data['totalOmset'], 0, ',', '.') }}</h3>
                                <p>Total Omset</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-coins"></i>
                            </div>
                            <span class="small-box-footer">Akumulasi harga semua Mobil</span>
                        </div>
                    </div>

                    {{-- Card: Mobil Baru --}}
                    <div class="col-lg-6 col-md-6 col-12 mb-4">
                        <div class="small-box bg-primary shadow">
                            <div class="inner">
                                <h3>{{$data['totalBaru'] }}</h3>
                                <p>Total Mobil Baru</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="small-box-footer">Unit berstatus baru</span>
                        </div>
                    </div>

                    {{-- Card: Mobil Bekas --}}
                    <div class="col-lg-6 col-md-6 col-12 mb-4">
                        <div class="small-box bg-secondary shadow">
                            <div class="inner">
                                <h3>{{ $data['totalBekas'] }}</h3>
                                <p>Total Mobil Bekas</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-recycle"></i>
                            </div>
                            <span class="small-box-footer">Unit berstatus bekas</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
