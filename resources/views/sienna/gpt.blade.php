@include('facu.header')


<style>

@media (min-width: 1200px) { /* Para tamaños xxl en Bootstrap */
  .xxl-w-50 {
    width: 100% !important;
  }
}

@media (min-width: 992px) { /* Para tamaños lg en Bootstrap */
  .lg-w-100 {
    width: 50% !important;
  }
}

</style>
<div class="wrapper menuitem-active">
@include('facu.menu')
<div class="content-page" style="padding: 0!important;">

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

                <div class="card card-body position-absolute top-50 start-50 translate-middle shadow-lg xxl-w-50 lg-w-100">
                    <h3 class="card-title text-center">Suri AI 🤖</h3>
                    <div id="xenioowebchat" class="border" style="width: 100%; height: 300px"></div>
                        <script data-id='xenioo' data-node='cm91dGluZy54ZW5pb28uY29t' src="https://res.xenioo.com/plugin/xenioo.js"></script>
                        <script>
                            xenioowebchat.EmbedChatLanding({
                                container: 'xenioowebchat',
                                landingUrl: 'https://res.xenioo.com/landing//display.html?route=cm91dGluZy54ZW5pb28uY29t&bot_key=sUccEJjrHUiJMpy6NEe4RFfhS7goUj2pSB50K0wCngMJ5eVgTTwbTBAdou96cuNX'
                        });
                        </script>
                        <span class="text-center mt-2">Powered By OpenAI</span>                 
                    </div>
                </div>
    </div>
</div>
<br><br><br>
    @include('facu.footer')