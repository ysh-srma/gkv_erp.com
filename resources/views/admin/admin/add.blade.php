@extends('layouts.app')
@section('content')
<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row mb-2">
              <div class="col-sm-6"><h3 class="mb-0">Add New Admin</h3></div>
              <!-- <div class="col-sm-6" style="text-align :right;">
                <a href="{{ url('admin/admin/add') }}" class="btn btn-primary">Add New Admin</a>
                </div> -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row mb-4">
            
              <!--begin::Col-->
              <div class="col-md-12">
           
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                 
                  <!--begin::Form-->
                  <form method="post" action="">
                    {{ csrf_field() }}
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required placeholder="Name"/>
                      </div>
                      <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email"  value="{{ old('email') }}" required placeholder="Email"/>
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                      </div>
                      <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" required placeholder="Password"/>
                      </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
                <!--end::Quick Example-->
              </div>
    <!--end::Col-->
            
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>

@endsection