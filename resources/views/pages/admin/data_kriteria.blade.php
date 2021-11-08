@extends('layouts.main')

@section('title', 'Data Kriteria')

@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <!-- <div class="title_left">
                <h3>Users <small>Some examples to get you started</small></h3>
              </div> -->
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Data Kriteria</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Kriteria</button>
            <br /><br />
            <table id="data-kriteria" class="table table-striped table-responsive table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  {{-- <th>Bobot</th> --}}
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Kriteria</h4>
      </div>
      <div class="modal-body">
        <form id="editKriteria" class="form-horizontal form-label-left">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="nama" type="text" id="nama" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama Kriteria">
              </div>
            </div>
            {{-- <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kepentingan<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" id="edit_kepentingan" required name="bobot">
                  <option value="" disabled selected>Pilih Kepentingan</option>
                  <option value="1" id="bobot_1">Tidak Penting</option>
                  <option value="2" id="bobot_2">Kurang Penting</option>
                  <option value="3" id="bobot_3">Cukup Penting</option>
                  <option value="4" id="bobot_4">Penting</option>
                  <option value="5" id="bobot_5">Sangat Penting</option>
                </select>
              </div>
            </div> --}}
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis<span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" id="edit_jenis" required name="benefit">
                  <option value="" disabled selected>Pilih Jenis</option>
                  <option value="1" id="keterangan_1">Benefit</option>
                  <option value="0" id="keterangan_0">Cost</option>
                </select>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12 text-center" style="margin-bottom: 10px;">
              <h2 style="display: inline;">Sub Kriteria</h2>
              <button class="btn btn-primary btn-xs" type="button" id="addSubKriteriaEdit" style="display: inline;"><i class="fa fa-plus"></i></button>
              <button class="btn btn-danger btn-xs" type="button" id="removeSubKriteriaEdit" style="display: inline;"><i class="fa fa-trash"></i></button>
            </div>
            <div id="subKriteriaGroupEdit">
              
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Modal Add --}}
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tambah Kriteria</h4>
      </div>
      <div class="modal-body">
        <form id="addKriteria" class="form-horizontal form-label-left">
          @csrf
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input name="nama" type="text" id="nama" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama Kriteria">
              </div>
            </div>
            {{-- <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kepentingan <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" id="edit_kepentingan" required name="bobot">
                  <option value="" disabled selected>Pilih Kepentingan</option>
                  <option value="1">Tidak Penting</option>
                  <option value="2">Kurang Penting</option>
                  <option value="3">Cukup Penting</option>
                  <option value="4">Penting</option>
                  <option value="5">Sangat Penting</option>
                </select>
              </div>
            </div> --}}
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="benefit">Benefit/Cost <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" id="benefit" required name="benefit">
                  <option value="1">Benefit</option>
                  <option value="0">Cost</option>
                </select>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12 text-center" style="margin-bottom: 10px;">
              <h2 style="display: inline;">Sub Kriteria</h2>
              <button class="btn btn-primary btn-xs" type="button" id="addSubKriteria" style="display: inline;"><i class="fa fa-plus"></i></button>
              <button class="btn btn-danger btn-xs" type="button" id="removeSubKriteria" style="display: inline;"><i class="fa fa-trash"></i></button>
            </div>
            <div id="subKriteriaGroup">
              <div class="sub-kriteria">
                <div class="col-md-4 form-group">
                  <input type="text" name="nama_sub_kriteria[]" class="form-control" id="nama_sub_kriteria[]" placeholder="Nama">
                </div>
                <div class="col-md-4 form-group">
                  <input type="text" name="keterangan[]" class="form-control" id="keterangan[]" placeholder="Keterangan">
                </div>
                <div class="col-md-4 form-group">
                  <input type="text" name="nilai[]" class="form-control decimalOnly" id="nilai[]" placeholder="Nilai">
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
{{-- <link rel="stylesheet" type="text/css" media="all" href="{{ asset('template/bootstrap-daterangepicker/daterangepicker.css') }}" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('template/moment/moment.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script type="text/javascript" src="{{ asset('template/bootstrap-daterangepicker/daterangepicker.js') }}"></script> --}}
    <script>
      $(document).ready(function() {
        $('.date').datepicker({});

        let dataKriteria = $('#data-kriteria').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('kriteria.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'nama', name: 'nama'},
              // {data: 'ternormalisasi', name: 'ternormalisasi'},
              {data: 'keterangan', name: 'keterangan'},
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
              },
          ]
        });
      })

      $(document).on('click','.edit', function() {
          let id = $(this).data("id")
          
          $.get("{{ url('/api/kriteria') }}" +'/' + id, function (response) {
              $('#modal-edit').modal('toggle')
              $('#editKriteria').data("id",id)
              $('#editKriteria input[name="nama"]').val(response.data.nama)
              // $('#editKriteria option[id="bobot_'+response.data.bobot+'"]').attr('selected','selected');
              $('#editKriteria option[id="keterangan_'+response.data.benefit+'"]').attr('selected','selected');

            response.data.sub_kriterias.forEach(subkriteria => {
              let element = '<div class="sub-kriteria-edit"><div class="col-md-4 form-group"><input type="text" required name="nama_sub_kriteria[]" value="'+subkriteria.nama+'" class="form-control" id="nama_sub_kriteria[]" placeholder="Nama"></div><div class="col-md-4 form-group"><input type="text" name="keterangan[]" value="'+subkriteria.keterangan+'" class="form-control" required id="keterangan[]" placeholder="Keterangan"></div><div class="col-md-4 form-group"><input type="text" required name="nilai[]" class="form-control decimalOnly" value="'+subkriteria.nilai+'" id="nilai[]" placeholder="Nilai"></div></div>'
              $('#subKriteriaGroupEdit').append(element)
            });
          })
      })

      // ADD KRITERIA
     $('#addKriteria').submit(function(e) {
        e.preventDefault()
      
        $.ajax({
            method: "POST",
            url: "{{route('kriteria.store')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: $(this).serialize(),
            dataType: 'JSON',
            error: function(xhr, status, error) {
              for (variable in xhr.responseJSON.data) {
                toastr.error(xhr.responseJSON.data[variable])
              }
            },
            success: function(response){
                $('#data-kriteria').DataTable().ajax.reload();
                $('#modal-add').modal('toggle');
                $('#addKriteria').trigger("reset");
                toastr.success('Success Add Kriteria')
            }
        })
    })

    // Edit Kriteria
    $('#editKriteria').submit(function(e){
          e.preventDefault()
          let id = $(this).data('id')
  
          $.ajax({
              method: "PUT",
              url: "{{ url('/api/kriteria') }}" + "/" + id,
              data: $(this).serialize(),
              dataType: 'JSON',
              error: function(xhr, status, error) {
                  for (variable in xhr.responseJSON.data) {
                      toastr.error(xhr.responseJSON.data[variable])
                  }
              },
              success: function(response){
                console.log(response)
                  $('#data-kriteria').DataTable().ajax.reload();
                  $('#modal-edit').modal('toggle')
                  $('#editKriteria').trigger("reset");
                  toastr.success('Success Update Kriteria')
              }
          })
      })

      // EDIT DELETE PANEN
      $(document).on('click', '.delete', function(e) {
          e.preventDefault()
          let id = $(this).data("id")

          swal({
              title: "Are you sure?",
              text: "You will not be able to recover this imaginary file!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              cancelButtonText: "No, cancel plx!",
              closeOnConfirm: false,
              closeOnCancel: false
          }, function(isConfirm){
              if (isConfirm) {
                  $.ajax({
                          url: "{{ url('/api/kriteria') }}" + "/" + id,
                          type: 'DELETE',
                          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                          success: function (response){
                              console.log(response)
                              $('#data-kriteria').DataTable().ajax.reload();
                          }
                      });
                  swal.close()
                  toastr.success('Kriteria Deleted')
              } else {
                  swal.close()
              }
          });
      })

      $(document).on('click', '#addSubKriteria', function(e) {
        e.preventDefault();
        let element = '<div class="sub-kriteria"><div class="col-md-4 form-group"><input type="text" required name="nama_sub_kriteria[]" class="form-control" id="nama_sub_kriteria[]" placeholder="Nama"></div><div class="col-md-4 form-group"><input type="text" name="keterangan[]" class="form-control" required id="keterangan[]" placeholder="Keterangan"></div><div class="col-md-4 form-group"><input type="text" required name="nilai[]" class="form-control decimalOnly" id="nilai[]" placeholder="Nilai"></div></div>'

        $('#subKriteriaGroup').append(element)
      })

      $(document).on('click', '#removeSubKriteria', function(e) {
        e.preventDefault();
        let numOfDiv = $('.sub-kriteria').length;
        if (numOfDiv > 1) {
          $("#subKriteriaGroup").children("div[class=sub-kriteria]:last").fadeOut(300, function() { $(this).remove(); });
        }
        return;
        
      })

      $(document).on('click', '#addSubKriteriaEdit', function(e) {
        e.preventDefault();
        let element = '<div class="sub-kriteria-edit"><div class="col-md-4 form-group"><input type="text" required name="nama_sub_kriteria[]" class="form-control" id="nama_sub_kriteria[]" placeholder="Nama"></div><div class="col-md-4 form-group"><input type="text" name="keterangan[]" class="form-control" required id="keterangan[]" placeholder="Keterangan"></div><div class="col-md-4 form-group"><input type="text" required name="nilai[]" class="form-control decimalOnly" id="nilai[]" placeholder="Nilai"></div></div>'

        $('#subKriteriaGroupEdit').append(element)
      })

      $(document).on('click', '#removeSubKriteriaEdit', function(e) {
        e.preventDefault();
        let numOfDiv = $('.sub-kriteria-edit').length;
        if (numOfDiv > 1) {
          $("#subKriteriaGroupEdit").children("div[class=sub-kriteria-edit]:last").fadeOut(300, function() { $(this).remove(); });
        }
        return;
        
      })

      $('#modal-edit').on('hidden.bs.modal', function (e) {
        $('#subKriteriaGroupEdit').html('')
      })
    </script>
@endsection