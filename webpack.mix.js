const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

const vendors = "node_modules/";
const resourcesAssets = "resources/";
const srcCss = resourcesAssets + "css/";
const srcJs = resourcesAssets + "js/";

//destination path configuration
const dest = "public/";
const destFonts = dest + "webfonts/";
const destCss = dest + "css/";
const destJs = dest + "js/";
const destImg = dest + "img/";
const destImages = dest + "images/";
const destVendors = dest + "vendors/";

const paths = {
    animate: vendors + 'animate.css/',
    jquery: vendors + 'jquery/dist/',
    popperjs: vendors + 'popper.js/dist/umd/',
    bootstrap: vendors + 'bootstrap/dist/',
    jvectormap: vendors + 'bower-jvectormap/',
    magnify: vendors + 'bootstrap-magnify/',
    fontawesome: vendors + '@fortawesome/fontawesome-free/',
    dataTables: vendors + 'datatables/media',
    holderjs: vendors + 'holderjs/',
    select2: vendors + 'select2/dist/',
    select2BootstrapTheme: vendors + 'select2-bootstrap-theme/dist/',
    datetimepicker: vendors + 'eonasdan-bootstrap-datetimepicker/build/',
    icheck: vendors + 'iCheck/',
    jasnyBootstrap: vendors + 'jasny-bootstrap/dist/',
    bootstrapValidator: vendors + 'bootstrapvalidator/dist/',
    jqueryui: vendors + 'jquery-ui/',
    moment: vendors + 'moment/',
    sparkline: vendors + 'sparkline/src/',
    datatables: vendors + 'datatables.net/',
    datatablesbs4: vendors + 'datatables.net-bs4/',
    wow: vendors + 'wowjs/dist/',
    raphael: vendors + 'raphael/',
    twtrBootstrapWizard: vendors + 'twitter-bootstrap-wizard/',
    datatablesbuttonsbs4: vendors + 'datatables.net-buttons-bs4/',
    sweetalert2: vendors + 'sweetalert2/',
    jquery_steps: vendors + 'jquery-steps/'
};

//Needed
//moment
mix.copy(paths.moment + "min/moment.min.js", destVendors + "moment/js");

// //Datepicker
//bootstrap-datetimepicker
mix.copy(
    paths.datetimepicker + "css/bootstrap-datetimepicker.min.css",
    destVendors + "datetimepicker/css"
);
mix.copy(
    paths.datetimepicker + "js/bootstrap-datetimepicker.min.js",
    destVendors + "datetimepicker/js"
);



// indexpage
mix.copy(srcJs + "dashboard.js", destJs + "pages");

// animate
mix.copy(paths.animate + "animate.min.css", destVendors + "animate");


//jasny-bootstrap
mix.copy(
    paths.jasnyBootstrap + "css/jasny-bootstrap.css",
    destVendors + "jasny-bootstrap/css"
);
mix.copy(
    paths.jasnyBootstrap + "js/jasny-bootstrap.js",
    destVendors + "jasny-bootstrap/js"
);

//datatables
mix.copy(
    paths.datatables + "js/jquery.dataTables.js",
    destVendors + "datatables/js"
);
mix.copy(
    paths.datatablesbs4 + "js/dataTables.bootstrap4.js",
    destVendors + "datatables/js"
);
mix.copy(
    paths.datatablesbs4 + "css/dataTables.bootstrap4.css",
    destVendors + "datatables/css"
);
mix.copy(
    paths.datatablesbuttonsbs4 + "css/buttons.bootstrap4.css",
    destVendors + "datatables/css"
);
mix.copy(
    paths.datatablesbuttonsbs4 + "js/buttons.bootstrap4.js",
    destVendors + "datatables/js"
);

//icheck
mix.copy(paths.icheck + "icheck.js", destVendors + "iCheck/js");
mix.copy(paths.icheck + "skins/", destVendors + "iCheck/css", false);

//  default layout page
mix.copy(srcJs + "josh.js", destJs);
mix.copy(paths.raphael + "raphael.min.js", destJs);
mix.copy(paths.holderjs + "holder.js", destJs);
mix.copy(paths.holderjs + "holder.min.js", destJs);

// userprofile page
mix.copy(srcCss + "pages/user_profile.css", destCss + "pages");
mix.copy(srcJs + "pages/user_profile.js", destJs + "pages");

//select2
mix.copy(paths.select2 + "css/select2.min.css", destVendors + "select2/css");
mix.copy(paths.select2 + "js/select2.js", destVendors + "select2/js");
mix.copy(paths.select2 + "js/select2.full.js", destVendors + "select2/js");

mix.copy(
    paths.select2BootstrapTheme + "select2-bootstrap.css",
    destVendors + "select2/css"
);

