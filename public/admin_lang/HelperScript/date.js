 
//   const current_year = 2082;
//  const current_month = 1;
//  const current_day = 1;
 
 const current_year = NepaliFunctions.GetCurrentBsDate().year;
 const current_month = NepaliFunctions.GetCurrentBsDate().month;
 const current_day = NepaliFunctions.GetCurrentBsDate().day;
 const decremented_current_month = current_month - 1;
 const current_date =  current_year+'-'+current_month+'-'+current_day;

 const MonthsArray = NepaliFunctions.GetBsMonths(); 

// var result = NepaliFunctions.GetMonth(); // Assuming 1 corresponds to the first month
// console.log(result); // Should return the first month