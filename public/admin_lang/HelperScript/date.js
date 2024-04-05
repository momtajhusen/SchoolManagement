 
///////// Custom Date /////////
var subdomain = window.location.hostname.split('.')[0];
let current_year, current_month, current_day, MonthsArray;

if (subdomain == 'dev') {
    current_year = 2080;
    current_month = 1;
    current_day = 1;
}else{
    current_year = NepaliFunctions.GetCurrentBsDate().year;
    current_month = NepaliFunctions.GetCurrentBsDate().month;
    current_day = NepaliFunctions.GetCurrentBsDate().day;
    decremented_current_month = current_month - 1;
    MonthsArray = NepaliFunctions.GetBsMonths();
}   
 





