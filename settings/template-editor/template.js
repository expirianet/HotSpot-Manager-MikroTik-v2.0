
const editor = grapesjs.init({
    container: "#editor",
    fromElement: true,
    width: "auto",
    storageManager: false,
    dragMode: "absolute"
});

editor.on('component:styleUpdate:{width}', e => {
    console.log("component:styleUpdate:width", e)
});

editor.DomComponents.addType("text", {
    model: {
        defaults: {
            attributes: {class: 'p-absolute'},
            resizable: true,
            styles: `.p-absolute {position: absolute; transform-origin: bottom right;}`
        }
    }
});

editor.BlockManager.add('text', {
    label: 'Text',
    content: '<div data-gjs-type="text">My Text</div>',
});

editor.BlockManager.add('image', {
    label: 'Image',
    content: '<img src="https://via.placeholder.com/150" />',
});