mix.copy(
    paths.twtrBootstrapWizard + "jquery.bootstrap.wizard.js",
    destVendors + "bootstrapwizard"
);

// bootstrapvalidator
mix.copy(
    paths.bootstrapValidator + "css/bootstrapValidator.min.css",
    destVendors + "bootstrapvalidator/css"
);
mix.copy(
    paths.bootstrapValidator + "js/bootstrapValidator.min.js",
    destVendors + "bootstrapvalidator/js"
);

// 404 page
mix.copy(srcCss + "pages/404.css", destCss + "pages");
mix.copy(srcJs + "404.js", destJs);

// 500 page
mix.copy(srcCss + "pages/500.css", destCss + "pages");
//table css
mix.copy(srcCss + "pages/tables.css", destCss + "pages");


// lockscreen builder
mix.copy(srcCss + "pages/lockscreen.css", destCss + "pages");
mix.copy(srcJs + "lockscreen.js", destJs + "pages");

mix.copy(srcJs + "livicons-1.4.min.js", destJs);


//Copy fonts straight to public
mix.copy(paths.fontawesome + 'webfonts', destFonts);

// font-awesome
mix.copy(paths.fontawesome + 'css/all.css', 'public/css');

//adduser page
mix.copy(srcJs + "pages/adduser.js", destJs + "pages");
mix.copy(srcJs + "pages/edituser.js", destJs + "pages");
mix.copy(srcCss + "pages/wizard.css", destCss + "pages");

//Copy images straight to public
mix.copy(resourcesAssets + "img", destImg, false);
mix.copy(resourcesAssets + "img/authors", destImg + "/authors");
mix.copy(resourcesAssets + "images", destImages, false);
mix.copy(resourcesAssets + "images/authors", destImages + "/authors");

mix.copy(paths.bootstrap + "css/bootstrap.min.css", destCss);
mix.copy(paths.bootstrap + "js/bootstrap.min.js", destJs);

mix.copy(srcCss + "pages/login.css", destCss + "pages");
mix.copy(srcJs + "pages/login.js", destJs + "pages");

// register
mix.copy(srcJs + "jquery.min.js", destJs);

// Custom Styles
// // wow
mix.copy(paths.wow + "wow.min.js", destVendors + "wow/js");

mix.copy(srcJs + "pluginjs/validate.js", destJs + "pluginjs");

//gui builder
mix.copy(srcCss + "pages/custom_gui_builder.css", destCss + "pages");
mix.copy(srcJs + "pages/custom_gui_builder.js", destJs + "pages");

// /* bootstrap4 conversion css*/
mix.copy(srcCss + "custom.css", destCss + "custom.css");
mix.copy(srcCss + "pages/news.css", destCss + "pages/news.css");

// sweetalert 2
mix.copy(paths.sweetalert2 + 'dist/sweetalert2.css', destVendors + 'sweetalert/css');
mix.copy(paths.sweetalert2 + 'dist/sweetalert2.min.js', destVendors + 'sweetalert/js');

//jquery-steps
mix.copy(paths.jquery_steps + 'demo/css/jquery.steps.css', destVendors + 'jquery_steps/css');
mix.copy(paths.jquery_steps + 'build/jquery.steps.min.js', destVendors + 'jquery_steps/js');
mix.copy(srcJs + 'pluginjs/validate.js', destJs + 'pluginjs');

mix.sass(resourcesAssets + "sass/bootstrap.scss", destCss);

//css section
// Custom Styles
//black color scheme
mix.combine(
    [
        destCss + 'bootstrap.css',
        paths.fontawesome + 'css/all.min.css',
        paths.bootstrapValidator + 'css/bootstrapValidator.min.css',
        srcCss + 'black.css',
        srcCss + 'panel.css',
        srcCss + 'metisMenu.css',
        destCss + 'custom.css',
        srcCss + 'pages/custom.css',

        // srcCss + 'pages/fixedmenu.css'
    ],
    destCss + 'app.css'
);

// all global js files into app.js
mix.combine(
    [
        paths.jquery + 'jquery.min.js',
        srcJs + 'pages/jquery-ui.min.js',
        paths.popperjs + 'popper.min.js',
        paths.bootstrap + 'js/bootstrap.min.js',
        vendors + 'raphael/raphael.min.js',
        srcJs + 'livicons-1.4.min.js',
        srcJs + 'metisMenu.js',
        srcJs + 'josh.js',
        srcJs + 'pages/minisidebar.js',
        srcJs + 'jquery-slimscroll.js',
        vendors + 'holderjs/holder.min.js',
        paths.bootstrapValidator + 'js/bootstrapValidator.min.js',
    ],
    destJs + 'app.js'
);