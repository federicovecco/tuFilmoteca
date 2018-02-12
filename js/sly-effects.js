// -------------------------------------------------------------
//   Effects
// -------------------------------------------------------------
$(document).ready(function () {
        var $frame = $('#effects');
        var $wrap  = $frame.parent();

        // Call Sly on frame
        $frame.sly({
                horizontal: 1,
                itemNav: 'forceCentered',
                smart: 1,
                activateMiddle: 1,
                activateOn: 'click',
                mouseDragging: 1,
                touchDragging: 1,
                releaseSwing: 1,
                startAt: 3,
                scrollBar: $wrap.find('.scrollbar'),
                scrollBy: 1,
                speed: 300,
                elasticBounds: 1,
                easing: 'swing',
                dragHandle: 1,
                dynamicHandle: 1,
                clickBar: 1,

                // Buttons
                prev: $wrap.find('.prev'),
                next: $wrap.find('.next')
        });
        
        $('#effects').sly('on', 'load', function(eventName){
            itemIndex = this.getInex;
            alert(itemIndex+"estas en la funcion");
            $('#title').html(dataFilm[(itemIndex*2)]);
            $('#sinopsis').html(dataFilm[(itemIndex*2)+1]);
        });
        
        $('#effects').sly('on','active', function(eventName, itemIndex){
            //function 
            $('#title').html(dataFilm[(itemIndex*2)]);
            $('#sinopsis').html(dataFilm[(itemIndex*2)+1]);
            });
    });     

// -------------------------------------------------------------
//   Object selected details
// -------------------------------------------------------------
