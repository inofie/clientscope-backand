let company_annual_sales_target         = $('#company_annual_sales_target');
let company_year_to_date_sold           = $('#company_year_to_date_sold');
let left_to_sell                        = $('#left_to_sell');
let company_average_revenue_per_sale    = $('#company_average_revenue_per_sale');
let work_week_left_for_the_year         = $('#work_week_left_for_the_year');
let work_month_left_for_the_year        = $('#work_month_left_for_the_year');
let company_sales_needed_per_week       = $('#company_sales_needed_per_week');
let company_sales_needed_per_month      = $('#company_sales_needed_per_month');
let active_company_sales_rep            = $('#active_company_sales_rep');
let average_annual_sales_per_sales_reps = $('#average_annual_sales_per_sales_reps');
let new_hire_rentention_rate            = $('#new_hire_rentention_rate');
let total_sales_reps_needed             = $('#total_sales_reps_needed');
let new_hire_needed                     = $('#new_hire_needed');
let reach_rate                          = $('#reach_rate');
let no_damage_rate                      = $('#no_damage_rate');
let denied_rate                         = $('#denied_rate');
let inspection_close_rate               = $('#inspection_close_rate');
let file_rate                           = $('#file_rate');
let lost_rate                           = $('#lost_rate');
let damage_rate                         = $('#damage_rate');
let buy_rate                            = $('#buy_rate');
let contract_close_rate                 = $('#contract_close_rate');
let wide_attempts                       = $('#wide_attempts');
let wide_not_qualified                  = $('#wide_not_qualified');
let wide_lost_opportunity               = $('#wide_lost_opportunity');
let wide_contact                        = $('#wide_contact');
let wide_pre_qualified                  = $('#wide_pre_qualified');
let wide_sales                          = $('#wide_sales');
let wide_leads                          = $('#wide_leads');
let wide_approved                       = $('#wide_approved');
let wide_sales_opportunities            = $('#wide_sales_opportunities');
let wide_prospects                      = $('#wide_prospects');
let wide_not_approved                   = $('#wide_not_approved');

let annual_attempts                     = $('#annual_attempts');
let annual_not_qualified                = $('#annual_not_qualified');
let annual_lost_opportunity             = $('#annual_lost_opportunity');
let annual_contact                      = $('#annual_contact');
let annual_pre_qualified                = $('#annual_pre_qualified');
let annual_sales                        = $('#annual_sales');
let annual_leads                        = $('#annual_leads');
let annual_approved                     = $('#annual_approved');
let annual_sales_opportunities          = $('#annual_sales_opportunities');
let annual_prospects                    = $('#annual_prospects');
let annual_not_approved                 = $('#annual_not_approved');

let monthly_attempts                     = $('#monthly_attempts');
let monthly_not_qualified                = $('#monthly_not_qualified');
let monthly_lost_opportunity             = $('#monthly_lost_opportunity');
let monthly_contact                      = $('#monthly_contact');
let monthly_pre_qualified                = $('#monthly_pre_qualified');
let monthly_sales                        = $('#monthly_sales');
let monthly_leads                        = $('#monthly_leads');
let monthly_approved                     = $('#monthly_approved');
let monthly_sales_opportunities          = $('#monthly_sales_opportunities');
let monthly_prospects                    = $('#monthly_prospects');
let monthly_not_approved                 = $('#monthly_not_approved');

let weekly_attempts                     = $('#weekly_attempts');
let weekly_not_qualified                = $('#weekly_not_qualified');
let weekly_lost_opportunity             = $('#weekly_lost_opportunity');
let weekly_contact                      = $('#weekly_contact');
let weekly_pre_qualified                = $('#weekly_pre_qualified');
let weekly_sales                        = $('#weekly_sales');
let weekly_leads                        = $('#weekly_leads');
let weekly_approved                     = $('#weekly_approved');
let weekly_sales_opportunities          = $('#weekly_sales_opportunities');
let weekly_prospects                    = $('#weekly_prospects');
let weekly_not_approved                 = $('#weekly_not_approved');

$(document).ready(function(){
    if( $('#company_sales_needed_per_month').val() != '' ){
        calculateAllFieldsValues();
    }
    $('#company_sales_form').find('input').keyup(function(){
        calculateAllFieldsValues();
    })
})

