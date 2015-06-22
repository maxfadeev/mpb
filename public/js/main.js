$(document).ready(function(){
    $('#text').wysiwyg({
        buttons: {
            // /vendor/wysiwygjs/smiley plugin
            smilies: {
                title: 'Smilies',
                image: '<img src="/vendor/wysiwygjs/smiley/devil.png" width="16" height="16" alt="" />', // <img src="path/to/image.png" width="16" height="16" alt="" />
                popup: function ($popup, $button) {
                    var list_smilies = [
                        '<img src="/vendor/wysiwygjs/smiley/afraid.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/amorous.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/angel.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/angry.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/bored.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/cold.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/confused.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/cross.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/crying.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/devil.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/disappointed.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/dont-know.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/drool.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/embarrassed.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/excited.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/excruciating.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/eyeroll.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/happy.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/hot.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/hug-left.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/hug-right.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/hungry.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/invincible.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/kiss.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/lying.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/meeting.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/nerdy.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/neutral.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/party.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/pirate.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/pissed-off.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/question.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/sad.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/shame.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/shocked.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/shut-mouth.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/sick.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/silent.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/sleeping.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/sleepy.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/stressed.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/thinking.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/tongue.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/uhm-yeah.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/wink.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/working.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/bathing.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/beer.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/boy.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/camera.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/chilli.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/cigarette.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/cinema.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/coffee.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/girl.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/console.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/grumpy.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/in_love.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/internet.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/lamp.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/mobile.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/mrgreen.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/musical-note.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/music.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/phone.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/plate.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/restroom.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/rose.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/search.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/shopping.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/star.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/studying.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/suit.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/surfing.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/thunder.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/tv.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/typing.png" width="16" height="16" alt="" />',
                        '<img src="/vendor/wysiwygjs/smiley/writing.png" width="16" height="16" alt="" />'
                    ];
                    var $smilies = $('<div/>').addClass('wysiwyg-plugin-smilies')
                        .attr('unselectable', 'on');
                    $.each(list_smilies, function (index, smiley) {

                        var $image = $(smiley).attr('unselectable', 'on');
                        // Append smiley
                        var imagehtml = ' ' + $('<div/>').append($image.clone()).html() + ' ';
                        $image
                            .css({cursor: 'pointer'})
                            .click(function (event) {
                                $('#text').wysiwyg('shell').insertHTML(imagehtml); // .closePopup(); - do not close the popup
                            })
                            .appendTo($smilies);
                    });
                    var $container = $('#text').wysiwyg('container');
                    $smilies.css({maxWidth: parseInt($container.width() * 0.95) + 'px'});
                    $popup.append($smilies);
                    // Smilies do not close on click, so force the popup-position to cover the toolbar
                    var $toolbar = $button.parents('.wysiwyg-toolbar');
                    if (!$toolbar.length) // selection toolbar?
                        return;
                    return { // this prevents applying default position
                        left: parseInt(($toolbar.outerWidth() - $popup.outerWidth()) / 2),
                        top: $toolbar.hasClass('wysiwyg-toolbar-bottom') ? ($container.outerHeight() - parseInt($button.outerHeight() / 4)) : (parseInt($button.outerHeight() / 4) - $popup.height())
                    };
                },
                //showstatic: true,    // wanted on the toolbar
                showselection: true    // wanted on selection
            },
            insertimage: {
                title: 'Insert image',
                image: '<img src="/vendor/wysiwygjs/smiley/typing.png" width="16" height="16" alt="" />', // <img src="path/to/image.png" width="16" height="16" alt="" />
                //showstatic: true,    // wanted on the toolbar
                showselection: true    // wanted on selection
            }
        }
    });
});
