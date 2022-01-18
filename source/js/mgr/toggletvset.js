var toggletvset = function (config) {
    config = config || {};
    toggletvset.superclass.constructor.call(this, config);
};

Ext.extend(toggletvset, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, util: {}, jquery: {}, form: {}
});
Ext.reg('toggletvsettv', toggletvset);

var ToggleTVSet = new toggletvset();
