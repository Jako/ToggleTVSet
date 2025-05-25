/**
 * ToggleTVSet Input Options
 *
 * @package toggletvset
 * @subpackage inputoptions
 */

ToggleTVSet.panel.InputOptions = function (config) {
    config = config || {};

    this.options = config.options;
    this.params = config.params;

    Ext.applyIf(config, {
        layout: 'form',
        autoHeight: true,
        cls: 'form-with-labels',
        labelAlign: 'top',
        border: false,
        items: [{
            cls: "treehillstudio_about",
            html: '<img width="146" height="40" src="' + ToggleTVSet.config.assetsUrl + 'img/treehill-studio-small.png"' + ' srcset="' + ToggleTVSet.config.assetsUrl + 'img/treehill-studio-small@2x.png 2x" alt="Treehill Studio">',
            listeners: {
                afterrender: function () {
                    this.getEl().select('img').on('click', function () {
                        var msg = '<span style="display: inline-block; text-align: center;">&copy; 2015 by Patrick Percy Blank <a href="https://github.com/pepebe" target="_blank">github.com/pepebe</a><br>' +
                            '<img src="' + ToggleTVSet.config.assetsUrl + 'img/treehill-studio.png" srcset="' + ToggleTVSet.config.assetsUrl + 'img/treehill-studio@2x.png 2x" alt="Treehill Studio" style="margin-top: 10px"><br>' +
                            '&copy; 2015-2025 by <a href="https://treehillstudio.com" target="_blank">treehillstudio.com</a></span>';
                        Ext.Msg.show({
                            title: _('toggletvset.package') + ' ' + ToggleTVSet.config.version,
                            msg: msg,
                            buttons: Ext.Msg.OK,
                            cls: 'treehillstudio_window',
                            width: 358
                        });
                    });
                }
            }
        }]
    });
    ToggleTVSet.panel.InputOptions.superclass.constructor.call(this, config);
};
Ext.extend(ToggleTVSet.panel.InputOptions, MODx.Panel);
Ext.reg('toggletvset-panel-inputoptions', ToggleTVSet.panel.InputOptions);
