var mock = {
    source: 'js/mock/',
    webUrl: 'http://localhost/crossfit/',
    enabled: true
};

$.mockjaxSettings.status = 200;
$.mockjaxSettings.statusText = 'OK';
$.mockjaxSettings.responseTime = 0;
$.mockjaxSettings.isTimeout = false;
$.mockjaxSettings.contentType = 'text/json';
$.mockjaxSettings.dataType = 'json';

//CATEGORY-MODULE
$.mockjax({
    url: 'http://localhost/crossfit/product/getAllFeatured',
    proxy: mock.source + 'featuredProducts.json'
});

//PRODUCT-MODULE
$.mockjax({
    url: 'http://localhost/crossfit/category/getAll',
    proxy: mock.source + 'categories.json'
});

$(function(){
    if(!mock.enabled) $.mockjaxClear();
});