<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="Configuration"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Configuration'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-100 border-radius-xl mt-4">
                
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
            
                <div class="row gx-4 mb-2">
                    
                    <div class="">
                        <div class="">
                        <div class="">
                                            <a class="btn bg-gradient-dark mb-0" href="{{route('get-logo')}} "><i
                                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Update Logo
                                            </a><hr>
                                                @if($logo == null)
                                    <img src="{{ URL::to('/logo/teentv.jpg')}}" style='height: 104px; width: 140px;' >
                                    @else
                                    <img src="{{ URL::to('/logo')}}/{{$logo->path}}" style='height: 104px; width: 140px;' >
                                    @endif
                                </div>
                                        
                            
                        </div>
                    </div>
                </div>
                <div class="row gx-4 mb-2">
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
                    
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                Contact Form  
                            </h5>
                            <form method='POST' action='{{route("contact") }}' enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                             
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Address: </label>
                                    <input type="text" name="addr" placeholder="Address" value= "{{$contact->address}}"  class="form-control border border-2 p-2" >
                                    @error('name')
                                    <p class='text-danger inputerror'>{{ $message }} </p> 
                                    @enderror
                                </div>
                               
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone:</label>
                                    <input type="text" name="phone" placeholder="Phone" value= "{{$contact->phone}}" class="form-control border border-2 p-2" >
                                    @error('name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email:</label>
                                    <input type="text" name="email" placeholder="Email" value= "{{$contact->email}}" class="form-control border border-2 p-2" >
                                    @error('name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                               
                                
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Update</button>
                        </form>
                            
                        </div>
                    </div>
                    <div class="row">
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <div class="card card-plain h-100">
                                        <div class="card-header pb-0 p-3">
                                            <h6 class="mb-5">Upload Sliders</h6>
                                        </div>
                                        <div class="card card-plain h-100">
                            
                            <div class="card-body p-3">
                            
                                <form method='POST' action='{{route("slider") }}' enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                    
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" placeholder="Name" class="form-control border border-2 p-2" >
                                            @error('name')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>
                                    
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" placeholder="Description" class="form-control border border-2 p-2" ></textarea>
                
                                            @error('phone')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">File</label>
                                            <input type="file" name="path" accept="image/jpg, image/jpeg, image/png"   class="form-control border border-2 p-2" >
                                            @error('phone')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>
                                    
                                        
                                    </div>
                                    <button type="submit" class="btn bg-gradient-dark">Upload</button>
                                </form>

                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="mb-5 ps-3">
                                <h6 class="mb-1">Sliders</h6>
                            
                            </div>
                            
                            <div class="row">
                            @foreach ($sliders as $slider)    
                                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                    <div class="card card-blog card-plain">
                                        <div class="card-header p-0 mt-n4 mx-3">
                                            <a class="d-block shadow-xl border-radius-xl">
                                                <img src="{{ URL::to('/sliders')}}/{{$slider->path}}"
                                                    alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                            </a>
                                        </div>
                                        <div class="card-body p-3">
                                            <p class="mb-0 text-sm">@livewire('count-toggle', ['model' => $slider, 'field' => 'active'], key($slider->id))</p>
                                            <h5>
                                                    {{$slider->name}}
                                                    
                                                </h5>
                                                @livewire('toggle-button', ['model' => $slider, 'field' => 'active'], key($slider->id))
                                               
                                            <br>
                                            <p class="mb-4 text-sm">
                                                {{$slider->description}}
                                            </p>
                                            <div class="d-flex align-items-center justify-content-between">
                                            <a href ="{{route('edit-slider', ['id'=> $slider->id])}} ">
                                                <button type="button" class="btn btn-outline-primary btn-sm mb-0">
                                                    Edit </button></a>
                                            <a href ="{{route('delete-slider', ['id'=> $slider->id])}} " id="delete">
                                                    <button type="button" onclick="deleteSlider('{{route('delete-slider', ['id'=> $slider->id])}}')" class="btn btn-outline-primary btn-sm mb-0">
                                                    Delete</button>
                                            </a>
                                            <script>
                                                $(document).ready(function() {
                                                    
                                                    $.ajaxSetup({
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                    }
                                                    });
                                                });

                                                function deleteSlider(url) {
                                                    
                                                    if(confirm('Are you sure?')) {
                                                    $.ajax({
                                                        type: "POST",
                                                        url: url,
                                                        success: function(result) {
                                                        location.reload();
                                                        }
                                                    });
                                                    }
                                                }
                                            </script>
                                            
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                           
                        </div>
                   
                </div>
                
               
                        
                
            </div>
                        
                     
                        
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>
