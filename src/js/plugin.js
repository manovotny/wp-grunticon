/*jshint -W117 */

(function () {
    tinymce.create('tinymce.plugins.Grunticons', {
        init: function (ed, url) {

            ed.addButton('add_icon', {
                title: 'Insert Icon',
                image: '../wp-content/plugins/wp-grunticon/images/icon.png',
                cmd: 'trigger_modal'
            });

            ed.addCommand('trigger_modal', function () {
                var icons = $GRUNTICON.icons,
                    gruntIconHook = $GRUNTICON.js;

                ed.windowManager.open({
                    title: 'Add Icon',
                    file: url + '/../templates/modal.php',
                    width: 500,
                    height: 600,
                    inline: 1
                }, {
                    editor: ed,
                    jquery: jQuery,
                    icons: icons,
                    grunticonHook: gruntIconHook
                });
            });
        },
        createControl: function () {
            return null;
        }
    });
    tinymce.PluginManager.add('Grunticons', tinymce.plugins.Grunticons);
})();
