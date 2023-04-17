@extends('layouts.app-master')

@section('content')
    @auth
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">basan - Daftar basan </h3>
                                <div class="nk-block-des text-soft">
                                    {{-- <p>You have total {{ $basan->count() }} basan.</p> --}}
                                </div>
                            </div><!-- .nk-block-head-content -->

                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            @can('peneliti-list')
                                                <li><a href="{{ route('penelitian.index') }}"
                                                        class="btn btn-white btn-dim btn-outline-light"><em
                                                            class="icon ni ni-users"></em><span>NEW</span></a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif



                    {{-- <div class="card card-bordered card-stretch mb-4">
                        <div class="card-inner-group">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h5 class="title">Detail Data</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner p-0">
                                <div class="nk-tb-list nk-tb-tnx">
                                    <dl class="row m-2">
                                        <dt class="col-sm-3">Tanggal</dt>
                                        <dd class="col-sm-9">{{ $data[0]->tanggal }}</dd>

                                        <dt class="col-sm-3">Nomor Penelitian</dt>
                                        <dd class="col-sm-9">
                                            <dl class="row">
                                                <dd class="col-sm-3">{{ $data[0]->no_penelitian }}</dd>
                                                <dd class="col-sm-3"><a href="">Print BA Penelitian</a></dd>
                                                <dd class="col-sm-3"><a href="">Print BA Penitipan Barang</a></dd>
                                            </dl>
                                        </dd>

                                        <dt class="col-sm-3">Terdakwa</dt>
                                        <dd class="col-sm-9">{{ $data[0]->tdw_nama }}</dd>

                                        <dt class="col-sm-3">Keterangan</dt>
                                        <dd class="col-sm-9">{{ $data[0]->keterangan }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h5 class="title">Detail Data</h5>
                                        </div>



                                        <!-- .card-search -->
                                    </div><!-- .card-title-group -->
                                </div><!-- .card-inner -->
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-tnx">

                                    </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <div class="invoice-head">
                                        <div class="invoice-contact">
                                            <span class="overline-title">Nomor Penelitian</span>
                                            <div class="invoice-contact-info">
                                                <h4 class="title"> {{ $data[0]->no_penelitian}} </h4>
                                                <span class="overline-title">Terdakwa</span>
                                                <ul class="list-plain">
                                                    <li><em class="icon ni ni-users-fill"></em><span>{{ $data[0]->tdw_nama }}</span></li>
                                                </ul>
                                                <br>
                                                <span class="overline-title">Nomor Perkara</span>
                                                <ul class="list-plain">
                                                    <li><em class="icon ni ni-list-fill"></em><span>{{ $data[0]->no_registrasi_perkara }}</span></li>
                                                </ul>
                                                <br>
                                                <span class="overline-title">Keterangan</span>
                                                <ul class="list-plain">
                                                    <li><span>{{ $data[0]->keterangan }}</span></li>
                                                </ul>

                                            </div>
                                        </div>
                                        <div class="invoice-desc">
                                            <h3 class="title">CETAK</h3>
                                            <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary" href="{{ route('admin.printPenelitian', $data[0]->id) }}"><em class="icon ni ni-printer-fill"></em></a>
                                            <span>BA Penelitian</span>

                                            <br>
                                            <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary" href="{{ route('admin.printPenitipan', $data[0]->id) }}"><em class="icon ni ni-printer-fill"></em></a>
                                            <span>BA Penitipan Barang</span>
                                        </div>
                                    </div><!-- .invoice-head -->
                                </div>
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->


                    {{-- data basan --}}
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h5 class="title">Data Basan</h5>
                                        </div>
                                        <div class="card-title">
                                            <a href="{{ route('admin.tambahBasan' , ['id' => $data[0]->id , 'nrp' => $data[0]->no_registrasi_perkara]) }}"
                                                class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Tambah Basan</span></a>
                                        </div>

                                    </div><!-- .card-title-group -->
                                </div><!-- .card-inner -->
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-tnx">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span>No</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span>No Perkara</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span>Nama Basan</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span>Jumlah</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span>Keterangan</span></div>
                                            <div class="nk-tb-col nk-tb-col-status">
                                                <span class="sub-text d-none d-md-block">Status</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-lg"><span>Action</span></div>

                                        </div><!-- .nk-tb-item -->


                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($data as $key => $pnl)
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <div class="nk-tnx-type">
                                                            <div class="nk-tnx-type-text">
                                                                <span class="tb-lead"> {{ ++$i }} </span>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-lead-sub"> {{ $pnl->no_registrasi_perkara }} </span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-lead-sub"> {{ $pnl->nama_basan }} </span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-lead-sub"> {{ $pnl->jumlah }} </span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-lead-sub"> {{ $pnl->keterangan }} </span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-status">
                                                        <div class="dot dot-success d-md-none"></div>
                                                        @if ($pnl->status == "entry")
                                                            <span class="badge badge-dot bg-primary">{{ $pnl->status }}</span>
                                                        @elseif ($pnl->status == "on going")
                                                            <span class="badge badge-dot bg-info">{{ $pnl->status }}</span>
                                                        @elseif ($pnl->status == "pinjam pakai")
                                                            <span class="badge badge-dot bg-info">{{ $pnl->status }}</span>
                                                        @elseif ($pnl->status == "dirampas negara")
                                                            <span class="badge badge-dot bg-info">{{ $pnl->status }}</span>
                                                        @elseif ($pnl->status == "dikembalikan")
                                                            <span class="badge badge-dot bg-info">{{ $pnl->status }}</span>
                                                        @elseif ($pnl->status == "dimusnahkan")
                                                            <span class="badge badge-dot bg-danger">{{ $pnl->status }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <div class="dot dot-success d-md-none"></div>
                                                        <a class="Badge badge-sm badge-dim bg-outline-info d-none d-md-inline-flex"
                                                        href="{{ route('admin.ubahBasan' , ['id' => $pnl->id_basan ]) }}">Edit</a>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                            @endforeach
                                    </div><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->
                                {{-- <div class="card-inner">
                                    {{ $basan->links() }}
                                </div><!-- .card-inner --> --}}
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->

                    {{-- data rekomendasi --}}
                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h5 class="title">Data Rekomendasi</h5>
                                        </div>
                                        <div class="card-title">
                                            <a href="{{ route('admin.tambahRekomendasi' , ['id' => $data[0]->id]) }}"
                                                class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Tambah Rekomendasi</span></a>
                                        </div>
                                    </div><!-- .card-title-group -->
                                </div><!-- .card-inner -->
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-tnx">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span>No</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span>Rekomendasi</span></div>
                                            <div class="nk-tb-col nk-tb-col-status">
                                                <span class="sub-text d-none d-md-block">Action</span>
                                            </div>

                                        </div><!-- .nk-tb-item -->


                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($rekomendasi as $key => $rek)
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col tb-col-sm">
                                                        <div class="nk-tnx-type">
                                                            <div class="nk-tnx-type-text">
                                                                <span class="tb-lead"> {{ ++$i }} </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-lead-sub"> {{ $rek->rekomendasi }} </span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-status">
                                                        <div class="dot dot-success d-md-none"></div>
                                                        {!! Form::open(['method' => 'DELETE','route' => ['admin.hapusRekomendasi', ['id' => $rek->id, 'pnl' => $rek->penelitian_id] ], 'style'=>'display:inline']) !!}
                                                            {!! Form::submit('Delete', ['class' => 'Badge badge-sm badge-dim bg-outline-danger d-none d-md-inline-flex']) !!}
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                            @endforeach
                                    </div><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->
                                {{-- <div class="card-inner">
                                    {{ $basan->links() }}
                                </div><!-- .card-inner --> --}}
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    @endauth

    @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
    @endguest

    @push('scripts')
        <script src="//cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    @endpush

    @push('body-scripts')
        <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
        </script>
    @endpush
@endsection
