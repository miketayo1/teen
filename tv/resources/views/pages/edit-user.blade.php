<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='User Management'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-100 border-radius-xl mt-4">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                   
            
                    
                </div>
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-3">Edit User</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @if (session('status'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ Session::get('status') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                    data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @endif
                        @if (Session::has('demo'))
                                <div class="row">
                                    <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                        <span class="text-sm">{{ Session::get('demo') }}</span>
                                        <button type="button" class="btn-close text-lg py-3 opacity-10"
                                            data-bs-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                        @endif
                        <form method='POST' action='{{route("edituser", ["id" => $user->id] ) }}'>
                            @csrf
                            @if(Auth::user()->id != $user->id)
                            <div class="row">
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" value ="{{$user->email}}" class="form-control border border-2 p-2" readonly>
                                  
                                </div>
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" value ="{{$user->name}}" class="form-control border border-2 p-2" readonly>
                                    @error('name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                </div>
                               
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="number" name="phone" value ="{{$user->phone}}" class="form-control border border-2 p-2" readonly>
                                    @error('phone')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                @else
                                <div class="row">
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" value ="{{$user->email}}" class="form-control border border-2 p-2" >
                                  
                                </div>
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" value ="{{$user->name}}" class="form-control border border-2 p-2" >
                                    @error('name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                </div>
                               
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="number" name="phone" value ="{{$user->phone}}" class="form-control border border-2 p-2" >
                                    @error('phone')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                @endif
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Role</label>
                                    <!-- <select name="role" value ="{{$user->role}}" class="form-control border border-2 p-2">
                                        <option>Select </option>
                                        <option >Admin</option>
                                        <option>Editor</option>
                                    </select> -->
                                    <div class="form-group">
                                    <input type="checkbox"  name="role"  value="Admin"> <label for="demoCheckbox"> Admin</label>
                                    <input type="checkbox"  name="role"  value="Editor"> <label for="demoCheckbox"> Editor</label>
                                    
                                    </div>
                                    
                                    <script type="text/javascript">
                                       
                                        $("input:checkbox").on('click', function() {
                                            // in the handler, 'this' refers to the box clicked on
                                            var $box = $(this);
                                            if ($box.is(":checked")) {
                                                // the name of the box is retrieved using the .attr() method
                                                // as it is assumed and expected to be immutable
                                                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                                                // the checked state of the group/box on the other hand will change
                                                // and the current value is retrieved using .prop() method
                                                $(group).prop("checked", false);
                                                $box.prop("checked", true);
                                            } else {
                                                $box.prop("checked", false);
                                            }
                                            });
                                    </script>
                                    
                                </div>
                                
                               
                                
                                
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Edit User</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>
