@extends('layouts.main')

@section('title', 'Data Siswa')

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
            <h2>Data User</h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="data-user" class="table table-striped table-responsive table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Jenis Kelamin</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
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
        $('#data-user').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('user.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'username', name: 'username'},
              {data: 'jenis_kelamin', name: 'jenis_kelamin'},
              {data: 'tempat_lahir', name: 'tempat_lahir'},
              {data: 'tanggal_lahir', name: 'tanggal_lahir'},
          ]
        });
      })

    </script>
@endsection