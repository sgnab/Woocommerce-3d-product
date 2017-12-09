// main function to initialize 3d player
function initClara(opts) {
    var imageUrl=opts.imageUrl;
    var sceneId = "254d90dd-eb0c-4618-ba85-bf22668b1a5d";


    var api = window.claraplayer("myPlayer");
    api.sceneIO.fetchAndUse(sceneId).then(function() {

        // document.getElementById('import').onload = importUrl;
        importUrl(imageUrl);
    });


    function importUrl(imageUrl) {
        var url =imageUrl;
        api.assets.importImage(url, { resizeTo: 1024, targetFormat: 'jpg', quality: 60 }).then(handleImport).catch(handleError);
    }

    function onInputFileChanged(ev) {
        var file = ev.target.files[0];
        api.assets.importImage(file, { resizeTo: 1024 }).then(handleImport).catch(handleError);
    }

    function handleImport(attrs) {
        api.scene.set({name: 'Physical', plug: 'Material', property: 'baseMap'}, attrs.imageNodeId);
    };


};

    opts = {

        imageUrl: php_vars.imageUrl,


    }
    initClara(opts)



