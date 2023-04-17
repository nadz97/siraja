<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Si Raja | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/png" href="https://siraja.web.id/assets/images/siraja.jpeg" />
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://siraja.web.id/lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://siraja.web.id/lte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://siraja.web.id/assets/css/Custom.css">
</head>

<body onload="cetak()">

    <!-- Content Wrapper. Contains page content -->
    <div class="container">
        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                <!-- Editable -->
                <section class="invoice print">
                    <div class="row">
                        <div class="col-sm-1" style="width: 100px">
                            <img src="{{ asset("/images/logo-kejari.png") }}"
                                style="width: 75px; height: 75px" />
                        </div>
                        <div class="col-sm-10">
                            <center>
                                KEJAKSAAN REPUBLIK INDONESIA <BR />
                                KEJAKSAAN TINGGI JAWA TIMUR </BR>
                                <b> KEJAKSAAN NEGERI KABUPATEN MOJOKERTO </b> <br />
                                Jalan R. A. Basuni No. 360, Sooko Kabupaten Mojokerto 61361 <br />
                                Telp. (0321) 322400 Fax. (0321) 322400 Website : www.kejari.mojokertokab.go.id
                            </center>
                        </div>
                        <div class="col-sm-1" style="float:right">
                            BA - 5
                        </div>
                    </div>
                    <div class="row">
                        <hr style="border-top: 1px solid; margin-bottom: 0px" />
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="text-align: center">
                            <h5>BERITA ACARA<br />PENITIPAN BARANG BUKTI</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <br />Pada hari ini {{ $tgl }} tanggal
                            {{ $data[0]->tanggal }} bertempat di
                            Kejaksaan Negeri Mojokerto
                            kami :<br />
                            <table class="table table-borderless" style="margin-bottom: 0px">
                                <tr>
                                    <td style="width: 10px">1.</td>
                                    <td style="width: 100px">Nama</td>
                                    <td style="width: 10px">:</td>
                                    <td>{{ $jaksas1[0]->name }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Pangkat/NIP</td>
                                    <td>:</td>
                                    <td>{{ $jaksas1[0]->pangkat }} / {{ $jaksas1[0]->nip }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>
                                        {{ $jaksas1[0]->jabatan }}

                                    </td>
                                </tr>
                            </table>

                            <table class="table table-borderless" style="margin-bottom: 0px">
                                <tr>
                                    <td style="width: 10px">2.</td>
                                    <td style="width: 100px">Nama</td>
                                    <td style="width: 10px">:</td>
                                    <td>{{ $jaksas2[0]->name }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Pangkat/NIP</td>
                                    <td>:</td>
                                    <td>{{ $jaksas2[0]->pangkat }} / {{ $jaksas2[0]->nip }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>
                                        {{ $jaksas2[0]->jabatan }}

                                    </td>
                                </tr>
                            </table>
                            Dengan disaksikan oleh : , <br>
                            <table class="table table-borderless" style="margin-bottom: 0px">
                                <tr>
                                    <td style="width: 10px">1.</td>
                                    <td style="width: 100px">Nama</td>
                                    <td style="width: 10px">:</td>
                                    <td>{{ $kasi_bb->name }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Pangkat/NIP</td>
                                    <td>:</td>
                                    <td>{{ $kasi_bb->nip }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>{{ $kasi_bb->jabatan }}</td>
                                </tr>
                            </table>

                            <table class="table table-borderless" style="margin-bottom: 0px">
                                <tr>
                                    <td style="width: 10px">2.</td>
                                    <td style="width: 100px">Nama</td>
                                    <td style="width: 10px">:</td>
                                    <td>{{ $kasi_bb->name }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Pangkat/NIP</td>
                                    <td>:</td>
                                    <td>{{ $kasi_bb->nip }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>{{ $kasi_bb->jabatan }}</td>
                                </tr>
                            </table>
                            Berdasarkan Surat Perintah
                            Kepala Kejaksaan Negeri Mojokerto
                            Nomor : <b>{{ $data[0]->surat_perintah }}</b>
                            tanggal {{ $tg }} serta
                            mengingat barang bukti tersebut sangat dibutuhkan sewaktu-waktu untuk persidangan/memerlukan
                            perawatan
                            khusus telah menitipkan barang bukti, register perkara Nomor <b>{{$data[0]->no_penelitian}}</b> atas nama
                            tersangka <b>{{$data[0]->tdw_nama}}</b>. Register bukti Nomor <b>nrb-64232 </b> berupa :
                            <ol>
                                @foreach ($basan as $bsn)
                                        <li>{{ $bsn->nama }}</li>
                                    @endforeach
                            </ol>
                            Kepada ;
                            <table>
                                <tr>
                                    <td style="width: 130px">Nama </td>
                                    <td>: {{ $kepala_rupbasan->name }} </td>
                                </tr>
                                <tr>
                                    <td>Jabatan </td>
                                    <td>: {{ $kepala_rupbasan->nip }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat </td>
                                    <td>: {{ $kepala_rupbasan->alamat }}</td>
                                </tr>
                            </table>
                            disimpan / dititipkan di RUBASAN Mojokerto untuk perawatan dengan ketentuan sewaktu
                            diperlukan untuk
                            kepentingan pemeriksaan agar yang bersangkutan wajib menyerahkan kembali barang titipan
                            tersebut kepada
                            Kejaksaan Negeri Mojokerto

                            .<br /><br />
                            Demikian Berita Acara ini di buat dengan sebenarnya atas kekuatan sumpah jabatan kemudian
                            ditutup dan
                            ditanda-tangani pada hari dan tanggal tersebut diatas.<br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-borderless ttd" style="margin-top: 10px">
                                <tr>
                                    <td style="width: 50%">
                                        Yang menerima titipan,<br /><br /><br /><br />
                                        pramono <br />
                                        <br>


                                        <!-- sucipto -->
                                        <!-- <br />NIP. 34343</td> -->
                                    <td>
                                        Yang menitipkan,<br />
                                        JAKSA PENUNTUT UMUM

                                        ,<br /><br /><br /><br />
                                        adi<br />
                                        jaksa<br>


                                        <!-- wisnu<br /> -->
                                        <!-- NIP. 343 -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>Saksi-saksi ;<br /><br /><br /><br />
                                        <center>yuri</center>
                                    </td>
                                    <td><br><br /><br /><br />
                                        <center>wawan</center>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center>43423</center>
                                    </td>
                                    <td>
                                        <center>4343</center>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=2 style="padding-top: 20px">
                                        Mengetahui :<br />
                                        KASI PENGELOLAAN BARANG BUKTI <BR />
                                        DAN BARANG RAMPASAN<br /><br /><br />

                                        <br /><br /><br /><br />



                                        <!-- warto<br /> -->

                                        <!-- NIP. 343432 -->
                                        suyitno<br />
                                        43423
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </section>
                <!-- /Editable -->
            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>







    <!-- Bootstrap 3.3.7 -->
    <script src="https://siraja.web.id/lte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
