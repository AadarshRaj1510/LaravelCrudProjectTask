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
                <div class="h5">Employees</div>
                    <div>
                        <a href="{{ route('employees.create')}}" class="btn btn-primary">Create</a>

                    
                </div>  
            </div>

            @if(Session::has('success'))
            <div class=" alert alert-success">
                {{ Session::get('success')}}
            </div>
            @endif
                <div class="card border-0 shadow-1g">
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>    
                                <th>GENDER</th>    
                                <th>EMAIL</th>    
                                <th>IMAGE</th>    
                                <th>STATUS</th>    
                                <th>ACTION</th>                         
                            </tr>

                            @if($employees->isNotEmpty())
                            @foreach ($employees as $employee)
                            <tr valign="middle">
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->gender }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>
                                @if($employee->image != '' && file_exists(public_path().'/uploads/employees/'.$employee->image))
                                <img src="{{ url('uploads/employees/'.$employee->image) }}" width="50" height="50" class="rounded-circle">
                                @else
                                <img src="{{ url('assets/images/mo-image.png') }}" width="50" height="50" class="rounded-circle">



                                @endif
                            </td>
                            <td>
                                
                           
                            <select name="" id="" class="form-select" aria-label="Default select example">
                                <option value="" @if($employee->status == 'Active' ) selected @endif>Active</option>
                                <option value="" @if($employee->status == 'Inactive' ) selected @endif>Inactive</option>

                                </select>
                        
                        </td>
                            <td>

                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ route('employees.destroy',$employee->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-primary btn-sm">Show</a>




                              
                           
                            </td>                            
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6">Record Not Found</td>
                            </tr>
                            @endif

                        </table>
                    </div>
                </div>  
        
        
       </div>

</body>
</html>


    