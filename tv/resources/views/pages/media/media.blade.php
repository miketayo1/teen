<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Media"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Images</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                                <!-- //images -->
                                                <div class="col-12 mt-4">
                                                    
                                                    <div class="row">
                                                    @foreach ($images as $slider)    
                                                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                                            <div class="card card-blog card-plain">
                                                                <div class="card-header p-0 mt-n4 mx-3">
                                                                    <a class="d-block shadow-xl border-radius-xl">
                                                                        <img style="background:#f11b27; padding:5px;border:1px solid #999;" 
                                                                                src="{{ URL::to('/events')}}/{{$slider->path}}"
                                                                            alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                                                    </a><br>
                                                                </div><br>
                                                                
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    </div>
                                                
                                                </div>
                                                <!-- END -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <x-footers.auth></x-footers.auth>
            </div>
        </main>
        <x-plugins></x-plugins>

</x-layout>
