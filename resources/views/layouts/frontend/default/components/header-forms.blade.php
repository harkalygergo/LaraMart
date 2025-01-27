<div class="row">
    <div class="col-md-12 py-2">
        <form method="get" action="/kereses">
            <div class="input-group">
                <input type="text" name="s" class="form-control" placeholder="Keresés a termékek között" aria-label="Keresés a termékek között" aria-describedby="button-search" value="@isset($searchQuery){{ $searchQuery }}@endisset">
                <button class="btn btn-primary" type="submit" id="button-search">
                    Keresés
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>
