/**
 * $Id: editor_plugin_src.js 201 2007-02-12 15:56:56Z spocke $
 * 
 * @author Vladislav Gorlov
 * @copyright WebAsyst � 2008-2012.
 */
(function() {
	tinymce.PluginManager.requireLangPack('toolbartoggle');
	tinymce.create('tinymce.plugins.ToolbarToggle', {
		init : function(ed, url) {//onPostRender
			ed.onPostRender.add(function(ed, cm) {
						ed.settings.plugin_toolbartoggle_show = true;
						setTimeout(function() {
									ed.execCommand('mceToolbarToggle', true,
											null);
								}, 100);

					});

			ed.addCommand('mceToolbarToggle', function() {
				try {
					ed.settings.plugin_toolbartoggle_show = !ed.settings.plugin_toolbartoggle_show;
					var i = 1;
					var id = ed.settings.id;
					while (toolbar = document.getElementById(id + '_toolbar'
							+ (++i))) {
						toolbar.style.display = ed.settings.plugin_toolbartoggle_show
								? ''
								: 'none';
					}
					var editorTable = document.getElementById(id + '_ifr');
					if (editorTable&&editorTable.parentNode.offsetHeight) {
						editorTable.style.height = ''
								+ editorTable.parentNode.offsetHeight + 'px';
					}else if(editorTable){
						editorTable.style.height = '298px';
					}
				} catch (e) {
					alert(e.message);
				};
			});
			ed.addButton('toolbartoggle', {
						title : 'toolbartoggle.desc',
						cmd : 'mceToolbarToggle',
						image : url + '/img/toggle.gif'
					});

			ed.onNodeChange.add(function(ed, cm) {
						cm.setActive('toolbartoggle', ed
										.getParam('plugin_toolbartoggle_show'));
					});
		},

		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : 'Toggle toolbar',
				author : 'WebAsyst',
				authorurl : '#',
				infourl : '#shop/',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('toolbartoggle', tinymce.plugins.ToolbarToggle);
})();