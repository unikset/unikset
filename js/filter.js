var show_filter_country = false;
var show_filter_lecture = false;

function toggleCountryFilter() {
	$('#document-filter-angle img').css('margin-left','230px');
	if(!show_filter_lecture) $('#document-filter').slideToggle('fast');
	// Смена стрелочки при открытии/закрытии
    if(show_filter_country==false) {
        $('#filter-link-1').html('select country and university ▲');
        show_filter_country = true;
    } else {
        $('#filter-link-1').html('select country and university ▼');
        show_filter_country = false;       
    }
    // Если открыт соседний фильтр
    if(show_filter_lecture==true) {
        $('#filter-link-2').html('select discipline and lecture ▼');
        show_filter_lecture = false;
    }
}
function toggleLectureFilter() {
	$('#document-filter-angle img').css('margin-left','400px');
	if(!show_filter_country)	$('#document-filter').slideToggle('fast')
	// Смена стрелочки при открытии/закрытии
    if(show_filter_lecture==false) {
        $('#filter-link-2').html('select discipline and lecture ▲');
        show_filter_lecture = true;
    } else {
        $('#filter-link-2').html('select discipline and lecture ▼');
        show_filter_lecture = false;       
    }
    // Если открыт соседний фильтр
    if(show_filter_country==true) {
        $('#filter-link-1').html('select country and university ▼');
        show_filter_country = false;
    }
}