ToggleTVSet.util = {
    // Show/Hide a set of template variables
    toggleTVSet: function (tvs, show) {
        Ext.each(tvs, function (tv) {
            var field = Ext.get('tv' + tv + '-tr');
            if (field) {
                if (show) {
                    field.setStyle('display', 'block');
                } else {
                    field.setStyle('display', 'none');
                }
            }
        });
        if (ToggleTVSet.config.debug) {
            console.log('ToggleTVSet triggered tvs(' + tvs + ') set to ' + ((show) ? 'show' : 'hide') + '.');
        }
    },
    // Toggle a set of template variables by the value of a TV
    toggleTVSets: function (tv, init) {
        var hideTVs, showTVs;
        if (init) {
            hideTVs = tv.hideTVs;
            showTVs = tv.showTVs;
        } else {
            hideTVs = tv.store.data.keys.join().split(',');
            showTVs = tv.getValue().split(',');
        }
        ToggleTVSet.util.toggleTVSet(hideTVs, 0);
        ToggleTVSet.util.toggleTVSet(showTVs, 1);
        if (!init && ToggleTVSet.config.toggleTVsClearHidden) {
            var clearTVs = hideTVs.filter(function (el) {
                return showTVs.indexOf(el) === -1;
            });
            ToggleTVSet.util.clearTVSet(clearTVs);
        }
    },
    // Clear a set of template variables
    clearTVSet: function (tvs) {
        Ext.each(tvs, function (tv) {
            var field = ToggleTVSet.form.Resource.findField('tv' + tv);
            if (field) {
                field.setValue('');
            }
        });
    },
    // Init toggling template variables
    init: function () {
        ToggleTVSet.panel.Resource = Ext.getCmp('modx-panel-resource');
        if (ToggleTVSet.panel.Resource) {
            ToggleTVSet.panel.Resource.on('afterlayout', function () {
                if (!ToggleTVSet.config.initialized) {
                    ToggleTVSet.form.Resource = ToggleTVSet.panel.Resource.getForm();
                    ToggleTVSet.util.toggleTVSets(ToggleTVSet.config, true);
                    Ext.each(ToggleTVSet.config.toggleTVs, function (toggleTV) {
                        var field = ToggleTVSet.form.Resource.findField('tv' + toggleTV);
                        if (field) {
                            field.on('select', function () {
                                ToggleTVSet.util.toggleTVSets(this, false);
                            });
                        }
                    });
                }
                ToggleTVSet.config.initialized = true;
            });
        }
    }
}
