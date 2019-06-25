$('.form-control-chosen').chosen({
    allow_single_deselect: true,
    width: '100%'
});
$('.form-control-chosen-required').chosen({
    allow_single_deselect: false,
    width: '100%'
});
$('.form-control-chosen-search-threshold-100').chosen({
    allow_single_deselect: true,
    disable_search_threshold: 100,
    width: '100%'
});
$('.form-control-chosen-optgroup').chosen({
    width: '100%'
});

$(function() {
    $('[title="clickable_optgroup"]').addClass('chosen-container-optgroup-clickable');
});
$(document).on('click', '[title="clickable_optgroup"] .group-result', function() {
    var unselected = $(this).nextUntil('.group-result').not('.result-selected');
    if(unselected.length) {
    unselected.trigger('mouseup');
    } else {
    $(this).nextUntil('.group-result').each(function() {
        $('a.search-choice-close[data-option-array-index="' + $(this).data('option-array-index') + '"]').trigger('click');
    });
    }
});