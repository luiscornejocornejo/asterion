@include('facu.header')

<div class="wrapper menuitem-active">
    @include('facu.menu')
    <div class="content-page" style="padding: 0!important;">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade
                            show"
                role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <style>
            .hoverDataTicket:hover {
                color: #509EE3 !important;
            }
        </style>

        <div class="content">
            <div class="container py-4">

                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3 container">
                    <li class="nav-item">
                        <a href="#home1" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            <i class="mdi mdi-home-variant d-md-none d-block"></i>
                            <span class="d-none d-md-block">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile1" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                            <span class="d-none d-md-block">CSAT</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#settings1" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                            <span class="d-none d-md-block">Agentes en línea</span>
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane" id="home1">
                        @include('sienna.dash')
                    </div>
                    <div class="tab-pane show active" id="profile1">
                        @include('sienna.dashboard.csat')
                    </div>
                    <div class="tab-pane" id="settings1">
                        @include('sienna.logeado')
                    </div>
                </div>
                
                           
            </div>
        </div>
    </div>
</div>


@include('facu.footer')