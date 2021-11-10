/**
 * Created by baps on 15-06-2020.
 */
    $(document).on('click','.check_totals',function () {
        var supply_history = $("#supply_last_year_sales_percentage"). val();
        var supply_num2=$("#supply_recent_last_7_day_sales_percentage"). val();
        var supply_num3=$("#supply_recent_last_14_day_sales_percentage").val();
        var supply_num4=$("#supply_recent_last_30_day_sales_percentage").val();
        var Supply_Recent_Sales_total=parseInt(supply_num2)+parseInt(supply_num3)+parseInt(supply_num4);
        var supply_num5=$("#supply_trends_year_over_year_historical_percentage").val();
        var supply_num6=$("#supply_trends_year_over_year_current_percentage").val();
        var supply_num7=$("#supply_trends_multi_month_trend_percentage").val();
        var supply_num8=$("#supply_trends_30_over_30_days_percentage").val();
        var supply_num9=$("#supply_trends_multi_week_trend_percentage").val();
        var supply_num10=$("#supply_trends_7_over_7_days_percentage").val();
        var Supply_Trends_Percentage_Total=parseInt(supply_num5)+parseInt(supply_num6)+parseInt(supply_num7)+parseInt(supply_num8)+parseInt(supply_num9)+parseInt(supply_num10);

        var Reorder_history=$("#reorder_last_year_sales_percentage"). val();
        var reorder_num2=$("#reorder_recent_last_7_day_sales_percentage"). val();
        var reorder_num3=$("#reorder_recent_last_14_day_sales_percentage").val();
        var reorder_num4=$("#reorder_recent_last_30_day_sales_percentage").val();
        var Reorder_Recent_Sales_Total=parseInt(reorder_num2)+parseInt(reorder_num3)+parseInt(reorder_num4);

        var reorder_num5=$("#reorder_trends_year_over_year_historical_percentage").val();
        var reorder_num6=$("#reorder_trends_year_over_year_current_percentage").val();
        var reorder_num7=$("#reorder_trends_multi_month_trend_percentage").val();
        var reorder_num8=$("#reorder_trends_30_over_30_days_percentage").val();
        var reorder_num9=$("#reorder_trends_multi_week_trend_percentage").val();
        var reorder_num10=$("#reorder_trends_7_over_7_days_percentage").val();
        var Reorder_Trends_Percentage_Total=parseInt(reorder_num5)+parseInt(reorder_num6)+parseInt(reorder_num7)+parseInt(reorder_num8)+parseInt(reorder_num9)+parseInt(reorder_num10);

        if((supply_history==100) && (Supply_Recent_Sales_total !=0) )
        {
            $('.SupplyInvoice').addClass('error');
            $('.error_message').html('<div class="alert alert-danger">Already supply  history percentage is 100<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
            $(this).attr('readonly', false);
            $(this).removeClass('disable_class');
            window.scrollTo(0,0);
            return false;
        }
       
            else if((supply_history !=100) && (Supply_Recent_Sales_total > 100)){
                $('.SupplyInvoice').addClass('error');
                $('.error_message').html('<div class="alert alert-danger">Supply recent sales percentage the total of all the fields exceeds 100<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                $(this).attr('readonly', false);
                $(this).removeClass('disable_class');
                window.scrollTo(0,0);
                return false;

            }else if((supply_history !=100) && (Supply_Recent_Sales_total < 100)){
                $('.SupplyInvoice').addClass('error');
                $('.error_message').html('<div class="alert alert-danger">Supply recent sales percentage must be 100 and at present the total of all the fields exceeds 100<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                $(this).attr('readonly', false);
                $(this).removeClass('disable_class');
                window.scrollTo(0,0);
                return false;
            }
       

        if(Supply_Trends_Percentage_Total > 100){
            $('.SupplyInvoice').addClass('error');
            $('.error_message').html('<div class="alert alert-danger">Supply trends  percentage the total of all the fields exceeds 100<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
            $(this).attr('readonly', false);
            $(this).removeClass('disable_class');
            window.scrollTo(0,0);
            return false;

        }else if(Supply_Trends_Percentage_Total < 100){
            $('.SupplyInvoice').addClass('error');
            $('.error_message').html('<div class="alert alert-danger">Supply trends   percentage must be 100 and at present the total of all the fields exceeds 100<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
            $(this).attr('readonly', false);
            $(this).removeClass('disable_class');
            window.scrollTo(0,0);
            return false;
        }
         if((Reorder_history==100) && (Reorder_Recent_Sales_Total !=0) ) 
        {
            $('.SupplyInvoice').addClass('error');
            $('.error_message').html('<div class="alert alert-danger">Already reorder history percentage is 100<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
            $(this).attr('readonly', false);
            $(this).removeClass('disable_class');
            window.scrollTo(0,0);
            return false;
        }
                else if((Reorder_history !=100) && (Reorder_Recent_Sales_Total > 100)){
                    $('.ReorderInvoice').addClass('error');
                    $('.error_message').html('<div class="alert alert-danger">Reorder recent sales percentage the total of all the fields exceeds 100 100<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                    $(this).attr('readonly', false);
                    $(this).removeClass('disable_class');
                    window.scrollTo(0,0);
                    return false;
                }else if((Reorder_history !=100) && (Reorder_Recent_Sales_Total < 100)){
                    $('.ReorderInvoice').addClass('error');
                    $('.error_message').html('<div class="alert alert-danger">Reorder recent sales percentage must be 100 and at present the total of all the fields exceeds 100<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                    $(this).attr('readonly', false);
                    $(this).removeClass('disable_class');
                    window.scrollTo(0,0);
                    return false;
                }
            
            if(Reorder_Trends_Percentage_Total > 100){
            $('.ReorderInvoice').addClass('error');
            $('.error_message').html('<div class="alert alert-danger">Reorder trends  percentage the total of all the fields exceeds 100<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
            $(this).attr('readonly', false);
            $(this).removeClass('disable_class');
            window.scrollTo(0,0);
            return false;
        }else if(Reorder_Trends_Percentage_Total < 100){
            $('.ReorderInvoice').addClass('error');
            $('.error_message').html('<div class="alert alert-danger">Reorder trends percentage the total of all the fields exceeds 100<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
            $(this).attr('readonly', false);
            $(this).removeClass('disable_class');
            window.scrollTo(0,0);
            return false;
        }
        else{
            if($('#logic_label_name').val() == ''){
                $('#logic_label_name').addClass('error');
                $('.error_message').html('<div class="alert alert-danger">Please enter logic label name<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                $(this).attr('readonly', false);
                $(this).removeClass('disable_class');
                window.scrollTo(0,0);
                return false;
            }else{
                $('#logic_label_name').removeClass('error');
            }
        }
    });
    $("input[type=range]").mousemove(function (e) {
        var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));
        var percent = val * 100;
        var percentage_range = percent.toFixed(2)+'%';

         var supply_num2=$("#supply_last_year_sales_percentage"). val();

        if($(this).attr('id') == 'supply_last_year_sales_percentage'){
            $('.supply_last_year_sales_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'supply_recent_last_7_day_sales_percentage'){
            $('.supply_recent_last_7_day_sales_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'supply_recent_last_14_day_sales_percentage'){
            $('.supply_recent_last_14_day_sales_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'supply_recent_last_30_day_sales_percentage'){
            $('.supply_recent_last_30_day_sales_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'supply_trends_year_over_year_historical_percentage'){
            $('.supply_trends_year_over_year_historical_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'supply_trends_year_over_year_current_percentage'){
            $('.supply_trends_year_over_year_current_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'supply_trends_multi_month_trend_percentage'){
            $('.supply_trends_multi_month_trend_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'supply_trends_30_over_30_days_percentage'){
            $('.supply_trends_30_over_30_days_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'supply_trends_multi_week_trend_percentage'){
            $('.supply_trends_multi_week_trend_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'supply_trends_7_over_7_days_percentage'){
            $('.supply_trends_7_over_7_days_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'reorder_last_year_sales_percentage'){
            $('.reorder_last_year_sales_percentage').text(percentage_range);
        }
        else if($(this).attr('id') == 'reorder_recent_last_7_day_sales_percentage'){
            $('.reorder_recent_last_7_day_sales_percentage').text(percentage_range);
        }
        else if($(this).attr('id') == 'reorder_recent_last_14_day_sales_percentage'){
            $('.reorder_recent_last_14_day_sales_percentage').text(percentage_range);
        }
        else if($(this).attr('id') == 'reorder_recent_last_30_day_sales_percentage'){
            $('.reorder_recent_last_30_day_sales_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'reorder_trends_year_over_year_historical_percentage'){
            $('.reorder_trends_year_over_year_historical_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'reorder_trends_year_over_year_current_percentage'){
            $('.reorder_trends_year_over_year_current_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'reorder_trends_multi_month_trend_percentage'){
            $('.reorder_trends_multi_month_trend_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'reorder_trends_30_over_30_days_percentage'){
            $('.reorder_trends_30_over_30_days_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'reorder_trends_multi_week_trend_percentage'){
            $('.reorder_trends_multi_week_trend_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'reorder_trends_7_over_7_days_percentage'){
            $('.reorder_trends_7_over_7_days_percentage').text(percentage_range);
        }else if($(this).attr('id') == 'reorder_safety_stock_percentage'){
            $('.reorder_safety_stock_percentage').text(percentage_range);
        }
        $(this).css('background-image',
            '-webkit-gradient(linear, left top, right top, ' +
            'color-stop(' + percent + '%, #556ee6), ' +
            'color-stop(' + percent + '%, #eff2f7)' +
            ')');

        //console.log(percent);
        //return false;


        $(this).css('background-image',
            '-moz-linear-gradient(left center, #556ee6 0%, #556ee6 ' + percent + '%, #eff2f7 ' + percent + '%, #eff2f7 100%)');
    });
$(document).ready(function (e) {
    $("input[type=range]").each(function (e) {
        var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));
        var percent = val * 100;
        var percentage_range = percent.toFixed(2) + '%';
        if ($(this).attr('id') == 'supply_last_year_sales_percentage') {
            $('.supply_last_year_sales_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_recent_last_7_day_sales_percentage') {
            $('.supply_recent_last_7_day_sales_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_recent_last_14_day_sales_percentage') {
            $('.supply_recent_last_14_day_sales_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_recent_last_30_day_sales_percentage') {
            $('.supply_recent_last_30_day_sales_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_trends_year_over_year_historical_percentage') {
            $('.supply_trends_year_over_year_historical_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_trends_year_over_year_current_percentage') {
            $('.supply_trends_year_over_year_current_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_trends_multi_month_trend_percentage') {
            $('.supply_trends_multi_month_trend_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_trends_30_over_30_days_percentage') {
            $('.supply_trends_30_over_30_days_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_trends_multi_week_trend_percentage') {
            $('.supply_trends_multi_week_trend_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_trends_7_over_7_days_percentage') {
            $('.supply_trends_7_over_7_days_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_last_year_sales_percentage') {
            $('.reorder_last_year_sales_percentage').text(percentage_range);
        }
        else if ($(this).attr('id') == 'reorder_recent_last_7_day_sales_percentage') {
            $('.reorder_recent_last_7_day_sales_percentage').text(percentage_range);
        }
        else if ($(this).attr('id') == 'reorder_recent_last_14_day_sales_percentage') {
            $('.reorder_recent_last_14_day_sales_percentage').text(percentage_range);
        }
        else if ($(this).attr('id') == 'reorder_recent_last_30_day_sales_percentage') {
            $('.reorder_recent_last_30_day_sales_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_trends_year_over_year_historical_percentage') {
            $('.reorder_trends_year_over_year_historical_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_trends_year_over_year_current_percentage') {
            $('.reorder_trends_year_over_year_current_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_trends_multi_month_trend_percentage') {
            $('.reorder_trends_multi_month_trend_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_trends_30_over_30_days_percentage') {
            $('.reorder_trends_30_over_30_days_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_trends_multi_week_trend_percentage') {
            $('.reorder_trends_multi_week_trend_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_trends_7_over_7_days_percentage') {
            $('.reorder_trends_7_over_7_days_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_safety_stock_percentage') {
            $('.reorder_safety_stock_percentage').text(percentage_range);
        }
        $(this).css('background-image',
            '-webkit-gradient(linear, left top, right top, ' +
            'color-stop(' + percent + '%, #556ee6), ' +
            'color-stop(' + percent + '%, #eff2f7)' +
            ')');

        //console.log(percent);
        //return false;

        $(this).css('background-image',
            '-moz-linear-gradient(left center, #556ee6 0%, #556ee6 ' + percent + '%, #eff2f7 ' + percent + '%, #eff2f7 100%)');
    });
});
$(document).on('click','.reset_button',function () {
    document.getElementById("order_logic").reset();
    var obj = $('input[type=range]');
    $.each(obj,function (index,element) {
        var val = ($(element).val() - $(element).attr('min')) / ($(element).attr('max') - $(element).attr('min'));
        var percent = val * 100;
        var percentage_range = percent.toFixed(2)+'%';
        $(element).css('background-image',
            '-webkit-gradient(linear, left top, right top, ' +
            'color-stop(' + percent + '%, #556ee6), ' +
            'color-stop(' + percent + '%, #eff2f7)' +
            ')');
        $(element).css('background-image',
            '-webkit-gradient(linear, left top, right top, ' +
            'color-stop(' + percent + '%, #556ee6), ' +
            'color-stop(' + percent + '%, #eff2f7)' +
            ')');

        $(element).css('background-image',
            '-moz-linear-gradient(left center, #556ee6 0%, #556ee6 ' + percent + '%, #eff2f7 ' + percent + '%, #eff2f7 100%)');

    });
    $("input[type=range]").each(function (e) {
        var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));
        var percent = val * 100;
        var percentage_range = percent.toFixed(2) + '%';
        if ($(this).attr('id') == 'supply_last_year_sales_percentage') {
            $('.supply_last_year_sales_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_recent_last_7_day_sales_percentage') {
            $('.supply_recent_last_7_day_sales_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_recent_last_14_day_sales_percentage') {
            $('.supply_recent_last_14_day_sales_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_recent_last_30_day_sales_percentage') {
            $('.supply_recent_last_30_day_sales_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_trends_year_over_year_historical_percentage') {
            $('.supply_trends_year_over_year_historical_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_trends_year_over_year_current_percentage') {
            $('.supply_trends_year_over_year_current_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_trends_multi_month_trend_percentage') {
            $('.supply_trends_multi_month_trend_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_trends_30_over_30_days_percentage') {
            $('.supply_trends_30_over_30_days_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_trends_multi_week_trend_percentage') {
            $('.supply_trends_multi_week_trend_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'supply_trends_7_over_7_days_percentage') {
            $('.supply_trends_7_over_7_days_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_last_year_sales_percentage') {
            $('.reorder_last_year_sales_percentage').text(percentage_range);
        }
        else if ($(this).attr('id') == 'reorder_recent_last_7_day_sales_percentage') {
            $('.reorder_recent_last_7_day_sales_percentage').text(percentage_range);
        }
        else if ($(this).attr('id') == 'reorder_recent_last_14_day_sales_percentage') {
            $('.reorder_recent_last_14_day_sales_percentage').text(percentage_range);
        }
        else if ($(this).attr('id') == 'reorder_recent_last_30_day_sales_percentage') {
            $('.reorder_recent_last_30_day_sales_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_trends_year_over_year_historical_percentage') {
            $('.reorder_trends_year_over_year_historical_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_trends_year_over_year_current_percentage') {
            $('.reorder_trends_year_over_year_current_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_trends_multi_month_trend_percentage') {
            $('.reorder_trends_multi_month_trend_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_trends_30_over_30_days_percentage') {
            $('.reorder_trends_30_over_30_days_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_trends_multi_week_trend_percentage') {
            $('.reorder_trends_multi_week_trend_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_trends_7_over_7_days_percentage') {
            $('.reorder_trends_7_over_7_days_percentage').text(percentage_range);
        } else if ($(this).attr('id') == 'reorder_safety_stock_percentage') {
            $('.reorder_safety_stock_percentage').text(percentage_range);
        }
        $(this).css('background-image',
            '-webkit-gradient(linear, left top, right top, ' +
            'color-stop(' + percent + '%, #556ee6), ' +
            'color-stop(' + percent + '%, #eff2f7)' +
            ')');

        //console.log(percent);
        //return false;

        $(this).css('background-image',
            '-moz-linear-gradient(left center, #556ee6 0%, #556ee6 ' + percent + '%, #eff2f7 ' + percent + '%, #eff2f7 100%)');
    });
});