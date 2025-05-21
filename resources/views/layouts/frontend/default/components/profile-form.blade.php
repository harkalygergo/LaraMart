<form action="/profil" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col">
            <h4 class="pt-3 text-center">Alapadatok</h4>
            <div class="form-group mb-3">
                <label for="name">Név:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="phone">Telefonszám:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user['phone'] }}" placeholder="+36..." required>
            </div>
            <div class="form-group mb-3">
                <label for="email">E-mail cím:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user['email'] }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Jelszó:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
        </div>
        <div class="col">
            <h4 class="pt-3 text-center">Készülékek átvételi helye</h4>
            <div class="form-group mb-3">
                <label for="zip">Irányítószám:</label>
                <input type="number" class="form-control" id="zip" name="zip" value="{{ $user['zip'] }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="city">Település:</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ $user['city'] }}">
            </div>
            <div class="form-group mb-3">
                <label for="address">Utca, házszám:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $user['address'] }}">
            </div>
            <div class="form-group mb-3">
                <label for="home_delivery">Házhoz szállítást:</label>
                <!-- add home_delivery as select-option -->
                <select class="form-select" name="home_delivery">
                    <option value="1" {{ $user['home_delivery'] == 1 ? 'selected' : '' }}>vállalok</option>
                    <option value="0" {{ $user['home_delivery'] == 0 ? 'selected' : '' }}>nem vállalok</option>
                </select>
            </div>
        </div>
        <div class="col">
            <h4 class="pt-3 text-center">Számlázási adatok</h4>
            <div class="form-group mb-3">
                <label for="billingName">Név:</label>
                <input type="text" class="form-control" id="billingName" name="billingName" value="{{ $user['billing_name'] }}">
            </div>
            <div class="form-group mb-3">
                <label for="billingZip">Irányítószám:</label>
                <input type="number" class="form-control" id="billingZip" name="billingZip" value="{{ $user['billing_zip'] }}">
            </div>
            <div class="form-group mb-3">
                <label for="billingCity">Település:</label>
                <input type="text" class="form-control" id="billingCity" name="billingCity" value="{{ $user['billing_city'] }}">
            </div>
            <div class="form-group mb-3">
                <label for="billingAddress">Utca, házszám:</label>
                <input type="text" class="form-control" id="billingAddress" name="billingAddress" value="{{ $user['billing_address'] }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary text-end btn-lg">Profil frissítése</button>
        </div>
    </div>
</form>
