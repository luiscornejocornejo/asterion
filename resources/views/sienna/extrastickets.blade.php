@include('facu.header')

<div class="wrapper menuitem-active">
    @include('facu.menu')
    <div class="content-page" style="padding: 0!important;">
        <div class="container-fluid pt-2">
            <h2>extrastickets</h2>
           
                    <?php
                    foreach ($tsoporte as $val3) {

                    ?>
                       
                       <p>extra1: <input type="text" name="extra1" value="{{$val3->extra1}}"></p>
                       <p>extra2: <input type="text" name="extra2" value="{{$val3->extra2}}"></p>
                       <p>extra3: <input type="text" name="extra3" value="{{$val3->extra3}}"></p>
                        
                    <?php } ?>
              
        </div>
    </div>
</div>

@include('facu.footer')