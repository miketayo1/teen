<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Trash"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Trash</h6>
                                </div>
                            </div>
                            <div class="card card-body mx-3 mx-md-4 ">
                                    
                                <div class="row gx-4 mb-2">
                                    
                                    <div class="col-auto my-auto">
                                        <div class="h-100">
                                            <h6 class="mb-1">
                                                <a href="{{ route('get-event') }}">All ({{$revent}}) </a> |<a href=""> Trash ({{$trashs}}) </a> 
                                            </h6>
                                            
                                        </div>
                                    </div>
                                      
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
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
                                <div class="table-responsive p-0">
                                    
                                    <table class="table align-items-center mb-0">
                                        
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Posted by</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Name</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Date</th>
                                                <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Options</th>
                                                
                                            </tr>
                                        </thead>
                                        @foreach($events as $event)
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{$user->name}} </h6>
                                                            <p class="text-xs text-secondary mb-0">{{$user->email}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">{{$event->name}}</p>
                                                    
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-sm font-weight-bold mb-0">{{$event->updated_at}}</span>
                                                </td>
                                                
                                                <td class="align-middle">
                                                    <a href="{{ route('restore-event', ['id'=> $event->event_id])}} "
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Restore 
                                                    </a>
                                                    |
                                                    <a href="{{ route('dele-event', ['id'=> $event->event_id])}} "
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Delete
                                                    </a>
                                                   
                                                    
                                                </td>
                                                
                                            </tr>
                                           
                                           
                                        </tbody>
                                        @endforeach
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <x-footers.auth></x-footers.auth>
            </div>
        </main>
        <x-plugins></x-plugins>

</x-layout>
