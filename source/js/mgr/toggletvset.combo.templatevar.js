/**
 * ToggleTVSet Template Variable
 *
 * @package toggletvset
 * @subpackage toggletvsettv
 */

ToggleTVSet.combo.ToggleTVSet = function (config) {
    config = config || {};

    this.options = config.options;
    this.params = config.params;
    this.tvid = this.options.tvid;

    Ext.applyIf(config, {
        allowBlank: this.options.allowBlank,
        anchor: '100%',
        ctCls: 'toggletvset-tv',
        displayField: 'title',
        fieldLabel: this.options.fieldLabel,
        hiddenName: 'tv' + this.tvid,
        minChars: 2,
        mode: 'remote',
        msgTarget: 'title',
        name: 'tv' + this.tvid,
        pageSize: this.options.pageSize,
        queryDelay: 0,
        store: this.options.store,
        tpl: '<tpl for="."><div class="x-combo-list-item">' + this.options.fieldTpl + '</div></tpl>',
        transform: 'toggletvset-tv-' + this.tvid,
        triggerAction: 'all',
        value: this.options.value,
        valueField: 'id',
        width: 400
    });
    ToggleTVSet.combo.ToggleTVSet.superclass.constructor.call(this, config);
};
ToggleTVSet.combo.ToggleTVSet = Ext.extend(ToggleTVSet.combo.ToggleTVSet, Ext.form.ComboBox);
Ext.reg('toggletvset-combo-toggletvsetv-single', ToggleTVSet.combo.ToggleTVSet);
