(function() {
    tinymce.create('tinymce.plugins.horizontalRule', {
        init : function(ed, url) {
            ed.addButton('horizontalRule', {
                title : 'horizontalRule',
                image : url+'/hr.png',
                onclick : function() {
						ed.execCommand('mceInsertContent', false, ' [hr] ');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Simple Breaks Hr Code",
                author : 'Hit Reach',
                authorurl : 'http://www.hireach.co.uk/',
                version : "1.0"
            };
        }
    });
	tinymce.create('tinymce.plugins.clearBoth', {
        init : function(ed, url) {
            ed.addButton('clearBoth', {
                title : 'Clear Both',
                image : url+'/cb.png',
                onclick : function() {
					ed.execCommand('mceInsertContent', false, ' [clearboth] ');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Simple Breaks Hr Code",
                author : 'Hit Reach',
                authorurl : 'http://www.hireach.co.uk/',
                version : "1.0"
            };
        }
    });
	tinymce.create('tinymce.plugins.clearLeft', {
        init : function(ed, url) {
            ed.addButton('clearLeft', {
                title : 'Clear Left',
                image : url+'/cl.png',
                onclick : function() {
                    ed.execCommand('mceInsertContent', false, ' [clearleft] ');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Simple Breaks Hr Code",
                author : 'Hit Reach',
                authorurl : 'http://www.hireach.co.uk/',
                version : "1.0"
            };
        }
    });
	tinymce.create('tinymce.plugins.clearRight', {
        init : function(ed, url) {
            ed.addButton('clearRight', {
                title : 'Clear Right',
                image : url+'/cr.png',
                onclick : function() {
                    ed.execCommand('mceInsertContent', false, ' [clearright] ');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Simple Breaks Hr Code",
                author : 'Hit Reach',
                authorurl : 'http://www.hireach.co.uk/',
                version : "1.0"
            };
        }
    });
	tinymce.create('tinymce.plugins.lineBreak', {
        init : function(ed, url) {
            ed.addButton('lineBreak', {
                title : 'Line Break',
                image : url+'/br.png',
                onclick : function() {
                    ed.execCommand('mceInsertContent', false, ' [br] ');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Simple Breaks Hr Code",
                author : 'Hit Reach',
                authorurl : 'http://www.hireach.co.uk/',
                version : "1.0"
            };
        }
    });
	tinymce.create('tinymce.plugins.space', {
        init : function(ed, url) {
            ed.addButton('space', {
                title : 'Blank Space',
                image : url+'/sp.png',
                onclick : function() {
                    var size = prompt("Space Size: ");
                    if (size != null && size != '0')
                        ed.execCommand('mceInsertContent', false, ' [space size='+size+'] ');
					else
						ed.execCommand('mceInsertContent', false, ' [space size=10] ');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Simple Breaks Hr Code",
                author : 'Hit Reach',
                authorurl : 'http://www.hireach.co.uk/',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('horizontalRule', tinymce.plugins.horizontalRule);
	tinymce.PluginManager.add('clearBoth', tinymce.plugins.clearBoth);
	tinymce.PluginManager.add('clearLeft', tinymce.plugins.clearLeft);
	tinymce.PluginManager.add('clearRight', tinymce.plugins.clearRight);
	tinymce.PluginManager.add('lineBreak', tinymce.plugins.lineBreak);
	tinymce.PluginManager.add('space', tinymce.plugins.space);
})();
