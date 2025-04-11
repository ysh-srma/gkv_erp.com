@extends('layouts.app')
@section('content')
<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row mb-2">
              <div class="col-sm-6"><h3 class="mb-0">Edit Student</h3></div>
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
                  <form method="post" action="" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row">
                        <h4>Student Details</h4>
                            <div class="form-group col-md-6">
                                <label>First Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('name' , $getRecord->name) }}" name="name" required placeholder="First Name"/>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Last Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('last_name', $getRecord->last_name) }}" name="last_name" required placeholder="Last Name"/>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Admission Number<span style="color: red;">*</span></label>
                                <input type="varchar" class="form-control" value="{{ old('admission_number' , $getRecord->admission_number) }}" name="admission_number" required placeholder="Admission Number"/>
                                <p class="text-danger">{{ $errors->first('admission_number') }}</p>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Roll number<span style="color: red;">*</span></label>
                                <input type="varchar" class="form-control"  value="{{ old('roll_number', $getRecord->roll_number) }}" name="roll_number" required placeholder="Roll Number"/>
                                <p class="text-danger">{{ $errors->first('roll_number') }}</p>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Class<span style="color: red;">*</span></label>
                                <select class="form-control" name="class_id" value="{{ old('class_id', $getRecord->class_id) }}" required>
                                    <option value="">Select Class</option>
                                    @foreach($getClass as $value)
                                        <option {{ (old('class_id', $getRecord->class_id) == $value->id) ? 'selected' : '' }}  value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                 
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Gender<span style="color: red;">*</span></label>
                                <select class="form-control" name="gender" value="{{ old('gender', $getRecord->gender) }}" required>
                                    <option value="">Select Gender</option>
                                    <option {{ (old('gender',$getRecord->gender) == 'Male') ? 'selected' : '' }}  value="Male">Male</option>
                                    <option {{ (old('gender',$getRecord->gender) == 'Female') ? 'selected' : '' }}  value="Female">Female</option>
                                    <option {{ (old('gender',$getRecord->gender) == 'Other') ? 'selected' : '' }}  value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Date of Birth<span style="color: red;">*</span></label>
                                <input type="date" class="form-control"  value="{{ old('date_of_birth', $getRecord->date_of_birth) }}" name="date_of_birth" required />
                            </div>

                            <div class="form-group col-md-6">
                                <label>Caste<span style="color: red;">*</span></label>
                                <select class="form-control" name="caste" value="{{ old('caste', $getRecord->caste) }}" required>
                                    <option  value="">Select Caste</option>
                                    <option {{ (old('caste',$getRecord->caste) == 'UR') ? 'selected' : '' }} value="UR">UR</option>
                                    <option {{ (old('caste',$getRecord->caste) == 'OBC') ? 'selected' : '' }} value="OBC">OBC</option>
                                    <option {{ (old('caste',$getRecord->caste) == 'SC|ST') ? 'selected' : '' }} value="SC|ST">SC|ST</option>
                                </select>   

                            </div>

                            <div class="form-group col-md-6">
                                <label>Religion<span style="color: red;">*</span></label>
                                <select class="form-control" name="religion" value="{{ old('religion', $getRecord->religion) }}" required>
                                    <option value="">Select Religion</option>
                                    <option {{ (old('religion',$getRecord->religion) == 'Hindu') ? 'selected' : '' }} value="Hindu">Hindu</option>
                                    <option {{ (old('religion',$getRecord->religion) == 'Muslim') ? 'selected' : '' }} value="Muslim">Muslim</option>
                                    <option {{ (old('religion',$getRecord->religion) == 'sikh') ? 'selected' : '' }} value="sikh">Sikh</option>
                                </select> 
                             </div>

                            <div class="form-group col-md-6">
                                <label>Moblie Number<span style="color: red;">*</span></label>
                                <input type="varchar" class="form-control"  value="{{ old('moblie_number', $getRecord->moblie_number) }}" name="moblie_number" required placeholder="Moblie Number"/>
                                <p class="text-danger">{{ $errors->first('moblie_number') }}</p>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Admission Date<span style="color: red;">*</span></label>
                                <input type="date" class="form-control"  value="{{ old('admission_date', $getRecord->admission_date) }}" name="admission_date" required />
                            </div>

                            <div class="form-group col-md-6">
                                <label>Profile Pic</label>
                                <input type="file" class="form-control" name="profile_pic" value="{{ old('profile_pic', $getRecord->profile_pic) }}" />
                                @if(!empty($getRecord->getProfile()))
                                <img src="{{ $getRecord->getProfile() }}"  style="width: auto; height: 100px;"/> 
                                @endif
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>Blood Group<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="blood_group" value="{{ old('blood_group', $getRecord->blood_group) }}" required placeholder="Blood Group"/>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Height<span style="color: red;">*</span></label>
                                <input type="int" class="form-control" name="height" value="{{ old('height', $getRecord->height) }}" required placeholder="Height"/>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Weight<span style="color: red;">*</span></label>
                                <input type="int" class="form-control" name="weight" value="{{ old('weight', $getRecord->weight) }}" required placeholder="Weight"/>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Status<span style="color: red;">*</span></label>
                                <select class="form-control" name="status" value="{{ old('status', $getRecord->status) }}" required>
                                    <option  value="">Select Status</option>
                                    <option {{ (old('status',$getRecord->status) == 0 ) ? 'selected' : '' }} value="0">Active</option>
                                    <option {{ (old('status',$getRecord->status) == 1 ) ? 'selected' : '' }} value="1">Inactive</option>
                                </select>
                            </div>
                        </div>
                            <hr />
                        <h4>Login Details</h4>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label>Email<span style="color: red;">*</span></label>
                                <input type="email" class="form-control" name="email"  value="{{ old('email', $getRecord->email) }}" required placeholder="Email"/>
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Password<span style="color: red;">*</span></label>
                                <input type="password" class="form-control" name="password"  placeholder="Password"/>
                                <p>Do you want to change password then, add new password</p>
                            </div>

                        </div>
                      
                      
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