<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.svg') }}" alt="" height="30">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
@php 
$pageName = \Request::route()->getName();
$aria_expansion = "false";
if($pageName == "view.history"){
    $aria_expansion = "true";
}
@endphp
    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('home')}}">
                        <i class="las la-tachometer-alt"></i> <span>Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('fetch-services')}}">
                        <i class="las la-cog"></i> <span>Services
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" data-bs-toggle="collapse" data-bs-target="#customization" aria-expanded="{{$aria_expansion}}" aria-controls="customization">
                    <i class="las la-file-alt"></i> <span>Quebec Informations
                        </span>
                    </a>
                    <div class="menu-dropdown collapse @if($pageName == "view.history") show @endif" id="customization" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('quebec.history.index')}}" class="nav-link @if($pageName == "view.history") active @endif">History of Quebec</a>
                            </li>
                            <li class="nav-item">
                            <a href="{{route('quebec.historical.event.index')}}" class="nav-link @if($pageName == "view.history") active @endif">Historical Events of Quebec</a>

                                <!-- <a href="#" class="nav-link">Quebec culture</a> -->
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Quebec climate</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Important Legal Aspects</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link collapse" href="#" data-bs-toggle="collapse" data-bs-target="#city_guide" aria-expanded="false" aria-controls="customization">
                    <i class="las la-map-marked"></i> <span>City Guide
                        </span>
                    </a>
                    <div class="menu-dropdown collapse" id="city_guide" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Carte interactive</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Local Services</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Points of Interest:</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Transportation options:</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                    <i class="las la-chalkboard"></i> <span>Learning French & Language Test
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link collapse" href="#" data-bs-toggle="collapse" data-bs-target="#employment_education" aria-expanded="false" aria-controls="customization">
                    <i class="las la-book-reader"></i> <span>Employment and Diploma Recognition
                        </span>
                    </a>
                    <div class="menu-dropdown collapse" id="employment_education" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('quebec.current.trend.index')}}" class="nav-link">Current Trends</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('quebec.employee.statistics.index')}}" class="nav-link">Employee Statistics</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('job.search.advice.index')}}" class="nav-link">Job Search Advice</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('foreign.diploma.fields.index')}}" class="nav-link">Validation of Foreign Diploma</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('diploma.validation.index')}}" class="nav-link">Validation Guide</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('diploma.resource.index')}}" class="nav-link">Useful Resource</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Local Services</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Points of Interest:</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Transportation options:</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link collapse" href="#" data-bs-toggle="collapse" data-bs-target="#eductional_institutes" aria-expanded="false" aria-controls="customization">
                    <i class="las la-book-reader"></i> <span>Eductional Institutions
                        </span>
                    </a>
                    <div class="menu-dropdown collapse" id="eductional_institutes" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('eductional.programs.index')}}" class="nav-link">University</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('eductional.programs.details.index')}}" class="nav-link">University Details</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('quebec.employee.statistics.index')}}" class="nav-link">Employee Statistics</a>
                            </li>
                            
                          
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link collapse" href="#" data-bs-toggle="collapse" data-bs-target="#health_insurance" aria-expanded="false" aria-controls="customization">
                    <i class="las la-users"></i> <span>Health and Social Services
                        </span>
                    </a>
                    <div class="menu-dropdown collapse" id="health_insurance" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Quebec Health System</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Health Resources</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">First Aid</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Social Services</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapse" href="#" data-bs-toggle="collapse" data-bs-target="#activities" aria-expanded="false" aria-controls="customization">
                    <i class="las la-users"></i> <span>Activities
                        </span>
                    </a>
                    <div class="menu-dropdown collapse" id="activities" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Events</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Tickets</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapse" href="#">
                    <i class="las la-envelope-open-text"></i></i> <span>Support and Advice
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                    <i class="las la-user"></i> <span>Admin Profile
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
