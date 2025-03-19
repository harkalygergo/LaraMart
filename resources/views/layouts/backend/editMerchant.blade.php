@extends('layouts.backend.base')

@section('main')
    <div class="container">
        <h1>Üzlet szerkesztése</h1>
        <form action="{{ route('editMerchant', $merchant->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Név</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $merchant->name }}" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ $merchant->slug }}" required>
            </div>
            <div class="form-group">
                <label for="description">Leírás</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $merchant->description }}">
            </div>
            <div class="form-group">
                <label for="image">Logó</label>
                <input type="text" class="form-control" id="image" name="image" value="{{ $merchant->image }}">
            </div>
            <div class="form-group">
                <label for="phone">Telefonszám</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $merchant->phone }}">
            </div>
            <div class="form-group">
                <label for="email">E-mail cím</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $merchant->email }}">
            </div>
            <div class="form-group">
                <label for="website">Honlap</label>
                <input type="text" class="form-control" id="website" name="website" value="{{ $merchant->website }}">
            </div>
            <div class="form-group">
                <label for="zip">Irányítószám</label>
                <input type="text" class="form-control" id="zip" name="zip" value="{{ $merchant->zip }}" required>
            </div>
            <div class="form-group">
                <label for="city">Település</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ $merchant->city }}">
            </div>
            <div class="form-group">
                <label for="address">Cím</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $merchant->address }}">
            </div>
            <div class="form-group">
                <label for="vat">Adószám</label>
                <input type="text" class="form-control" id="vat" name="vat" value="{{ $merchant->vat }}">
            </div>
            <div class="form-group">
                <label for="product_feed_url">Termék importfájl URL</label>
                <input type="text" class="form-control" id="product_feed_url" name="product_feed_url" value="{{ $merchant->product_feed_url }}">
            </div>

            <div class="form-group">
                <label for="status">Státusz</label>
                <select class="form-control" id="status" name="status">
                    <option value="1" @if ($merchant->status == 1) selected @endif>Aktív</option>
                    <option value="0" @if ($merchant->status == 0) selected @endif>Inaktív</option>
                </select>
            </div>

            <button type="submit" class="btn btn-lg btn-primary my-3 btn-fluid">Mentés</button>
        </form>

        <hr>

        <form class="py-5" action="{{ route('editMerchant', $merchant->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Kereskedő és hirdetéseinek végleges törlése</button>
        </form>
    </div>
@endsection

