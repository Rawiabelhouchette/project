<form method="GET" action="{{ route('rechercheAnnonce') }}" class="form-verticle">
    <div class="col-md-5 col-sm-5 no-padd" style="padding-left: 0px; padding-right: 0px;">
        <div class="form-box">
            {{-- <i class="banner-icon icon-layers"></i> &nbsp;&nbsp; --}}
            <select class="selectpicker form-control" id="type_document" name="type_document" data-live-search="true" tabindex="-98">
                <option value="all" {{ $type == 'all' ? 'selected' : '' }} class="chosen-select">Tous les Documents</option>
                <option value="Memoire" {{ $type == 'Memoire' ? 'selected' : '' }}>Mémoire</option>
            </select>

        </div>
    </div>
    
    <div class="col-md-6 col-sm-6 no-padd" style="padding-left: 0px; padding-right: 0px;">
        <div class="form-box">
            <i class="banner-icon icon-pencil"></i>
            <input type="text" value="{{ $cle }}" class="form-control right-br" id="mot_cle" name="mot_cle" placeholder="Mot clé ...">
        </div>
    </div>

    <div class="col-md-1 col-sm-1 no-padd text-center" style="padding-left: 0px; padding-right: 0px;">
        <div class="form-box">
            <button type="submit" id="btn-search-submit" class="btn form-control " style="background-color: #EA4F0C; border-color: white; padding-left: 15px; border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
                <i class="fa fa-fw fa-search" style="color: white; font-size: 25px;"></i>
            </button>
        </div>
    </div>

</form>
