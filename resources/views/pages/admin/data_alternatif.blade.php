@extends('layouts.main')

@section('title', 'Data Alternatif')

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
            <h2>Data Alternatif</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-add">Tambah Alternatif</button>
            <br /><br />
            <table id="data-alternatif" class="table table-striped table-responsive table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
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
        <h4 class="modal-title" id="myModalLabel">Edit Alternatif</h4>
      </div>
      <div id="modal-body-edit" class="modal-body">
        <form id="editAlternatif" class="form-horizontal form-label-left">
          @csrf
          @method('POST')
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input name="nama" type="text" id="nama" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama Alternatif">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gambar">Gambar</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" name="gambar" id="gambarEdit" accept="image/*" class="form-control">
            </div>
          </div>
          <div id="kriteriaGroupEdit">
            
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
        <h4 class="modal-title" id="myModalLabel">Add Alternatif</h4>
      </div>
      <div class="modal-body">
        <form id="addAlternatif" class="form-horizontal form-label-left">
          @csrf
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input name="nama" type="text" id="nama" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nama Alternatif">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gambar">Gambar</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" name="gambar" id="gambar" required accept="image/*" class="form-control">
            </div>
          </div>
          @foreach ($kriterias as $kriteria)
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="{{ $kriteria->id }}">{{ ucfirst($kriteria->nama) }}</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="{{ $kriteria->id }}" id="{{ $kriteria->id }}" required class="form-control">
                  <option value="" selected disabled>Pilih</option>
                @foreach ($kriteria->subKriterias as $sub_kriteria)
                  <option value="{{ $sub_kriteria->nilai }}">{{ $sub_kriteria->nama !== null ? $sub_kriteria->nama : $sub_kriteria->keterangan }}</option>
                @endforeach
              </select>
            </div>
          </div>
          @endforeach
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
        $('#modal-edit').on('hidden.bs.modal', function () {
          $('#editAlternatif').trigger("reset");
          $('#editAlternatif option[selected="selected"]').removeAttr('selected')
        })
        $('.date').datepicker({});

        let dataKriteria = $('#data-alternatif').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('alternatif.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'nama', name: 'nama'},
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
          
          $.get("{{ url('/api/alternatif') }}" +'/' + id, function (response) {
            console.log(response)
              $('#modal-edit').modal('toggle')
              $('#editAlternatif').data("id",id)
              $('#editAlternatif input[name="nama"]').val(response.data.nama)
              // response.data.alternatif_kriterias.forEach(alternatif_kriteria => {
              //   $('#editAlternatif select[id="'+alternatif_kriteria.kriteria_id+'"] option[value="'+alternatif_kriteria.nilai+'"]').attr("selected","selected")
              // });

              spawnKriteria(response.kriterias, response.data.alternatif_kriterias)
              
          })
      })

      function spawnKriteria(kriterias, alternatif_kriterias) {
        $('#kriteriaGroupEdit').html('')
        kriterias.forEach(kriteria => {
          let frmGroup = `<div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" for="${kriteria.id}">${kriteria.nama}</label><div class="col-md-6 col-sm-6 col-xs-12"><select name="${kriteria.id}" id="select-${kriteria.id}" required class="form-control"></select></div></div>`

          $('#kriteriaGroupEdit').append(frmGroup)

          kriteria.sub_kriterias.forEach((sub_kriteria, index) => {
            const findAlterntifKriterias = alternatif_kriterias.find(alternatif_kriteria => alternatif_kriteria.kriteria_id === kriteria.id);
            // console.log(`${findAlterntifKriterias.nilai} dan ${findAlterntifKriterias.kriteria_id}`)
            let optionElm = `<option value="${sub_kriteria.nilai}" ${findAlterntifKriterias.nilai === sub_kriteria.nilai ? 'selected' : ''}>${sub_kriteria.nama !== null ? sub_kriteria.nama : sub_kriteria.keterangan}</option>`
              $(`#select-${kriteria.id}`).append(optionElm)
            });
        });
      }

      // ADD KRITERIA
     $('#addAlternatif').submit(function(e) {
        e.preventDefault()
      
        let frm = $('form#addAlternatif');
        let formData = new FormData(frm[0]);
        formData.append('file', $('input[type=file]')[0].files[0]);

        $.ajax({
            method: "POST",
            url: "{{route('alternatif.store')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: formData,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            error: function(xhr, status, error) {
              for (variable in xhr.responseJSON.data) {
                toastr.error(xhr.responseJSON.data[variable])
              }
            },
            success: function(response){
              console.log(response)
                $('#data-alternatif').DataTable().ajax.reload();
                $('#modal-add').modal('toggle');
                $('#addAlternatif').trigger("reset");
                toastr.success('Success Add Alternatif')
            }
        })
    })

    // Edit Alternatif
    $('#editAlternatif').submit(function(e){
          e.preventDefault()
          let id = $(this).data('id')
  
          let frm = $('form#editAlternatif');
          let formData = new FormData(frm[0]);
          if( document.getElementById("gambarEdit").files.length > 0 ){
            formData.append('file', $('input[type=file]')[0].files[0]);
          }

          $.ajax({
              method: "POST",
              url: "{{ url('/api/alternatif') }}" + "/" + id + '/update',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              data: formData,
              dataType: 'JSON',
              processData: false,
              contentType: false,
              error: function(xhr, status, error) {
                  for (variable in xhr.responseJSON.data) {
                      toastr.error(xhr.responseJSON.data[variable])
                  }
              },
              success: function(response){
                  $('#data-alternatif').DataTable().ajax.reload();
                  $('#modal-edit').modal('toggle')
                  $('#editAlternatif').trigger("reset");
                  toastr.success('Success Update Alternatif')
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
                          url: "{{ url('/api/alternatif') }}" + "/" + id,
                          type: 'DELETE',
                          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                          success: function (response){
                              console.log(response)
                              $('#data-alternatif').DataTable().ajax.reload();
                          }
                      });
                  swal.close()
                  toastr.success('Alternatif Deleted')
              } else {
                  swal.close()
              }
          });
      })
    </script>
@endsection