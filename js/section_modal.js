// $('.list-group.checked-list-box .list-group-item').each(function () {
$('.list-group.checked-list-box .lgi').each(function () {
    
    // Settings
    var $widgeted = $(this), $widget = $(this).find('label'), 
        $checkbox = $('<input type="checkbox" class="hidden" />'),
        color = ($widget.parent().data('color') ? $widget.parent().data('color') : "success"),
        style = ($widget.parent().data('style') == "button" ? "btn-" : "list-group-item-"),
        settings = {
            on: {
                icon: 'glyphicon glyphicon-check'
            },
            off: {
                icon: 'glyphicon glyphicon-unchecked'
            }
        };

        console.log($widget.parent().data('color'))
        
    $widget.parent().css('cursor', 'pointer')
    $widget.parent().append($checkbox);

    // Event Handlers
    $widget.on('click', function () {
        $checkbox.prop('checked', !$checkbox.is(':checked'));
        $checkbox.triggerHandler('change');
        updateDisplay();
    });
    $checkbox.on('change', function () {
    	// $checkbox.prop('checked', 'checked')	// My addition
        updateDisplay();
    });


    // Remove class active from selected
    function removeSelected() {
    	$("#check-list-box li").each(function(idx, li) {
            $(li).removeClass(style + color + ' selected');
            $(li).find('span.state-icon').removeClass('glyphicon-check').addClass('glyphicon-unchecked')
        });
    }
      

    // Actions
    function updateDisplay() {
    	removeSelected()	// My addition
        var isChecked = $checkbox.is(':checked');
        console.log(isChecked)

        // Set the button's state
        $widget.parent().data('state', (isChecked) ? "on" : "off");

        // Set the button's icon
        $widget.parent().find('.state-icon')
            .removeClass()
            .addClass('state-icon ' + settings[$widget.parent().data('state')].icon);

        // Update the button's color
        if (isChecked) {
            $widget.parent().addClass(style + color + ' selected');
        } else {
            $widget.parent().removeClass(style + color + ' selected');
        }
    }

    // Initialization
    function init() {
        
        if ($widget.parent().data('checked') == true) {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
        }
        
        updateDisplay();

        // Inject the icon if applicable
        if ($widget.parent().find('.state-icon').length == 0) {
            $widget.parent().prepend('<span class="state-icon ' + settings[$widget.parent().data('state')].icon + '"></span>');
        }
    }
    init();
});

var desc = $("[rel=tooltip]");
for(i=0;i<desc.length;i++){
    the_post = $(desc[i]);
    if(the_post.hasClass('top')){
        the_post.tooltip({ placement: 'top'});
        the_post.css("cursor","pointer");
    }else{
        the_post.tooltip({ placement: 'rigt'});
        the_post.css("cursor","pointer");
    }
}

$('.list-group-item').on('mouseover', function(event) {
    event.preventDefault();
    $(this).closest('li').addClass('open');
});
  $('.list-group-item').on('mouseout', function(event) {
    event.preventDefault();
    $(this).closest('li').removeClass('open');
});

/*$('#get-checked-data').on('click', function(event) {
    event.preventDefault(); 
    var checkedItems = {}, counter = 0;
    $("#check-list-box li.active").each(function(idx, li) {
        checkedItems[counter] = $(li).text();
        counter++;
    });
    $('#display-json').html(JSON.stringify(checkedItems, null, '\t'));
});*/
