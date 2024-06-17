<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <h3>{{ __('sidebar.c-school_version') }}</h3>
    </div>
    <ul class="c-sidebar-nav">
        @php $locale = App::currentLocale(); @endphp
        @if (Auth::user()->role == 1)
        {{-- Admin Side Bar --}}
        <li class="c-sidebar-nav-item ">
            <a class="c-sidebar-nav-link" href="{{url('home')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                </svg> {{ __('sidebar.dashboard') }}</a>
        </li>
        <li class="c-sidebar-nav-item ">
            <a class="c-sidebar-nav-link" href="{{ route('students.list')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-people') }}"></use>
                </svg> {{ __('sidebar.student_list') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item ">
            <a class="c-sidebar-nav-link" href="{{route('teachers.list')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-people') }}"></use>
                </svg> {{ __('sidebar.teacher_list') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('subjects.list') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-layers') }}"></use>
                </svg> {{ __('sidebar.subject') }}</a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('levels.list') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-layers') }}"></use>
                </svg> {{ __('sidebar.level') }}</a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ url('terms-and-conditions') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-text') }}"></use>
                </svg>{{ __('sidebar.create_t&c') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('chats') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-chat-bubble') }}"></use>
                </svg> {{ __('sidebar.chat') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('packages.list') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-badge') }}"></use>
                </svg> {{ __('sidebar.package') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('payments.list') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-money') }}"></use>
                </svg> {{ __('sidebar.payment') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('files.list')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-file') }}"></use>
                </svg> {{ __('sidebar.file') }}</a>
        </li>
        @elseif (Auth::user()->role == 2)
        {{-- Teacher Side Bar --}}
        <li class="c-sidebar-nav-item ">
            <a class="c-sidebar-nav-link" href="{{url('home')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                </svg> {{ __('sidebar.dashboard1') }}</a>
        </li>
        <li class="c-sidebar-nav-item ">
            <a class="c-sidebar-nav-link" href="{{ route('teachers.show', Auth::user()->teacher->id)}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-alarm') }}"></use>
                </svg> {{ __('teacher_detail.availabe_date_time') }}</a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('assignments.list') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-list-rich') }}"></use>
                </svg> {{ __('sidebar.assignment') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('chats') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-chat-bubble') }}"></use>
                </svg> {{ __('sidebar.chat') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('payments.list') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-money') }}"></use>
                </svg> {{ __('sidebar.payment') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('files.list')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-file') }}"></use>
                </svg> {{ __('sidebar.file') }}</a>
        </li>
        @else
        {{-- Student Side Bar --}}
        <li class="c-sidebar-nav-item ">
            <a class="c-sidebar-nav-link" href="{{ route('student.dashboard')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                </svg> {{ __('sidebar.my_page') }}</a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('home')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-file') }}"></use>
                </svg>{{ __('sidebar.reserved_lesson') }}</a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('student.course.list') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-layers') }}"></use>
                </svg> {{ __('sidebar.subject') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('student.teachers.list') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-people') }}"></use>
                </svg> {{ __('sidebar.lecturers') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('student.packages.list') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-badge') }}"></use>
                </svg> {{ __('sidebar.package') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('studnet.package.history')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-badge') }}"></use>
                </svg> {{ __('sidebar.package_history') }}</a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('student.assignments.list') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-list-rich') }}"></use>
                </svg> {{ __('sidebar.assignment') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('student.reports') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-list-rich') }}"></use>
                </svg> {{ __('sidebar.lesson_progress') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('files.list')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-file') }}"></use>
                </svg> {{ __('sidebar.file') }}</a>
        </li>
        @endif
        <li class="c-sidebar-nav-title">{{ __('sidebar.setting') }}</li>
        <li class="c-sidebar-nav-item">
            <a id="navbarDropdown" class="c-sidebar-nav-link dropdown-toggle" href="#" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-language') }}"></use>
                </svg>
                @switch($locale)
                @case('en')
                <label> English</label>
                @break
                @case('jp')
                <label> Japan</label>
                @break
                @default
                <label> Japan</label>
                @endswitch
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('lang','jp')}}"><label>
                        <svg class="c-icon">
                            <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/flag.svg#cif-jp') }}">
                            </use>
                        </svg>
                        Japan</label>
                </a>
                <a class="dropdown-item" href="{{ route('lang', 'en') }}"><label>
                        <svg class="c-icon">
                            <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/flag.svg#cif-gb') }}">
                            </use>
                        </svg>
                        English</label>
                </a>
            </div>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{url('profile')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                </svg> {{ __('sidebar.profile') }}</a>
        </li>
        @if (Auth::user()->role == 1)
        {{-- <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
                </svg>{{ __('sidebar.edit_site_content') }}</a>
        </li> --}}
        @if(! Config::get('myapp.onetime_setup'))
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('settings') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
                </svg>{{ __('sidebar.one_time') }}</a>
        </li>
        @endif
        @endif
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ url('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}">
                    </use>
                </svg> {{ __('sidebar.log_out') }}</a>
            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>
