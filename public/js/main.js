$(document).ready(function(){
    $('#text').trumbowyg({
        btnsDef: {
            image: {
                dropdown: ['insertImage', 'upload', 'base64'],
                ico: 'insertImage'
            },
            btns: ['viewHTML',
                '|', 'formatting',
                '|', 'btnGrp-design',
                '|', 'link',
                '|', 'image',
                '|', 'btnGrp-justify',
                '|', 'btnGrp-lists',
                '|', 'foreColor', 'backColor',
                '|', 'horizontalRule']
        }
    });
});
