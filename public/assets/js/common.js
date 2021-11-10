$('.allow_integer').keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});

$('.allow_float').keypress(function(event) {
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});

$(document).on('keypress','.allow_integer',function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});
$(document).on('keypress','.allow_float',function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $('.edit').css('display','block');
    $('.save').css('display','none');
});

$(document).on('click', ".edit_row", function() {
   
   var no=$(this).attr("data-id");
    if( $('.edit').css('display','none'))
        {
            $('.save').css('display','inline');

        }
 
    document.getElementById("edit_button"+no).style.display="none";
    document.getElementById("save_button"+no).style.display="block";

//var projected_units=document.getElementById("projected_units"+no);
    var items_per_cartoons=document.getElementById("items_per_cartoons"+no);

    var cbm=document.getElementById("cbm"+no);
    var containers=document.getElementById("containers"+no);

    //var projected_units_data=projected_units.innerHTML;
    var items_per_cartoons_data=items_per_cartoons.innerHTML;
    
    var cbm_data=cbm.innerHTML;
    var containers_data=containers.innerHTML;

    //projected_units.innerHTML="<input type='text'class='allow_integer col-md-6' id='projected_units_text"+no+"' value='"+projected_units_data+"' min='0' max='999' maxlength='3'>";
    items_per_cartoons.innerHTML="<input type='text' class='allow_integer col-md-8' id='items_per_cartoons_text"+no+"' value='"+items_per_cartoons_data+"' min='0' max='999' maxlength='3'>";
    cbm.innerHTML="<input type='text' class='allow_integer col-md-8' id='cbm_text"+no+"' value='"+cbm_data+"' min='0' max='999' maxlength='3'>";
    containers.innerHTML="<input type='text' class='allow_float col-md-8' id='containers_text"+no+"' value='"+containers_data+"' min='0' max='999' maxlength='3'>";

});
function myFunction() {
    swal(" The form data is being reset");
}

$(document).ready(function(){
    var sidebarflag = (localStorage.getItem('sidebar') == null || localStorage.getItem('sidebar') == 1) ? 1 : 0; 
    localStorage.setItem('sidebar',sidebarflag);
    if(sidebarflag == 0){
        $('body').addClass('sidebar-enable vertical-collpsed');
    }
});

$('#vertical-menu-btn').on('click', function() {
    var sidebarflag = (localStorage.getItem('sidebar') == null || localStorage.getItem('sidebar') == 0) ? 1 : 0; 
    localStorage.setItem('sidebar',sidebarflag);
});