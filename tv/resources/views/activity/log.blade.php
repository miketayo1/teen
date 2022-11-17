<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="billing"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Activity Log"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                
               
            </div>
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">Amin Logs</h6>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <ul class="list-group">
                                <!-- logs -->
                                @foreach ($logs as $log)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        
                                        <span class="mb-2 text-xs">Name: <span
                                                class="text-dark font-weight-bold ms-sm-2">{{$log->user}}
                                                </span></span>
                                        <span class="mb-2 text-xs">Email: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{$log->email}} </span></span>
                                        <span class="text-xs">Log: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{$log->activity}} </span></span><br>
                                        <span class="text-xs">Time: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{$log->created_at}} </span></span>
                                    </div>
                                    @endforeach
                                </li>
                               <!-- ENd Logs -->
                            </ul>
                        </div>
                        <div class="row d-flex justify-content-center">
                                    <!--Grid column-->
                                    <div class="col-md-6">
                                        {{$logs->links()}}
                                    </div>
                                    <!--Grid column-->
                         </div> 
                    </div>
                </div>
                 
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
