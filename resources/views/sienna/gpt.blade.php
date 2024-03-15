@include('facu.header')

<div id="principal">
    <div class="mx-auto" style="width: 1000px;margin-top: 70px;">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
               

                <div id="xenioowebchat" class="d-none" style="width: 100%; height: 600px;margin-left: 0.585rem!important;"></div>
  <script data-id='xenioo' data-node='cm91dGluZy54ZW5pb28uY29t' src="https://res.xenioo.com/plugin/xenioo.js"></script>
<script>
    xenioowebchat.EmbedChatLanding({
        container: 'xenioowebchat',
        landingUrl: 'https://res.xenioo.com/landing//display.html?route=cm91dGluZy54ZW5pb28uY29t&bot_key=sUccEJjrHUiJMpy6NEe4RFfhS7goUj2pSB50K0wCngMJ5eVgTTwbTBAdou96cuNX'
});
</script>


            </div>
        </div>
    </div>
</div>
<br><br><br>
    @include('facu.footer')