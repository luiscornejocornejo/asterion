@include('facu.header')

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
        <div class="container-fluid pt-2">
            <form method="post" action="/getdatawispro">
                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <label for="typeSearch" class="form-label">Tipo de busqueda</label>
                        <select name="typeSearch" id="typeSearch" class="form-select">
                            <option value="0">DNI | Cédula</option>
                            <option value="1">Número de cliente</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label for="userNumber" class="form-label">Numero</label>
                        <input type="text" name="userNumber" class="form-control" id="userNumber" aria-describedby="emailHelp" placeholder="005215" required>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="mb-2 position-relative">
                            <label class="form-label">&nbsp;</label>
                            <input type="submit" type="button" class="form-control w-25 bg-success text-light" value="Buscar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('facu.footer')