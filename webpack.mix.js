// Node.js 17+ OpenSSL 3.0対応: md4 → sha256
const crypto = require("crypto");
const origCreateHash = crypto.createHash;
crypto.createHash = (algorithm, options) =>
    origCreateHash(algorithm === "md4" ? "sha256" : algorithm, options);

const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js").vue();
mix.sass("resources/sass/main.scss", "public/css");
