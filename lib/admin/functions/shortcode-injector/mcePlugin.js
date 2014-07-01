(function() {

	// tinymce.PluginManager.requireLangPack('kjdShortCodeInjection');
	
	tinymce.create('tinymce.plugins.kjdShortCodeInjection', {
		init : function(ed, url) {
			ed.addCommand('mcekjdShortCodeInjection', function() {
				ed.windowManager.open({
					file : url+'/shortcode_window.php',
					title: "Select a shortcode",
					popup_css: "../../../../styles/bootstrap.css",
					width : 900 + ed.getLang('kjdShortCodeInjection.delta_width', 0),
					height : 600 + ed.getLang('kjdShortCodeInjection.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('kjdShortCodeInjection', {
				title : 'KJD Shortcode Button',
				cmd : 'mcekjdShortCodeInjection',
				image : url + '/bootstrap.png'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('kjdShortCodeInjection', n.nodeName == 'IMG');
			});
		},

		getInfo : function() {
			return {
					longname  : 'kjdShortCodeInjection',
					author 	  : 'Kyle Jennings',
					authorurl : 'kylejenningsdesign.com',
					infourl   : 'kylejenningsdesign.com',
					version   : "1"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('kjdShortCodeInjection', tinymce.plugins.kjdShortCodeInjection);
})();