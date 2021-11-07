@extends('layouts.main')

@section('title', 'Biodata')

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
            <h2>Biodata</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form id="biodata">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ auth()->user()->name }}" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control noSpace" required value="{{ auth()->user()->username }}" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ auth()->user()->email }}" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" value="{{ auth()->user()->tempat_lahir }}" placeholder="Tempat Lahir">
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control date" value="{{ auth()->user()->tanggal_lahir }}" placeholder="Tanggal Lahir">
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Tanggal Lahir</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" required class="form-control">
                      <option value="laki-laki" {{ auth()->user()->jenis_kelamin === 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                      <option value="perempuan" {{ auth()->user()->jenis_kelamin === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                  <div class="form-group">
                      <label for="old_password">Old Password</label>
                      <input type="password" name="old_password" class="form-control" id="old_password">
                  </div>
                  <div class="form-group">
                      <label for="password">New Password</label>
                      <input type="password" name="password" class="form-control" id="password">
                  </div>
                  <div class="form-group">
                      <label for="password_confirmation">New Password Confimation</label>
                      <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary">Update</button>
                  </div>
            </form>
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
    <script>
        $(document).ready(function() {
            // Edit User
            $('#biodata').submit(function(e){
                e.preventDefault()
                let id = {{ auth()->user()->id }}
        
                $.ajax({
                    method: "PUT",
                    url: "{{ url('/api/biodata') }}" + "/" + id,
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    error: function(xhr, status, error) {
                        for (variable in xhr.responseJSON.data) {
                            toastr.error(xhr.responseJSON.data[variable])
                        }
                    },
                    success: function(response){
                        $('input[type="password"]').val("")
                        $('#modal-edit').modal('toggle')
                        $('#editUser').trigger("reset");
                        toastr.success('Success Update User')
                    }
                })
            })  
        })
    </script>
@endsection