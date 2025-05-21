@extends(env('LAYOUT').'.base')

@section('main')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Jelszó </h2>
        <form action="{{ route('passwordReset') }}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="email">E-mail cím:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="mt-3 btn btn-fluid btn-primary">Új jelszó beállítása</button>
            </div>
        </form>
    </div>
</div>
@endsection
