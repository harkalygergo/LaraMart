@extends(env('LAYOUT').'.base')

@section('main')
    @include(env('LAYOUT').'.components.header-forms')

    <div class="row py-4">
        <div class="col">
            <h1 class="px-4 py-2">
                {{ $page['title'] }}
            </h1>
        </div>
    </div>
    <div class="bg-white p-5 rounded-5">

        <div class="row">
            {!! $page['content'] !!}
        </div>

        <div class="row">
            <div class="col-12 border-top mt-5 pt-5">
                <h2>Kategória struktúra</h2>
                <p>Az alábbi táblázat JSON formátumban elérhető itt: <a class="text-dark" target="_blank" href="/api/categories.json">/api/categories.json</a></p>
                <div class="responsive-table">
                <table class="table table-hover table-responsive table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Főkategória</th>
                        <th scope="col">Alkategória</th>
                        <th scope="col">Al-alkategória</th>
                        <th scope="col">Al-al-alkategória</th>
                        <th scope="col">Kategória azonosító</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    <tr>
                        <td><strong>Apple</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><code>100000</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td><strong>iPhone</strong></td>
                        <td></td>
                        <td></td>
                        <td><code>110000</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone / iPhone 1 / iPhone 2G</strong></td>
                        <td></td>
                        <td><code>110100</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone 3G</strong></td>
                        <td></td>
                        <td><code>110200</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 3G</td>
                        <td><strong>iPhone 3G</strong></td>
                        <td><code>110201</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 3G</td>
                        <td><strong>iPhone 3GS</strong></td>
                        <td><code>110202</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone 4</strong></td>
                        <td></td>
                        <td><code>110300</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 4</td>
                        <td><strong>iPhone 4</strong></td>
                        <td><code>110301</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 4</td>
                        <td><strong>iPhone 4S</strong></td>
                        <td><code>110302</code></td>
                    </tr>

                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone 5</strong></td>
                        <td></td>
                        <td><code>110400</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 5</td>
                        <td><strong>iPhone 5</strong></td>
                        <td><code>110401</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 5</td>
                        <td><strong>iPhone 5C</strong></td>
                        <td><code>110402</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 5</td>
                        <td><strong>iPhone 5S</strong></td>
                        <td><code>110403</code></td>
                    </tr>


                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone 6</strong></td>
                        <td></td>
                        <td><code>110500</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 6</td>
                        <td><strong>iPhone 6</strong></td>
                        <td><code>110501</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 6</td>
                        <td><strong>iPhone 6 Plus</strong></td>
                        <td><code>110502</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 6</td>
                        <td><strong>iPhone 6S</strong></td>
                        <td><code>110503</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 6</td>
                        <td><strong>iPhone 6S Plus</strong></td>
                        <td><code>110504</code></td>
                    </tr>

                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone SE</strong></td>
                        <td></td>
                        <td><code>110600</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone SE</td>
                        <td><strong>iPhone SE 2016 (I. generáció)</strong></td>
                        <td><code>110601</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone SE</td>
                        <td><strong>iPhone SE 2020 (II. generáció)</strong></td>
                        <td><code>110602</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone SE</td>
                        <td><strong>iPhone SE 2022 (III. generáció)</strong></td>
                        <td><code>110603</code></td>
                    </tr>

                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone 7</strong></td>
                        <td></td>
                        <td><code>110700</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 7</td>
                        <td><strong>iPhone 7</strong></td>
                        <td><code>110701</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 7</td>
                        <td><strong>iPhone 7 Plus</strong></td>
                        <td><code>110702</code></td>
                    </tr>

                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone 8</strong></td>
                        <td></td>
                        <td><code>110800</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 8</td>
                        <td><strong>iPhone 8</strong></td>
                        <td><code>110801</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 8</td>
                        <td><strong>iPhone 8 Plus</strong></td>
                        <td><code>110802</code></td>
                    </tr>

                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone X</strong></td>
                        <td></td>
                        <td><code>110900</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone X</td>
                        <td><strong>iPhone X</strong></td>
                        <td><code>110901</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone X</td>
                        <td><strong>iPhone XR</strong></td>
                        <td><code>110902</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone X</td>
                        <td><strong>iPhone XS</strong></td>
                        <td><code>110903</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone X</td>
                        <td><strong>iPhone XS Max</strong></td>
                        <td><code>110904</code></td>
                    </tr>

                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone 11</strong></td>
                        <td></td>
                        <td><code>111000</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 11</td>
                        <td><strong>iPhone 11</strong></td>
                        <td><code>111001</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 11</td>
                        <td><strong>iPhone 11 Pro</strong></td>
                        <td><code>111002</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 11</td>
                        <td><strong>iPhone 11 Pro Max</strong></td>
                        <td><code>111003</code></td>
                    </tr>

                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone 12</strong></td>
                        <td></td>
                        <td><code>111100</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 12</td>
                        <td><strong>iPhone 12</strong></td>
                        <td><code>111101</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 12</td>
                        <td><strong>iPhone 12 mini</strong></td>
                        <td><code>111102</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 12</td>
                        <td><strong>iPhone 12 Pro</strong></td>
                        <td><code>111103</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 12</td>
                        <td><strong>iPhone 12 Pro Max</strong></td>
                        <td><code>111104</code></td>
                    </tr>

                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone 13</strong></td>
                        <td></td>
                        <td><code>111200</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 13</td>
                        <td><strong>iPhone 13</strong></td>
                        <td><code>111201</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 13</td>
                        <td><strong>iPhone 13 mini</strong></td>
                        <td><code>111202</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 13</td>
                        <td><strong>iPhone 13 Pro</strong></td>
                        <td><code>111203</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 13</td>
                        <td><strong>iPhone 13 Pro Max</strong></td>
                        <td><code>111204</code></td>
                    </tr>

                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone 14</strong></td>
                        <td></td>
                        <td><code>111300</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 14</td>
                        <td><strong>iPhone 14</strong></td>
                        <td><code>111301</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 14</td>
                        <td><strong>iPhone 14 Plus</strong></td>
                        <td><code>111302</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 14</td>
                        <td><strong>iPhone 14 Pro</strong></td>
                        <td><code>111303</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 14</td>
                        <td><strong>iPhone 14 Pro Max</strong></td>
                        <td><code>111304</code></td>
                    </tr>

                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone 15</strong></td>
                        <td></td>
                        <td><code>111400</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 15</td>
                        <td><strong>iPhone 15</strong></td>
                        <td><code>111401</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 15</td>
                        <td><strong>iPhone 15 Plus</strong></td>
                        <td><code>111402</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 15</td>
                        <td><strong>iPhone 15 Pro</strong></td>
                        <td><code>111403</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 15</td>
                        <td><strong>iPhone 15 Pro Max</strong></td>
                        <td><code>111404</code></td>
                    </tr>

                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone 16</strong></td>
                        <td></td>
                        <td><code>111500</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 16</td>
                        <td><strong>iPhone 16</strong></td>
                        <td><code>111501</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 16</td>
                        <td><strong>iPhone 16 Plus</strong></td>
                        <td><code>111502</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 16</td>
                        <td><strong>iPhone 16 Pro</strong></td>
                        <td><code>111503</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 16</td>
                        <td><strong>iPhone 16 Pro Max</strong></td>
                        <td><code>111504</code></td>
                    </tr>

                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td><strong>iPhone 17</strong></td>
                        <td></td>
                        <td><code>111600</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPhone</td>
                        <td>iPhone 17</td>
                        <td><strong>iPhone 17</strong></td>
                        <td><code>111601</code></td>
                    </tr>

                    <!-- iPad -->
                    <tr>
                        <td>Apple</td>
                        <td><strong>iPad</strong></td>
                        <td></td>
                        <td></td>
                        <td><code>120000</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td><strong>iPad</strong></td>
                        <td></td>
                        <td><code>120100</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad</td>
                        <td><strong>iPad (1. generáció)</strong></td>
                        <td><code>120101</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad</td>
                        <td><strong>iPad 2</strong></td>
                        <td><code>120102</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad</td>
                        <td><strong>iPad 3</strong></td>
                        <td><code>120103</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad</td>
                        <td><strong>iPad 4</strong></td>
                        <td><code>120104</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad</td>
                        <td><strong>iPad 5</strong></td>
                        <td><code>120105</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad</td>
                        <td><strong>iPad 6</strong></td>
                        <td><code>120106</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad</td>
                        <td><strong>iPad 7</strong></td>
                        <td><code>120107</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad</td>
                        <td><strong>iPad 8</strong></td>
                        <td><code>120108</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad</td>
                        <td><strong>iPad 9</strong></td>
                        <td><code>120109</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad</td>
                        <td><strong>iPad 10</strong></td>
                        <td><code>120110</code></td>
                    </tr>

                    <!-- iPad mini -->
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td><strong>iPad mini</strong></td>
                        <td></td>
                        <td><code>120200</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad mini</td>
                        <td><strong>iPad mini (1. generáció)</strong></td>
                        <td><code>120201</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad mini</td>
                        <td><strong>iPad mini 2</strong></td>
                        <td><code>120202</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad mini</td>
                        <td><strong>iPad mini 3</strong></td>
                        <td><code>120203</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad mini</td>
                        <td><strong>iPad mini 4</strong></td>
                        <td><code>120204</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad mini</td>
                        <td><strong>iPad mini 5</strong></td>
                        <td><code>120205</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad mini</td>
                        <td><strong>iPad mini 6</strong></td>
                        <td><code>120206</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad mini</td>
                        <td><strong>iPad mini 7</strong></td>
                        <td><code>120207</code></td>
                    </tr>

                    <!-- iPad Air -->
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td><strong>iPad Air</strong></td>
                        <td></td>
                        <td><code>120300</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad Air</td>
                        <td><strong>iPad Air (1. generáció)</strong></td>
                        <td><code>120301</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad Air</td>
                        <td><strong>iPad Air 2</strong></td>
                        <td><code>120302</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad Air</td>
                        <td><strong>iPad Air 3</strong></td>
                        <td><code>120303</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad Air</td>
                        <td><strong>iPad Air 4</strong></td>
                        <td><code>120304</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad Air</td>
                        <td><strong>iPad Air 5</strong></td>
                        <td><code>120305</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad Air</td>
                        <td><strong>iPad Air 6</strong></td>
                        <td><code>120306</code></td>
                    </tr>

                    <!-- iPad Air -->
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td><strong>iPad Pro</strong></td>
                        <td></td>
                        <td><code>120400</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad Pro</td>
                        <td><strong>iPad Pro (1. generáció)</strong></td>
                        <td><code>120401</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad Pro</td>
                        <td><strong>iPad Pro 2</strong></td>
                        <td><code>120402</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad Pro</td>
                        <td><strong>iPad Pro 3</strong></td>
                        <td><code>120403</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad Pro</td>
                        <td><strong>iPad Pro 4</strong></td>
                        <td><code>120404</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad Pro</td>
                        <td><strong>iPad Pro 5</strong></td>
                        <td><code>120405</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad Pro</td>
                        <td><strong>iPad Pro 6</strong></td>
                        <td><code>120406</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>iPad</td>
                        <td>iPad Pro</td>
                        <td><strong>iPad Pro 7</strong></td>
                        <td><code>120407</code></td>
                    </tr>

                    <!-- MacBook -->
                    <tr>
                        <td>Apple</td>
                        <td><strong>MacBook</strong></td>
                        <td></td>
                        <td></td>
                        <td><code>130000</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>MacBook</td>
                        <td><strong>MacBook Pro</strong></td>
                        <td></td>
                        <td><code>130100</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>MacBook</td>
                        <td><strong>MacBook Air</strong></td>
                        <td></td>
                        <td><code>130200</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>MacBook</td>
                        <td><strong>MacBook Pro Retina</strong></td>
                        <td></td>
                        <td><code>130300</code></td>
                    </tr>

                    <!-- Watch -->
                    <tr>
                        <td>Apple</td>
                        <td><strong>Watch</strong></td>
                        <td></td>
                        <td></td>
                        <td><code>140000</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td><strong>Watch 1</strong></td>
                        <td></td>
                        <td><code>140100</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td><strong>Watch 2</strong></td>
                        <td></td>
                        <td><code>140200</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td><strong>Watch 3</strong></td>
                        <td></td>
                        <td><code>140300</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td><strong>Watch 4</strong></td>
                        <td></td>
                        <td><code>140400</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td><strong>Watch 5</strong></td>
                        <td></td>
                        <td><code>140500</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td><strong>Watch 6</strong></td>
                        <td></td>
                        <td><code>140600</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td><strong>Watch 7</strong></td>
                        <td></td>
                        <td><code>140700</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td><strong>Watch 8</strong></td>
                        <td></td>
                        <td><code>140800</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td><strong>Watch 9</strong></td>
                        <td></td>
                        <td><code>140900</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td><strong>Watch 10</strong></td>
                        <td></td>
                        <td><code>141000</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td><strong>Watch SE</strong></td>
                        <td></td>
                        <td><code>141100</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td>Watch SE</td>
                        <td><strong>Watch SE 1</strong></td>
                        <td><code>141101</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td>Watch SE</td>
                        <td><strong>Watch SE 2</strong></td>
                        <td><code>141102</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td>Watch SE</td>
                        <td><strong>Watch SE 3</strong></td>
                        <td><code>141103</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td><strong>Watch Ultra</strong></td>
                        <td></td>
                        <td><code>141200</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td>Watch Ultra</td>
                        <td><strong>Watch Ultra</strong></td>
                        <td><code>141201</code></td>
                    </tr>
                    <tr>
                        <td>Apple</td>
                        <td>Watch</td>
                        <td>Watch Ultra</td>
                        <td><strong>Watch Ultra 2</strong></td>
                        <td><code>141202</code></td>
                    </tr>

                    <!-- iMac -->
                    <tr>
                        <td>Apple</td>
                        <td><strong>iMac</strong></td>
                        <td></td>
                        <td></td>
                        <td><code>150000</code></td>
                    </tr>
                    <!-- iMac -->
                    <tr>
                        <td>Apple</td>
                        <td><strong>Airpods</strong></td>
                        <td></td>
                        <td></td>
                        <td><code>160000</code></td>
                    </tr>
                    <!-- TV -->
                    <tr>
                        <td>Apple</td>
                        <td><strong>TV</strong></td>
                        <td></td>
                        <td></td>
                        <td><code>170000</code></td>
                    </tr>

                    <!-- Android -->
                    <tr>
                        <td><strong>Android</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><code>200000</code></td>
                    </tr>
                    <tr>
                        <td><strong>Samsung</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><code>300000</code></td>
                    </tr>
                    <tr>
                        <td><strong>Kiegészítők</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><code>800000</code></td>
                    </tr>
                    <tr>
                        <td><strong>Egyéb</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><code>900000</code></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            </div>
        </div>

    </div>
@endsection
