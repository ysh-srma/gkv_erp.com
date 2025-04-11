@extends('layouts.app')
@section('content')
<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row mb-2">
              <div class="col-sm-6"><h3 class="mb-0">Change Password</h3></div>
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
              <div class="col-md-6">
              @include('_message')
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                 
                  <!--begin::Form-->
                  <form method="post" action="">
                    {{ csrf_field() }}
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label>Old Password</label>
                        <input type="text" class="form-control" name="old_password" required placeholder="Old Password"/>
                      </div>
                      
                      <div class="mb-3">
                        <label>New Password</label>
                        <input type="text" class="form-control" name="new_password" required placeholder="New Password"/>
                      </div>
                                                
                     

                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Update</button>
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