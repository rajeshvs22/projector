/*
 * daterange picker
 * startdate validation
 * enddate validation
 * 
 */
/*
$(function($) {	
var startDate = new Date('01/01/2012');
var FromEndDate = new Date();
var ToEndDate = new Date();

ToEndDate.setDate(ToEndDate.getDate()+365);

$('#datepickerDateFrom').datepicker({
    
    weekStart: 1,
    startDate: '01/01/2012',
    endDate: FromEndDate, 
    format: 'dd/mm/yyyy',
    autoclose: true
})
    .on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#datepickerDateTo').datepicker('setStartDate', startDate);
    }); 
$('#datepickerDateTo')
    .datepicker({
        
        weekStart: 1,
        startDate: startDate,
        endDate: ToEndDate,
        format: 'dd/mm/yyyy',
        autoclose: true
    })
    .on('changeDate', function(selected){
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('#datepickerDateFrom').datepicker('setEndDate', FromEndDate);
    });	

});
*/