function calculateAllFieldsValues()
{
    //left to sale calculate
    var left_to_sell_value = ( parseFloat(company_annual_sales_target.val()) - parseFloat(company_year_to_date_sold.val()));
    var us_format_left_to_sell_value = left_to_sell_value.toLocaleString('us-US', { style: 'currency', currency: 'USD' })  
    $('#left_to_sell').val(us_format_left_to_sell_value);

    //company sale needed per week calculate
    var company_sales_needed_per_week_val =  parseFloat(left_to_sell_value) / parseFloat(work_week_left_for_the_year.val());
        company_sales_needed_per_week_val = company_sales_needed_per_week_val.toLocaleString('us-US', { style: 'currency', currency: 'USD' })  
  $('#company_sales_needed_per_week').val(company_sales_needed_per_week_val);

    //Company Sales Needed Per Month calculate
    var company_sales_needed_per_month_val =  parseFloat(left_to_sell_value) / parseFloat(work_month_left_for_the_year.val());
        company_sales_needed_per_month_val = company_sales_needed_per_month_val.toLocaleString('us-US', { style: 'currency', currency: 'USD' })  
    $('#company_sales_needed_per_month').val(company_sales_needed_per_month_val);

    //-	Total Sales Reps Needed Calculate
    var total_sales_reps_needed_val = ( parseFloat(company_annual_sales_target.val()) / parseFloat(average_annual_sales_per_sales_reps.val()) )
    $('#total_sales_reps_needed').val( Math.round(total_sales_reps_needed_val) );
  

    //new hire needed calculate
    var new_hire_needed_val = ( ( total_sales_reps_needed_val - parseFloat(active_company_sales_rep.val()) ) * 100 ) / new_hire_rentention_rate.val();
    $('#new_hire_needed').val( Math.round(new_hire_needed_val) );

    //Wide KPI Targets

    //Sale Value Calculate
    var wide_sales_value = ( parseFloat(company_annual_sales_target.val()) / parseFloat(company_average_revenue_per_sale.val()) );
    $('#wide_sales').val( Math.round(wide_sales_value));

    //Sales Opportunities Calculate
    var wide_sales_opportunities_val = (wide_sales_value * 100) / parseFloat(contract_close_rate.val());
    $('#wide_sales_opportunities').val( Math.round(wide_sales_opportunities_val) );

    //approved calculate
    var wide_approved_val = (wide_sales_value * 100) / parseFloat(buy_rate.val());
    $('#wide_approved').val( Math.round(wide_approved_val) );

    //Pre-Qualified calculate
    var wide_pre_qualified = ( ((wide_approved_val * 100) / parseFloat(file_rate.val()) ) * parseFloat(lost_rate.val()) ) / 100;
        wide_pre_qualified = wide_pre_qualified + ((wide_approved_val * 100) / parseFloat(file_rate.val()) );
    $('#wide_pre_qualified').val( Math.round(wide_pre_qualified) );

    //•	Lost Opportunities calculate
    var wide_lost_opportunity_val = ( ( (wide_approved_val * 100 ) / parseFloat(file_rate.val()) ) * parseFloat(lost_rate.val()) ) / 100;
    $('#wide_lost_opportunity').val( Math.round(wide_lost_opportunity_val) );

    //•	Not Approved calculate
    var wide_not_approved_val = ( wide_pre_qualified * parseFloat(denied_rate.val()) ) / 100;
    $('#wide_not_approved').val( Math.round(wide_not_approved_val) );

    //•	Prospects calculate
    var wide_prospects_val = ( wide_pre_qualified / parseFloat(damage_rate.val()) ) * 100;
    $('#wide_prospects').val( Math.round(wide_prospects_val) );

    //wide_leads calculate
    var wide_leads_val = ( wide_prospects_val / parseFloat(damage_rate.val()) ) * 100;
    $('#wide_leads').val( Math.round(wide_leads_val) );

    //wide_not_qualified calculate
    var wide_not_qualified_val = ( wide_leads_val * parseFloat(no_damage_rate.val()) ) / 100;
    $('#wide_not_qualified').val( Math.round(wide_not_qualified_val) );

    //wide_contact calculate
    var wide_contact_val = ( wide_leads_val / parseFloat(inspection_close_rate.val()) ) * 100;
    $('#wide_contact').val( Math.round(wide_contact_val) );

    //wide_attempts calcualte
    var wide_attempts_val = ( wide_contact_val / parseFloat( reach_rate.val() ) ) * 100
    $('#wide_attempts').val( Math.round(wide_attempts_val) );

    //kpi annual target

    //annual attempts calculate
    var annual_attempts_val = ( wide_attempts_val / parseFloat(active_company_sales_rep.val()) );
    $('#annual_attempts').val( Math.round(annual_attempts_val) );

    //annual not qualified calculate
    var annual_not_qualified_val = ( wide_not_qualified_val / parseFloat(active_company_sales_rep.val()) );
    $('#annual_not_qualified').val( Math.round(annual_not_qualified_val) );

    //annual lost opportunity calculate
    var annual_lost_opportunity_val = ( wide_lost_opportunity_val / parseFloat(active_company_sales_rep.val()) )
    $('#annual_lost_opportunity').val( Math.round(annual_lost_opportunity_val) )

    // annual contact calculate
    var annual_contact_val = ( wide_contact_val / parseFloat(active_company_sales_rep.val()) )
    $('#annual_contact').val( Math.round(annual_contact_val) );

    //annual_pre_qualified calculate
    var annual_pre_qualified_val = ( wide_pre_qualified / parseFloat(active_company_sales_rep.val()) )
    $('#annual_pre_qualified').val( Math.round(annual_pre_qualified_val) )

    //annual_sales calculate
    var annual_sales_val = ( wide_sales_value / parseFloat(active_company_sales_rep.val()) );
    $('#annual_sales').val( Math.round(annual_sales_val) );

    //annual_leads calculate
    var annual_leads_val = ( wide_leads_val /  parseFloat(active_company_sales_rep.val()) );
    $('#annual_leads').val( Math.round(annual_leads_val) );

    //annual_approved calculate
    var annual_approved_val = ( wide_approved_val / parseFloat(active_company_sales_rep.val()) );
    $('#annual_approved').val( Math.round(annual_approved_val) );

    //annual_sales_opportunities calculate
    var annual_sales_opportunities_val = ( annual_sales_val / parseFloat( contract_close_rate.val() ) ) * 100;
    $('#annual_sales_opportunities').val( Math.round(annual_sales_opportunities_val) );

    //annual_prospects calculate
    var annual_prospects_val = ( wide_prospects_val /  parseFloat(active_company_sales_rep.val()) );
    $('#annual_prospects').val( Math.round(annual_prospects_val) );

    //annual_not_approved calculate
    var annual_not_approved_val = ( wide_not_approved_val /  parseFloat(active_company_sales_rep.val()) );
    $('#annual_not_approved').val( Math.round(annual_not_approved_val) );

    //kpi monthly target

    //monthly attempts calculate
    var monthly_attempts_val = ( wide_attempts_val / parseFloat(active_company_sales_rep.val()) );
        monthly_attempts_val = ( monthly_attempts_val / parseFloat(work_month_left_for_the_year.val()) );
    $('#monthly_attempts').val( Math.round(monthly_attempts_val) );

    //monthly not qualified calculate
    var monthly_not_qualified_val = ( wide_not_qualified_val / parseFloat(active_company_sales_rep.val()) );
        monthly_not_qualified_val = ( monthly_not_qualified_val / parseFloat(work_month_left_for_the_year.val()) )
    $('#monthly_not_qualified').val( Math.round(monthly_not_qualified_val) );

    //monthly lost opportunity calculate
    var monthly_lost_opportunity_val = ( wide_lost_opportunity_val / parseFloat(active_company_sales_rep.val()) )
        monthly_lost_opportunity_val = (  monthly_lost_opportunity_val / parseFloat(work_month_left_for_the_year.val()) );
    $('#monthly_lost_opportunity').val( Math.round(monthly_lost_opportunity_val) )

    // annual contact calculate
    var monthly_contact_val = ( wide_contact_val / parseFloat(active_company_sales_rep.val()) )
        monthly_contact_val = ( monthly_contact_val / parseFloat(work_month_left_for_the_year.val()) )
    $('#monthly_contact').val( Math.round(monthly_contact_val) );

    //annual_pre_qualified calculate
    var monthly_pre_qualified_val = ( wide_pre_qualified / parseFloat(active_company_sales_rep.val()) )
        monthly_pre_qualified_val = ( monthly_pre_qualified_val / parseFloat(work_month_left_for_the_year.val()) )
    $('#monthly_pre_qualified').val( Math.round(monthly_pre_qualified_val) )

    //annual_sales calculate
    var monthly_sales_val = ( wide_sales_value / parseFloat(active_company_sales_rep.val()) );
        monthly_sales_val = ( monthly_sales_val / parseFloat(work_month_left_for_the_year.val()) );
    $('#monthly_sales').val( Math.round(monthly_sales_val) );

    //annual_leads calculate
    var monthly_leads_val = ( wide_leads_val /  parseFloat(active_company_sales_rep.val()) );
        monthly_leads_val = ( monthly_leads_val / parseFloat(work_month_left_for_the_year.val()) );
    $('#monthly_leads').val( Math.round(monthly_leads_val) );

    //annual_approved calculate
    var monthly_approved_val = ( wide_approved_val / parseFloat(active_company_sales_rep.val()) );
        monthly_approved_val = ( monthly_approved_val / parseFloat(work_month_left_for_the_year.val()) )
    $('#monthly_approved').val( Math.round(monthly_approved_val) );

    //annual_sales_opportunities calculate
    var monthly_sales_opportunities_val = ( monthly_sales_val / parseFloat( contract_close_rate.val() ) ) * 100;
    $('#monthly_sales_opportunities').val( Math.round(monthly_sales_opportunities_val) );

    //annual_prospects calculate
    var monthly_prospects_val = ( wide_prospects_val /  parseFloat(active_company_sales_rep.val()) );
        monthly_prospects_val = ( monthly_prospects_val / parseFloat(work_month_left_for_the_year.val()) )
    $('#monthly_prospects').val( Math.round(monthly_prospects_val) );

    //annual_not_approved calculate
    var monthly_not_approved_val = ( wide_not_approved_val /  parseFloat(active_company_sales_rep.val()) );
        monthly_not_approved_val = ( monthly_not_approved_val / parseFloat(work_month_left_for_the_year.val()) );
    $('#monthly_not_approved').val( Math.round(monthly_not_approved_val) );

    //weekly kpi group

    //weekly attempts calculate
    var weekly_attempts_val = ( wide_attempts_val / parseFloat(active_company_sales_rep.val()) );
        weekly_attempts_val = ( weekly_attempts_val / parseFloat(work_week_left_for_the_year.val()) );
    $('#weekly_attempts').val( Math.round(weekly_attempts_val) );

    //weekly not qualified calculate
    var weekly_not_qualified_val = ( wide_not_qualified_val / parseFloat(active_company_sales_rep.val()) );
        weekly_not_qualified_val = ( weekly_not_qualified_val / parseFloat(work_week_left_for_the_year.val()) )
    $('#weekly_not_qualified').val( Math.round(weekly_not_qualified_val) );

    //weekly lost opportunity calculate
    var weekly_lost_opportunity_val = ( wide_lost_opportunity_val / parseFloat(active_company_sales_rep.val()) )
        weekly_lost_opportunity_val = (  weekly_lost_opportunity_val / parseFloat(work_week_left_for_the_year.val()) );
    $('#weekly_lost_opportunity').val( Math.round(weekly_lost_opportunity_val) )

    // weekly contact calculate
    var weekly_contact_val = ( wide_contact_val / parseFloat(active_company_sales_rep.val()) )
        weekly_contact_val = ( weekly_contact_val / parseFloat(work_week_left_for_the_year.val()) )
    $('#weekly_contact').val( Math.round(weekly_contact_val) );

    //weekly_pre_qualified calculate
    var weekly_pre_qualified_val = ( wide_pre_qualified / parseFloat(active_company_sales_rep.val()) )
        weekly_pre_qualified_val = ( weekly_pre_qualified_val / parseFloat(work_week_left_for_the_year.val()) )
    $('#weekly_pre_qualified').val( Math.round(weekly_pre_qualified_val) )

    //weekly_sales calculate
    var weekly_sales_val = ( wide_sales_value / parseFloat(active_company_sales_rep.val()) );
        weekly_sales_val = ( weekly_sales_val / parseFloat(work_week_left_for_the_year.val()) );
    $('#weekly_sales').val( Math.round(weekly_sales_val) );

    //weekly_leads calculate
    var weekly_leads_val = ( wide_leads_val /  parseFloat(active_company_sales_rep.val()) );
        weekly_leads_val = ( weekly_leads_val / parseFloat(work_week_left_for_the_year.val()) );
    $('#weekly_leads').val( Math.round(weekly_leads_val) );

    //weekly_approved calculate
    var weekly_approved_val = ( wide_approved_val / parseFloat(active_company_sales_rep.val()) );
        weekly_approved_val = ( weekly_approved_val / parseFloat(work_week_left_for_the_year.val()) )
    $('#weekly_approved').val( Math.round(weekly_approved_val) );

    //weekly_sales_opportunities calculate
    var weekly_sales_opportunities_val = ( weekly_sales_val / parseFloat( contract_close_rate.val() ) ) * 100;
    $('#weekly_sales_opportunities').val( Math.round(weekly_sales_opportunities_val) );

    //weekly_prospects calculate
    var weekly_prospects_val = ( wide_prospects_val /  parseFloat(active_company_sales_rep.val()) );
        weekly_prospects_val = ( weekly_prospects_val / parseFloat(work_week_left_for_the_year.val()) )
    $('#weekly_prospects').val( Math.round(weekly_prospects_val) );

    //weekly_not_approved calculate
    var weekly_not_approved_val = ( wide_not_approved_val /  parseFloat(active_company_sales_rep.val()) );
        weekly_not_approved_val = ( weekly_not_approved_val / parseFloat(work_week_left_for_the_year.val()) );
    $('#weekly_not_approved').val( Math.round(weekly_not_approved_val) );
}
