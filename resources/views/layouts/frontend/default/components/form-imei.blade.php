<form method="get" action="/telefon-adat-lekerdezes" onsubmit="return validateIMEI()">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Lekérdezés IMEI kód alapján (14-16 karakter)" aria-label="Lekérdezés IMEI kód alapján (14-16 karakter)" aria-describedby="button-imei" name="imei" id="imei-input" pattern="\d{14,16}" value="@isset($imei){{ $imei }}@endisset" required>
        <button class="btn btn-primary" type="submit" id="button-imei">
            Lekérdezés
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>

<script>
    function validateIMEI() {
        const imeiInput = document.getElementById('imei-input');
        const imeiValue = imeiInput.value;
        const imeiPattern = /^\d{14,16}$/;

        if (!imeiPattern.test(imeiValue)) {
            alert('Az IMEI 14-16 karakter hosszú.');
            return false;
        }
        return true;
    }
</script>
