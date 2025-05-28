<!-- create a form for new Ad -->
@extends(env('LAYOUT').'.base')

@if (isset($ad))
    @section('title', 'Hirdetés módosítása')
@else
    @section('title', 'Hirdetés feladása')
@endif

@section('main')
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- h2 with section title -->
            <h2 class="py-3 text-center">
                @if (isset($ad))
                    @php
                        $formURL = '/hirdetes/edit/' . $ad['id'];
                    @endphp
                    Hirdetés módosítása
                @else
                    @php
                        $formURL = '/hirdetes/feladas';
                    @endphp
                    Hirdetés feladása
                @endif
            </h2>
        </div>
        <div class="col-12">
            <div class="row text-center" id="media-container">
                @if (isset($ad))
                    <h6>A képek sorrendje drag-and-drop módon módosítható.</h6>
                    @foreach ($ad->getMedia($ad['id']) as $media)
                        <div class="col draggable-media" data-media-id="{{ $media->id }}">
                            <img src="{{ $media->getUrl() }}" class="d-block w-100" alt="banner1">
                            <br>
                            <a class="text-decoration-none text-black" href="/hirdetes/{{ $ad['id'] }}/media/{{ $ad['user_id'] }}/delete/{{ $media->id }}">
                                <small>kép eltávolítása</small>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ $formURL }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="reference_number">Referenciaszám:</label>
                    <input type="text" class="form-control" id="reference_number" name="reference_number" required placeholder="például: 1.2.3.4" value="@isset($ad){{$ad['reference_number']}}@endisset">
                </div>
                <div class="form-group mb-3">
                    <label for="subject">Hirdetés címe:</label>
                    <input type="text" class="form-control" id="subject" name="subject" required placeholder="például: Eladó iPhone 16 PRO max kifogástalan állapotban" value="@isset($ad){{$ad['title']}}@endisset">
                </div>
                <div class="form-group mb-3">
                    <label for="description">Leírás:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required placeholder="például: 2 éve vásároltam, tökéletes állapotban van, jó akkumulátorral, stb.">@isset($ad){{$ad['description']}}@endisset</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="price">Ár:</label>
                    <input type="number" class="form-control" id="price" name="price" required value="@isset($ad){{$ad['price']}}@endisset">
                </div>
                <div class="form-group mb-3">
                    <label for="images">Képek:</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple @if(!isset($ad)) required @endif>
                </div>
                <!-- loop throe $categoryType1 as select options -->
                <div class="form-group mb-3">
                    <label for="category_id">Kategória:</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="">- válassz kategóriát -</option>
                        @foreach ($categories as $categoryID => $category)
                            <option value="{{ $categoryID }}" @isset($ad) @if($ad['category_id']==$categoryID) selected @endif @endisset  >
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <hr>
                <h5>Attribútumok</h5>
                @foreach(\App\Models\Attribute::all() as $attribute)
                    <div class="form-group mb-3">
                        <label for="attribute_{{ $attribute->slug }}">{{ $attribute->title }}</label>
                        <input type="text" class="form-control" id="attribute_{{ $attribute->slug }}" name="attributes[{{ $attribute->slug }}]" value="@isset($ad){{$ad->getAdAttributeValueByAttributeSlug($attribute->slug)}}@endisset">
                    </div>
                @endforeach
                <div class="d-grid gap mb-3">
                    <button type="submit" class="btn btn-primary">Hirdetés feladása</button>
                    <a href="/profil" class="mt-5 btn btn-fluid btn-secondary">Vissza a profilomra</a>
                </div>
            </form>
        </div>
    </div>
    @if (isset($ad))
        <script>
            window.onload = function() {
                jQuery(document).ready(function() {
                    jQuery("#media-container").sortable({
                        items: ".draggable-media",
                        cursor: "move",
                        handle: "img",
                        update: function(event, ui) {
                            let mediaOrder = [];
                            jQuery(".draggable-media").each(function() {
                                mediaOrder.push($(this).data("media-id"));
                            });
                            console.log(mediaOrder);

                            // AJAX hívás a sorrend mentéséhez
                            jQuery.ajax({
                                url: "/ad/image/reorder",
                                method: "POST",
                                data: {
                                    _token: jQuery('meta[name="csrf-token"]').attr('content'),
                                    media_order: mediaOrder,
                                    adID: {{ $ad['id'] }}
                                },
                                success: function(response) {
                                    console.log("Sorrend sikeresen mentve");
                                },
                                error: function(xhr, status, error) {
                                    console.error("Hiba történt a mentés során:", error);
                                }
                            });
                        }
                    }).disableSelection();
                });
            }
        </script>
    @endif
@endsection
