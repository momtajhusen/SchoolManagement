 
///////// Custom Date /////////
var subdomain = window.location.hostname.split('.')[0];
    if(subdomain == '127' && subdomain == 'dev'){
        if (website.includes(subdomain)) {
            // const current_year = 2081;
            // const current_month = 1;
            // const current_day = 1;
        }
    }
///////// Current Data /////////

    const current_year = NepaliFunctions.GetCurrentBsDate().year;
    const current_month = NepaliFunctions.GetCurrentBsDate().month;
    const current_day = NepaliFunctions.GetCurrentBsDate().day;
    const decremented_current_month = current_month - 1;
    const MonthsArray = NepaliFunctions.GetBsMonths();





