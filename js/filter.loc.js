var show_filter_country = false;
var show_filter_lecture = false;

function toggleCountryFilter() 
{
    $('#discipline-filter').slideUp('fast');
    $('#document-filter').slideDown('fast');    
        //смещаем стрелку влево
	$('#document-filter-angle img').css('margin-left','230px');
	if(!show_filter_lecture)
        {
            
            $('#document-filter').slideDown('fast');    
        }   
	// Смена стрелочки при открытии/закрытии
        if(show_filter_country==false) 
        {
            $('#filter-link-1').html('select country and university ▲');
            show_filter_country = true;
            $('#document-filter').slideDown('fast');  
        } 
        else 
        {
            $('#filter-link-1').html('select country and university ▼');
            show_filter_country = false; 
            $('#document-filter').slideUp('fast');   
        }
        // Если открыт соседний фильтр
        if(show_filter_lecture==true) 
        {
            
            $('#filter-link-2').html('select discipline and lecture ▼');
            show_filter_lecture = false;
        }
}
function toggleLectureFilter() 
{
    $('#document-filter').slideUp('fast');
    $('#discipline-filter').slideDown('fast'); 
	//$('#document-filter-angle img').css('margin-left','400px');
	if(!show_filter_country)
        {
            //alert(show_filter_country)
            $('#document-filter-angle img').css('margin-left','200px');
            $('#discipline-filter').slideDown('fast');  
        }
        
        if($("#filter-link-1").is(":hidden"))
        {
            //alert(show_filter_country)
            $('#document-filter-angle img').css('margin-left','200px');
        }
        else
        {
            //alert(show_filter_country)
            $('#document-filter-angle img').css('margin-left','400px');
        }
	// Смена стрелочки при открытии/закрытии
        if(show_filter_lecture==false) 
        {
            $('#filter-link-2').html('select discipline and lecture ▲');
            show_filter_lecture = true;
            $('#discipline-filter').slideDown('fast'); 
        } 
        else 
        {
            $('#filter-link-2').html('select discipline and lecture ▼');
            show_filter_lecture = false;  
            $('#discipline-filter').slideUp('fast'); 
        }
        // Если открыт соседний фильтр
        if(show_filter_country==true) 
        {
            $('#filter-link-1').html('select country and university ▼');
            
            show_filter_country = false;
        }
}

