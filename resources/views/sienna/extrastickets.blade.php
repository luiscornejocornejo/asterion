@include('facu.header')

<div class="wrapper menuitem-active">
    @include('facu.menu')
    <div class="content-page" style="padding: 0!important;">
        <div class="container-fluid pt-2">
            <h2>extrastickets</h2>
           
                    <?php
                   // foreach ($tsoporte as $val3) {

                    ?>
                       
                       <p>{{$tsoporte[0]->nombre}}: <input type="text" name="extra1" value="{{$tsoporte[0]->pseudo}}"> <select name="view"><option value="1">si</option><option value="0">no</option></select></p>
                       <p>{{$tsoporte[1]->nombre}}: <input type="text" name="extra2" value="{{$tsoporte[1]->pseudo}}"> <select name="view"><option value="1">si</option><option value="0">no</option></select></p>
                       <p>{{$tsoporte[2]->nombre}}: <input type="text" name="extra3" value="{{$tsoporte[2]->pseudo}}"> <select name="view"><option value="1">si</option><option value="0">no</option></select></p>
                        
                    <?php //} ?>
              
        </div>
    </div>
</div>

@include('facu.footer')