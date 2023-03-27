<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD TASK</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>

    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">CRUD TASK</div>
        </div>    
    </div>

    
        <div class="container ">
            <div class="d-flex justify-content-between py-3">
                <div class="h4">Edit Employee Details</div>
                    <div>
                        <a href="{{ route('employees.index')}}" class="btn btn-primary">Back</a>

                    
                </div>  
            </div>


            <form action="{{ route('employees.update',$employee->id)}}" method="post" enctype="multipart/form-data">     
                @csrf       
                 @method('put') 
               
                <div class="card border-0 shadow-1g">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" placeholder="Enter Name" value="{{ $employee->name }}" class="form-control @error('name') is-invalid @enderror"> 
                            @error('name')
                            <p class ="invalid-feedback">{{ $message }}</p>
                            @enderror                 
                        </div>
        <?php
        //  dd($employee->hobbies);
        
        ?>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <input class="form-check-input" type="radio" name="gender"  value="Male" @if($employee->gender == 'Male') checked @endif>
                          
                            <label class="form-check-label" for="flexRadioDefault">
                                Male
                            </label>          
                            
                            <input class="form-check-input " type="radio" name="gender"  value="Female" @if($employee->gender == 'Female') checked @endif>
                            <label class="form-check-label" for="flexRadioDefault">
                                Female
                            </label>
                           
                        </div>

                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile No." value="{{ old ('mobile', $employee->mobile) }}" class="form-control @error('mobile') is-invalid @enderror">                  
                            @error('mobile')
                            <p class ="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" placeholder="Enter Address" class="form-control" cols="30" rows="4"></textarea>                  
                       
                        </div> -->

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter email" value="{{ old ('email', $employee->email) }}" class="form-control @error('email') is-invalid @enderror">                  
                            @error('email')
                            <p class ="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="hobbies" class="form-label">Hobbies</label>
                            <input class="form-check-input" type="checkbox" name="hobbies" value="Reading"  @if($employee->hobbies == 'Reading') checked @endif>
                            <label class="form-check-label" for="flexCheckDefault">
                                Reading
                            </label>
                            
                            <input class="form-check-input" type="checkbox" name="hobbies" value="Sports" @if($employee->hobbies == 'Sports') checked @endif>
                            <label class="form-check-label" for="flexCheckDefault">
                                Sports
                            </label>
                        </div>

                        <!-- <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" value="Active" >
                            <label class="form-check-label" for="flexRadioDefault1">
                               Active
                            </label>          
                            
                            <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" value="Inactive" >
                            <label class="form-check-label" for="flexRadioDefault1">
                                Inactive
                            </label>
                            @error('status')
                            <p class ="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div> -->

                        <div class="mb-3">
                            <label for="image" class="form-label @error('image') is-invalid @enderror"></label>
                            <input type="file" name="image" >    
                            @error('image')
                            <p class ="invalid-feedback">{{ $message }}</p>
                            @enderror 
                            
                            <div class="pt-3">
                            
                            @if($employee->image != '' && file_exists(public_path().'/uploads/employees/'.$employee->image))
                                <img src="{{ url('uploads/employees/'.$employee->image) }}" width="100" height="100" class="rounded-circle">
                            @endif
                             </div>
                        </div>
                       
                    </div>
                </div>  

                <button class="btn btn-primary my-3 ">Update Employee Details</button>
            </form>
        
       </div>

</body>
</html>