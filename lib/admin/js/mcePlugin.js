///**
// *
// * Documentation: 
// * http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins
// * http://tinymce.moxiecode.com/wiki.php/Creating_a_plugin
// * 
// */

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('kjdShortCodeInjection');
	
	tinymce.create('tinymce.plugins.kjdShortCodeInjection', {

		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {

			url = url.replace(/js$/, '');
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('mcekjdShortCodeInjection', function() {
				ed.windowManager.open({
					file : url+'/shortcode_window.php',
					title: "Select a shortcode",
					popup_css: "../../../styles/bootstrap.css",
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
				image : url + '/img/bootstrap.png'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('kjdShortCodeInjection', n.nodeName == 'IMG');
			});
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
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
