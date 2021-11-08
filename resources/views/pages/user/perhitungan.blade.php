@extends('layouts.main')

@section('title', 'Perhitungan')

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
            <h2>Perhitungan SPK</h2>
            <div class="clearfix"></div>
          </div>
          <div id="mywizard">
            <div class="x_content step step1">
              <form id="perhitungan">
                @foreach ($kriterias as $kriteria)
                <div class="form-group">
                    <label for="{{ $kriteria->id }}">{{ $kriteria->nama }}</label>
                    <input type="text" required id="{{ $kriteria->id }}" name="{{ $kriteria->id }}" class="form-control decimalOnly" placeholder="{{ $kriteria->nama }}">
                </div>
                @endforeach
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary">Hitung</button>
                  </div>
              </form>
            </div>
            <div class="x_content step step2">
              <h3>Kami Merekomendasikan :</h3>
              <div id="select_wisata" style="margin-bottom: 50px">
                {{-- <h4>2. Satu <button type="button" class="btn btn-xs btn-primary">Pilih</button></h4> --}}
              </div>
              <button type="button" class="btn back btn-secondary">Back</button>
              <a href="javascript:;" data-target="#hasil-perhitungan" data-toggle="modal" class="btn btn-primary">Lihat Hasil Perhitungan</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{{ asset('template/jquery-stepper/jquery.stepper.src.js') }}"></script>

{{-- Modal Hasil --}}
<div class="modal fade" id="hasil-perhitungan" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Hasil Perhitungan</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 table-responsive">
            <table id="hasilHitung" width="100%" class="table table-striped table-responsive table-bordered">
              <thead>
                <tr>
                  <th>Nama</th>
                  @foreach ($kriterias as $key => $kriteria)
                    <th>{{ $kriteria->nama }}</th>
                  @endforeach
                  <th>Hasil</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    var myWizard = $('#mywizard').stepper();
    myWizard.showStep(1);

    // Next Step
    $(document).on('submit','#perhitungan', function(e) {
        e.preventDefault()

        $.ajax({
            method: "POST",
            url: "{{route('hitung')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: $(this).serialize(),
            dataType: 'JSON',
            error: function(xhr, status, error) {
              for (variable in xhr.responseJSON.data) {
                toastr.error(xhr.responseJSON.data[variable])
              }
            },
            success: function(response){     
              console.log(response)   
              let dataSet = [];
              for (variable in response.data) {
                let temp_dataSet = [];
                temp_dataSet.push(response.data[variable].nama);
                console.log(response.data[variable])                    
                $('#select_wisata').append(`<h4>${+variable+1}. ${response.data[variable].nama} <span class="badge badge-info">${response.data[variable].hasil}</span></h4>`)
                
                for (let index = 0; index < response.data[variable].perhitungan.length; index++) {
                  const element = response.data[variable].perhitungan[index];
                  temp_dataSet.push(parseFloat(element).toFixed(2))
                }
                temp_dataSet.push(response.data[variable].hasil)

                dataSet.push(temp_dataSet)
              }

              var index = $('#hasilHitung').find('th:last').index();
              $('#hasilHitung').DataTable( {
                  data: dataSet,
                  order: [
                      [index, "desc"]
                  ]
              }).columns.adjust();
            }
        })
        .done(function() {
          myWizard.nextStep()
        })
    })  

    // Back Step
    $(document).on('click', '.back', function() {
      $('#select_wisata').html("")
      var table = $('#hasilHitung').DataTable();
      table.destroy();
      myWizard.prevStep()
    })
</script>
@endsection