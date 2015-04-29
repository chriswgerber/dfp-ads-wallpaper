/**
 * Wallpaper Ad
 **/
var dfp_ads = dfp_ad_object[0];
var wallpaper_tag = dfp_ads.wallpaper_ad.position_tag;
jQuery('body').ready(function() {
    jQuery('<!-- Roadblock Ad -->' +
    '<div id=' + wallpaper_tag + '>' +
    '<script type="text/javascript">' +
    'googletag.cmd.push(function() { ' +
    'googletag.display("' + wallpaper_tag + '"); });' +
    '</script>' +
    '</div>' +
    '<!-- Roadblock out-of-page div -->' +
    '<div id="' + wallpaper_tag + '-oop" class="dfp_wallpaper_ad">' +
    '<script type="text/javascript">' +
    'googletag.cmd.push(function() { ' +
    'googletag.display("' + wallpaper_tag + '-oop"); });' +
    '</script>' +
    '</div>').prependTo('body');
});