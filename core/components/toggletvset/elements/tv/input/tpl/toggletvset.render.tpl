<select id="tv{$tv->id}" name="tv{$tv->id}">
    {foreach from=$opts item=item}
        <option value="{$item.value}" {if $item.selected} selected="selected"{/if}>{$item.text}</option>
    {/foreach}
</select>


<script>
    // <![CDATA[{literal}
    Ext.onReady(function () {
        var fld = MODx.load({{/literal}
            xtype: 'combo',
            transform: 'tv{$tv->id}',
            id: 'tv{$tv->id}',
            triggerAction: 'all',
            width: 400,
            allowBlank: false,
            maxHeight: 300,
            editable: false,
            typeAhead: false,
            msgTarget: 'under',{literal}
            listeners: {
                select: {
                    fn: MODx.fireResourceFormChange,
                    scope: this
                }
            }
        });
        Ext.getCmp('modx-panel-resource').getForm().add(fld);
    });{/literal}
    // ]]>
</script>
