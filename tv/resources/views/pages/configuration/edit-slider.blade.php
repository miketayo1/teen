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
                <div class="row">
                    <div class="row">
                        
                        <div class="col-12 mt-4">
                            <div class="card card-plain h-100">
                                <div class="card-header pb-0 p-3">
                                    <h6 class="mb-5">Update Slider</h6>
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
                        <form method='POST' action='{{route("slider-update", ["id"=> $slider->id]) }}' enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                             
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" placeholder="Name" value="{{$slider->name}}" class="form-control border border-2 p-2" >
                                    @error('name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                               
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" placeholder="Description"  class="form-control border border-2 p-2" >{{$slider->description}}</textarea>
        
                                    @error('phone')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-3">
                                    <label class="form-label">File</label>
                                    <input type="file" name="path" value="{{$slider->path}}"  class="form-control border border-2 p-2" >
                                    @error('phone')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <img src="{{ URL::to('/sliders')}}/{{$slider->path}}" style='height: 104px; width: 140px;' >
                                </div>
                               
                                
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Update</button>
                        </form>

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