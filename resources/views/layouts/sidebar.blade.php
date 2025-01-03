<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Light Logo-->
        <a href="{{ route('home') }}" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ asset('logo/logo.png') }}" alt="logo" height="30" />
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
                    <a class="nav-link menu-link {{ request()->is('fetch-services') || request()->is('fetch-services/*') || request()->is('edit-service/*') ? 'active' : '' }}" href="{{route('fetch-services')}}">
                        <i class="las la-cog"></i> <span>Services
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('quebec/history/*') || request()->is('quebec/historical/events/*') || request()->is('quebec/foods') || request()->is('quebec/foods/*') || request()->is('quebec/climates') || request()->is('quebec/climates/*') || request()->is('quebec/legal-aspects') || request()->is('quebec/legal-aspects/*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#customization" aria-expanded="{{$aria_expansion}}" aria-controls="customization">
                    <i class="las la-file-alt"></i> <span>Quebec Informations
                        </span>
                    </a>
                    <div class="menu-dropdown collapse {{ request()->is('quebec/history/*') || request()->is('quebec/historical/events/*') || request()->is('quebec/foods') || request()->is('quebec/foods/*') || request()->is('quebec/climates') || request()->is('quebec/climates/*') || request()->is('quebec/legal-aspects') || request()->is('quebec/legal-aspects/*') ? 'show' : '' }}" id="customization" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('quebec.history.index')}}" class="nav-link {{ request()->is('quebec/history/*') ? 'active' : '' }}">History of Quebec</a>
                            </li>
                            <li class="nav-item">
                            <a href="{{route('quebec.historical.event.index')}}" class="nav-link {{ request()->is('quebec/historical/events/*') ? 'active' : '' }}">Historical Events of Quebec</a>

                                <!-- <a href="#" class="nav-link">Quebec culture</a> -->
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('quebec.foods.index') }}" class="nav-link {{ request()->is('quebec/foods') || request()->is('quebec/foods/*') ? 'active' : '' }}">Quebec Food</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('quebec.climates.index') }}" class="nav-link {{ request()->is('quebec/climates') || request()->is('quebec/climates/*') ? 'active' : '' }}">Quebec Climate</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('quebec.legal-aspects.index') }}" class="nav-link {{ request()->is('quebec/legal-aspects') || request()->is('quebec/legal-aspects/*') ? 'active' : '' }}">Important Legal Aspects</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link collapse {{ request()->is('city-guide/transportations') || request()->is('city-guide/transportations/*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#city_guide" aria-expanded="false" aria-controls="customization">
                    <i class="las la-map-marked"></i> <span>City Guide
                        </span>
                    </a>
                    <div class="menu-dropdown collapse {{ request()->is('city-guide/transportations') || request()->is('city-guide/transportations/*') ? 'show' : '' }}" id="city_guide" style="">
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
                                <a href="#" class="nav-link">Points of Interest:</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('city-guide.transportations.index') }}" class="nav-link {{ request()->is('city-guide/transportations') || request()->is('city-guide/transportations/*') ? 'active' : '' }}">Transportation options</a>
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
                    <a class="nav-link menu-link collapse {{ request()->is('quebec/current/trend/*') || request()->is('quebec/employee/statistics/*') || request()->is('job/search/advice/*') || request()->is('foreign/diploma/fields/*') || request()->is('diploma/validation/*') || request()->is('diploma/resource/*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#employment_education" aria-expanded="false" aria-controls="customization">
                    <i class="las la-book-reader"></i> <span>Employment and Diploma Recognition
                        </span>
                    </a>
                    <div class="menu-dropdown collapse {{ request()->is('quebec/current/trend/*') || request()->is('quebec/employee/statistics/*') || request()->is('job/search/advice/*') || request()->is('foreign/diploma/fields/*') || request()->is('diploma/validation/*') || request()->is('diploma/resource/*') ? 'show' : '' }}" id="employment_education" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('quebec.current.trend.index')}}" class="nav-link {{ request()->is('quebec/current/trend/*') ? 'active' : '' }}">Current Trends</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('quebec.employee.statistics.index')}}" class="nav-link  {{ request()->is('quebec/employee/statistics/*') ? 'active' : '' }}">Employee Statistics</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('job.search.advice.index')}}" class="nav-link {{ request()->is('job/search/advice/*') ? 'active' : '' }}">Job Search Advice</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('foreign.diploma.fields.index')}}" class="nav-link {{ request()->is('foreign/diploma/fields/*') ? 'active' : '' }}">Validation of Foreign Diploma</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('diploma.validation.index')}}" class="nav-link {{ request()->is('diploma/validation/*') ? 'active' : '' }}">Validation Guide</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('diploma.resource.index')}}" class="nav-link {{ request()->is('diploma/resource/*') ? 'active' : '' }}">Useful Resource</a>
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
                    <a class="nav-link menu-link collapse {{ request()->is('eductional/programs/*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#eductional_institutes" aria-expanded="false" aria-controls="customization">
                    <i class="las la-book-reader"></i> <span>Eductional Institutions
                        </span>
                    </a>
                    <div class="menu-dropdown collapse {{ request()->is('eductional/programs/*') ? 'show' : '' }}" id="eductional_institutes" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('eductional.programs.index')}}" class="nav-link {{ request()->is('eductional/programs/*') ? 'active' : '' }}">University</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('eductional.programs.details.index')}}" class="nav-link">University Details</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('programs.index')}}" class="nav-link">Programs</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('financial.aid.programs.index')}}" class="nav-link">Financial Aid</a>
                            </li>


                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link collapse {{ request()->is('social-services') || request()->is('social-services/*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#health_insurance" aria-expanded="false" aria-controls="customization">
                    <i class="las la-users"></i> <span>Health and Social Services
                        </span>
                    </a>
                    <div class="menu-dropdown collapse {{ request()->is('social-services') || request()->is('social-services/*') ? 'show' : '' }}" id="health_insurance" style="">
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
                                <a href="{{ route('social-services.index') }}" class="nav-link {{ request()->is('social-services') || request()->is('social-services/*') ? 'active' : '' }}">Social Services</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapse {{ request()->is('activities/agora-events') || request()->is('activities/agora-events/*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#activities" aria-expanded="false" aria-controls="customization">
                    <i class="las la-users"></i> <span>Activities
                        </span>
                    </a>
                    <div class="menu-dropdown collapse {{ request()->is('activities/agora-events') || request()->is('activities/agora-events/*') ? 'show' : '' }}" id="activities" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('activities.agora-events.index') }}" class="nav-link {{ request()->is('activities/agora-events') || request()->is('activities/agora-events/*') ? 'active' : '' }}">Agora Events</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Tickets</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapse {{ request()->is('support-and-advice/stay-anonymous') || request()->is('support-and-advice/stay-anonymous/*') || request()->is('support-and-advice/with-my-name') || request()->is('support-and-advice/with-my-name/*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#supportAndAdvice" aria-expanded="false" aria-controls="customization">
                    <i class="las la-envelope-open-text"></i>
                        <span>
                            Support and Advice
                        </span>
                    </a>
                    <div class="menu-dropdown collapse {{ request()->is('support-and-advice/stay-anonymous') || request()->is('support-and-advice/stay-anonymous/*') || request()->is('support-and-advice/with-my-name') || request()->is('support-and-advice/with-my-name/*') ? 'show' : '' }}" id="supportAndAdvice" style="">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('support-and-advice.stay-anonymous.index') }}" class="nav-link {{ request()->is('support-and-advice/stay-anonymous') || request()->is('support-and-advice/stay-anonymous/*') ? 'active' : '' }}">Stay Anonymous</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('support-and-advice.with-my-name.index') }}" class="nav-link {{ request()->is('support-and-advice/with-my-name') || request()->is('support-and-advice/with-my-name/*') ? 'active' : '' }}">With My Name</a>
                            </li>
                        </ul>
                    </div>
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
