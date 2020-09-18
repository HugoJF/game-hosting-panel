const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

require('laravel-mix-criticalcss');

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

mix
    .postCss('resources/css/landing.css', 'public/css', [
        tailwindcss('./landing.config.js'),
    ])
    // .criticalCss({
    //     enabled: true,
    //     paths: {
    //         base: process.env.APP_URL,
    //         templates: __dirname + '/public/css/',
    //         suffix: '-critical.min'
    //     },
    //     urls: [
    //         {url: '/', template: 'landing'},
    //     ],
    //     options: {
    //         minify: true,
    //     },
    // })
;


mix
    .js('resources/js/bootstrap.js', 'public/js')
    .react('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        tailwindcss('./tailwind.config.js'),
    ])
    .sass('resources/sass/vendor.scss', 'public/css')
    .webpackConfig({
        devtool: 'source-map',
        devServer: {
            disableHostCheck: true
        },
    })
    .sourceMaps()
// .dump()
;