$(document).ready(function (){
    if($("#filter-link-1").is(":hidden"))
    {
        //alert(show_filter_country)
        $('#document-filter-angle img').css('margin-left','200px');
    }
  $("#notuni").change(function(){
      $('#filter-link-1').hide();
      $('#document-filter-angle img').css('margin-left','200px');
      //toggleCountryFilter();
      $('#document-filter').slideUp('fast');
      $('#is_university_document').val('0');
      
      $.post("/getCountry", { country: 'country' },
                  function(data){
                     $(".locations").replaceWith("<div class=\"locations locations100\">"+data.loc1+"</div>");
                     $(".del_country").remove();
                     $(".del_region").remove();
                     $(".del_univer").remove();
                     $(".del_city").remove();
                     $("#country_id").val('');
                     $("#region_id").val('');
                     $("#university_id").val('');
                     $("#city_id").val('');
                     $(".univer").hide();
                  }, "json");
  });
  $("#uni").change(function(){
      $('#filter-link-1').show();
      $('#document-filter-angle img').css('margin-left','400px');
      $('#is_university_document').val('1');
  });
  //Возвращаемся по цепочке истории к списку универов
  $('#del_region').live('click',function(){
      var country_id = $('#country_id').val();
      $.post("/getRegions", { country_id: country_id },
                  function(data){  
                      $(".locations").replaceWith("<div class=\"locations locations51\">"+data.loc1+"</div>");
                      $(".univer").replaceWith("<div class=\"univer\">"+data.univers+"</div>");
                      $(".univer100").replaceWith("<div class=\"univer\">"+data.univers+"</div>");
                      $("#city_id").val('');
                      $("#region_id").val('');
                      $(".del_univer").remove();
                      $(".del_city").remove();
                      $(".del_region").remove();
                  }, "json");
  });
  
  $('#del_city').live('click',function(){
      var region_id = $('#region_id').val();
      $.post("/getCities", { region_id: region_id },
                  function(data){
                     $(".locations").replaceWith("<div class=\"locations locations51\">"+data.loc1+"</div>");
                     $(".univer100").replaceWith("<div class=\"univer\">"+data.univers+"</div>");
                     $("#region_id").val(region_id);
                     $(".del_univer").remove();
                     $(".del_city").remove();
                     $("#university_id").val('');
                     $("#city_id").val('');
                  }, "json");
  });
  
  $('#del_country').live('click',function(){
      $.post("/getCountry", { country: 'country' },
                  function(data){
                     $(".locations").replaceWith("<div class=\"locations locations100\">"+data.loc1+"</div>");
                     $(".del_country").remove();
                     $(".del_region").remove();
                     $(".del_univer").remove();
                     $(".del_city").remove();
                     $("#country_id").val('');
                     $("#region_id").val('');
                     $("#university_id").val('');
                     $("#city_id").val('');
                     $(".univer100").replaceWith("<div class=\"univer\">"+data.univers+"</div>");
                     $(".univer").hide();
                  }, "json");
  });
  /************** для кнопок ***************************************/
  $('.region_btn').live('click',function(){
      $.post("/getCountry", { country: 'country' },
                  function(data){
                     $(".locations").replaceWith("<div class=\"locations locations100\">"+data.loc1+"</div>");
                     $(".del_country").remove();
                     $(".del_region").remove();
                     $(".del_univer").remove();
                     $(".del_city").remove();
                     $("#country_id").val('');
                     $("#region_id").val('');
                     $("#university_id").val('');
                     $("#city_id").val('');
                     $(".univer").hide();
                  }, "json");
  });
  $('.city_btn').live('click',function(){
      var country_id = $('#country_id').val();
      $.post("/getRegions", { country_id: country_id },
                  function(data){  
                      $(".locations").replaceWith("<div class=\"locations locations51\">"+data.loc1+"</div>");
                      $(".univer").replaceWith("<div class=\"univer\">"+data.univers+"</div>");
                      $(".univer100").replaceWith("<div class=\"univer\">"+data.univers+"</div>");
                      $("#city_id").val('');
                      $("#region_id").val('');
                      $(".del_univer").remove();
                      $(".del_city").remove();
                      $(".del_region").remove();
                  }, "json");
  });
  $('.univer_btn').live('click',function(){
      var region_id = $('#region_id').val();
      $.post("/getCities", { region_id: region_id },
                  function(data){
                     $(".locations").replaceWith("<div class=\"locations locations51\">"+data.loc1+"</div>");
                     $(".univer100").replaceWith("<div class=\"univer\">"+data.univers+"</div>");
                     $("#region_id").val(region_id);
                     $(".del_univer").remove();
                     $(".del_city").remove();
                     $("#university_id").val('');
                     $("#city_id").val('');
                  }, "json");
  });
  $('.lecture_btn').live('click',function(){
      $.post("/getDiscipline", { dis: 'dis' },
                  function(data){
                     $('#discipline_id').val('');
                     $('.discipline').replaceWith('<div class="discipline">'+data.dis+'</div>');
                     $('.del_discipline').remove();
                     $('.del_lecture').remove();
                  }, "json");
  });
  /******************************************************************************************/
  
  $("#del_univer").live('click',function(event){
                            event.preventDefault();                        
                            $("#university_id").val('');
                            $(".del_univer").remove();
                        });
   //возвращение по цепочке истории для дисциплин                     
  $('#del_discipline').live('click',function(){
      $.post("/getDiscipline", { dis: 'dis' },
                  function(data){
                     $('#discipline_id').val('');
                     $('.discipline').replaceWith('<div class="discipline">'+data.dis+'</div>');
                     $('.del_discipline').remove();
                     $('.del_lecture').remove();
                  }, "json");
  });
  
  $('#del_lecture').live('click',function(){
      $('#lecture_id').val('');
      $('.del_lecture').remove();
  });
});