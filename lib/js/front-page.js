(function($){
    function hideText( textselector, strlen, moretext ){
        strlen = typeof strlen !== 'undefined' ? strlen : 100;
        moretext = typeof moretext !== 'undefined' ? moretext : 'Read More';

        var sections = $( textselector );
        for(var i = 0; i < sections.length; i++ ){
            console.log( sections[i] );
            var textToHide = $( sections[i] ).html();
            var textToCheck = $( sections[i] ).text().substring(strlen);
            if( '' == textToCheck )
                continue;
            var visibleText = $( sections[i] ).text().substring(0, strlen);

            $( sections[i] )
                .html(('<span class="visible-text">' + visibleText + '</span>') + ('<span class="hidden-text">' + textToHide + '</span>'))
                .append('<span class="readmore">&hellip;[<a id="readmore" title="' + moretext + '" style="cursor: pointer;">' + moretext + '</a>]</spam>')
                .click(function() {
                    $(this).find('span.hidden-text').toggle();
                    $(this).find('span.readmore').hide();
                    $(this).find('span.visible-text').hide();
                });
            $( sections[i] ).find( 'span.hidden-text' ).hide();
        }
    }

    hideText( 'div.hidetext', 160, 'Read more &darr;' );
})(jQuery);