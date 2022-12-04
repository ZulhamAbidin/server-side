
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</head>
<body>

<div class="container">
    <table class="table table-striped" id="tabel1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>alamat</th>
                <th>jenis_kelamin</th>
                <th>pendidikan_terahir</th>
                <th>jurusan</th>
                <th>hari</th>
                <th>action</th>
                
            </tr>
        </thead>
    </table>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="tambah" data-bs-target="#exampleModal">
        Tambah Data
      </button>
</div>

<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" placeholder="Masukkan Nama Lengkap">
                <input type="hidden" id="id" name="id">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">alamat_domisili</label>
                <input type="text" class="form-control" id="alamat_domisili"  name="alamat_domisili" placeholder="alamat_domisili">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">jenis_Kelamin</label>
                <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" placeholder="jenis_kelamin">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">pendidikan_terakhir</label>
                <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" placeholder="pendidikan_terakhir">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">jurusan</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="jurusan">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">hari</label>
                <input type="date" class="form-control" id="hari" name="hari" placeholder="hari">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" id="tutup" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="simpan" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function () {
        isi()
    })

    function isi() {
        $('#tabel1').DataTable({
            serverside : true,
            responseive : true,
            ajax : {
                url : "{{route('data')}}"
            },
            columns:[
                    {
                        "data" :null, "sortable": false,
                        render : function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1
                        }
                    },
                    {data: 'nama_lengkap', name: 'nama_lengkap'},
                    {data: 'alamat_domisili', name: 'alamat_domisili'},
                    {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                    {data: 'pendidikan_terakhir', name: 'pendidikan_terakhir'},
                    {data: 'jurusan', name: 'jurusan'},
                    {data: 'hari', name: 'hari'},
                    {data: 'aksi', name: 'aksi'}
                ]
        })
    }


</script>
<script>
    $('#simpan').on('click',function () {
        if ($(this).text() === 'Simpan Edit') {
            // console.log('Edit');
           edits()
        } else {
          tambah()
        }


    })
    
    $(document).on('click','.edit', function () {
        let id = $(this).attr('id')
        $('#tambah').click()
        $('#simpan').text('Simpan Edit')

        $.ajax({
            url : "{{route('edits')}}",
            type : 'post',
            data : {
                id : id,
                _token : "{{csrf_token()}}"
            },
            success: function (res) {
                // $('#id').val(res.data.id)
                // $('#nama').val(res.data.name)
                // $('#telp').val(res.data.telp)
                // $('#alamat').val(res.data.alamat)
                $('#id').val(res.data.id)
                $('#nama_lengkap').val(res.data.nama_lengkap)
                $('#alamat_domisili').val(res.data.alamat_domisili)
                $('#jenis_kelamin').val(res.data.jenis_kelamin)
                $('#pendidikan_terakhir').val(res.data.pendidikan_terakhir)
                $('#jurusan').val(res.data.jurusan)
                $('#hari').val(res.data.hari)
            }
        })

    })
    /**
     * Tambah Data
     * @date 2021-05-05
     * @returns {any}
     */
    function tambah() {
        $.ajax({
                url : "{{route('data.store')}}",
                type : "post",
                data : {
                    nama_lengkap : $('#nama_lengkap').val(),
                    alamat_domisili : $('#alamat_domisili').val(),
                    jenis_kelamin : $('#jenis_kelamin').val(),
                    pendidikan_terakhir : $('#pendidikan_terakhir').val(),
                    jurusan : $('#jurusan').val(),
                    hari : $('#hari').val(),
                    "_token" : "{{csrf_token()}}"
                },
                success : function (res) {
                    console.log(res);
                    alert(res.text)
                    $('#tutup').click()
                    $('#tabel1').DataTable().ajax.reload()
                    $('#nama_lengkap').val(null)
                    $('#alamat_domisili').val(null)
                    $('#jenis_kelamin').val(null)
                    $('#pendidikan_terakhir').val(null)
                    $('#jurusan').val(null)
                    $('#hari').val(null)
                },
                error : function (xhr) {
                    alert(xhr.responJson.text)
                }
            })
    }

    /**
     * 描述
     * @date 2021-05-05
     * @returns {any}
     */
    function edits() {
        $.ajax({
                url : "{{route('updates')}}",
                type : "post",
                data : {
                    id : $('#id').val(),
                    nama_lengkap : $('#nama_lengkap').val(),
                    alamat_domisili : $('#alamat_domisili').val(),
                    jenis_kelamin : $('#jenis_kelamin').val(),
                    pendidikan_terakhir : $('#pendidikan_terakhir').val(),
                    jurusan : $('#jurusan').val(),
                    hari : $('#hari').val(),
                    "_token" : "{{csrf_token()}}"
                },
                success : function (res) {
                    console.log(res);
                    alert(res.text)
                    $('#tutup').click()
                    $('#tabel1').DataTable().ajax.reload()
                    $('#nama_lengkap').val(null)
                    $('#alamat_domisili').val(null)
                    $('#jenis_kelamin').val(null)
                    $('#pendidikan_terakhir').val(null)
                    $('#jurusan').val(null)
                    $('#alamat').val(null)
                    $('#simpan').text('Simpan')
                },
                error : function (xhr) {
                    alert(xhr.responJson.text)
                }
            }) 
    }

    $(document).on('click','.hapus', function () {
        let id = $(this).attr('id')
        $.ajax({
            url : "{{route('hapus')}}",
            type : 'post',
            data: {
                id: id,
                "_token" : "{{csrf_token()}}"
            },
            success: function (params) {
                alert(params.text)
                $('#tabel1').DataTable().ajax.reload()
            }
        })
    })
</script>

</body>
</html> 