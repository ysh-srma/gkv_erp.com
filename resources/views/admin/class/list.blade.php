@extends('layouts.app')
@section('content')

 <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row mb-2">
              <div class="col-sm-6"><h3 class="mb-0"> Class List(Total : {{ $getRecord->total() }})</h3></div>
              <div class="col-sm-6" style="text-align :right;">
                <a href="{{ url('admin/class/add') }}" class="btn btn-primary">Add New Class</a>
                </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">                           
            
              <!--begin::Col-->
              <div class="col-md-12">
                <div class="card card-primary card-outline mb-4">

                  <div class="card-header">
                    <h3 class="card-title"> Search Class List</h3>
                  </div>
                
           
                <!--begin::Quick Example-->
                
                 
                  <!--begin::Form-->
                  <form method="get" action="">
                    <!--begin::Body-->
                    <div class="card-body">

                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}"  placeholder="Name"/>
                      </div>
                      
                      
                      <div class="form-group col-md-3">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date"  value="{{ Request::get('date') }}" />
                      </div>

                      <div class="form-group col-md-3">
                      <button type="submit" class="btn btn-primary" style="margin-top: 24px;">Search</button>
                      <a href="{{ url('admin/class/list') }}" class="btn btn-danger" style="margin-top: 24px;">Reset</a>
                    </div>

                    </div>
                    </div>
                    <!--end::Body-->
                  </form>
                  <!--end::Form-->
                </div>
                <!--end::Quick Example-->
              </div>
               <!--end::Col-->
              </div>
            <!--end::Row-->
          </div>
       <!-- / </div> -->
        <!--end::Container-->




        
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <!-- <div class="container-fluid"> -->
            <!--begin::Row-->
            <div class="row">
              
              <div class="col-md-12">
              @include('_message')
                <div class="card card-primary card-outline mb-8">
                  <div class="card-header">
                    <h3 class="card-title">Class List</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Class Status</th>
                          <th>Created By</th>
                          <th>Create Date</th>
                          <th>Update Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($getRecord as $value)
                        <tr>
                          <td>{{  $value->id }}</td>
                          <td>{{ $value->name }}</td>
                          <td>
                            @if($value->status == 0)
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                          <td>{{ $value->created_by_name }}</td>
                          <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                          <td>{{ date('d-m-Y', strtotime($value->updated_at)) }}</td>
                            <td>
                                <a href="{{ url('admin/class/edit/'.$value->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url('admin/class/delete/'.$value->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                       
                      </tbody>
                    </table>
                    <div class="row mb-2">
                        <div class="col-md-6" style="text-align:left;"> 
                          <strong>Showing {{ $getRecord->firstItem() }} to {{ $getRecord->lastItem() }}</strong>
                        </div>
                        <div class="col-md-5" style="text-align:right;">
                          <strong>Page {{ $getRecord->currentPage() }} of {{ $getRecord->lastPage() }}</strong>
                        </div>
                      </div>
                       <div style="padding: 10px; float:right;">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

                    </div>
                    
                   
                     



                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
@endsection