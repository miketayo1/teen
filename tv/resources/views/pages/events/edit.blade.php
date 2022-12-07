<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-profile"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Add Event'></x-navbars.navs.auth>
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
                                <h4 class="mb-3">Edit Event</h4>
                            </div>
                        </div>
                    </div>
                        
                                    <div class=" me-3 my-3 text-end">
                                        <a class="btn bg-gradient-dark mb-0" href="{{route('get-event')}}"><i
                                                class="material-icons text-sm">arrow_back</i>Back
                                        </a>
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
                        <form method='POST' enctype="multipart/form-data" action='{{ route('post-edit-event',['id'=>$event->id]) }}'>
                            @csrf
                            <div class="row">
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control border border-2 p-2" name="description">{{$event->description}}  </textarea>
                                    
                                    @error('description')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                </div>
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" value=" {{$event->name}}" class="form-control border border-2 p-2" >
                                    @error('name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Schedule</label>
                                    <textarea class="form-control border border-2 p-2" name="schedule" placeholder="Schedule">{{$event->schedule}}  </textarea>
                                    
                                    @error('schedule')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Images</label>
                                    <input type="file" name="image[]" multiple="multiple" class="form-control border border-2 p-2" >
                                    @error('image')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                @if($images == null)
                                    <img src="{{ URL::to('/logo/teentv.jpg')}}" style='height: 104px; width: 140px;' >
                                    @else
                                    @foreach($images as $image)
                                        <img src="{{ URL::to('/events')}}/{{$image->path}}" style='height: 104px; width: 140px;' >
                                    @endforeach
                                    @endif
                                </div>

                                <div class="mb-3 col-md-10">
                                    <label class="form-label">Video:</label>
                                    
                                    <input type="file" value = "{{$event->video}}" name="video" class="form-control">
                                    @error('image')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    @if($event->video == null)
                                    
                                    @else
                                    
                                    <video width="320" height="240" controls>
                                        <source src="{{ URL::to('/videos')}}/{{$event->video}}" type="video/mp4" class="form-control border border-2 p-2" >
                                      
                                    </video>
                                    
                                    @endif
                                </div>

                            
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Snippet 1:</label>
                                    <input type="text" name="link1" value="{{$videos->link1}}" placeholder="YouTube embeded Link e.g https://www.youtube.com/embed/ULmX7fsvj5S10"  class="form-control border border-2 p-2" >
                                    @if($videos == null)
                                    
                                    @else
                                    <iframe width="300" height="215" src="{{$videos->link1}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        
                                    
                                    @endif
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Snippet 2:</label>
                                        <input type="text" name="link2" value="{{$videos->link2}}"  placeholder="YouTube embeded Link e.g https://www.youtube.com/embed/ULmX7fsvj5S10"  class="form-control border border-2 p-2" >
                                        @if($videos == null)
                                    
                                    @else
                                    <iframe width="300" height="215" src="{{$videos->link2}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        
                                    
                                    @endif
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Snippet 3:</label>
                                        <input type="text" name="link3" value="{{$videos->link3}}" placeholder="YouTube embeded Link e.g https://www.youtube.com/embed/ULmX7fsvj5S10"  class="form-control border border-2 p-2" >
                                        @if($videos == null)
                                    
                                    @else
                                    <iframe width="300" height="215" src="{{$videos->link3}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        
                                    
                                    @endif
                                </div>
                               
                                <button type="submit" class="btn bg-gradient-dark">Update Event</button>
                                
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>
