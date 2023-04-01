let user_revenue_per_sale_amount = $('#user_revenue_per_sale_amount'),
    user_average_commission_per_sale = $('#user_average_commission_per_sale'),
    user_annual_income_target = $('#user_annual_income_target'),
    user_total_work_month_left_to_sell = $('#user_total_work_month_left_to_sell'),
    user_total_work_week_left_to_sell = $('#user_total_work_week_left_to_sell'),
    user_total_contracts_needed = $('#user_total_contracts_needed'),
    user_total_annual_sales_needed = $('#user_total_annual_sales_needed'),
    user_reach_rate = $('#user_reach_rate'),
    user_no_damage_rate = $('#user_no_damage_rate'),
    user_denied_rate = $('#user_denied_rate'),
    user_inspection_close_rate = $('#user_inspection_close_rate'),
    user_file_rate = $('#user_file_rate'),
    user_lost_rate = $('#user_lost_rate'),
    user_damage_rate = $('#user_damage_rate'),
    user_buy_rate = $('#user_buy_rate'),
    user_contract_close_rate = $('#user_contract_close_rate'),
    user_annual_attempts = $('#user_annual_attempts'),
    user_annual_not_qualified = $('#user_annual_not_qualified'),
    user_annual_lost_opportunity = $('#user_annual_lost_opportunity'),
    user_annual_contact = $('#user_annual_contact'),
    user_annual_pre_qualified = $('#user_annual_pre_qualified'),
    user_annual_sales = $('#user_annual_sales'),
    user_annual_leads = $('#user_annual_leads'),
    user_annual_approved = $('#user_annual_approved'),
    user_annual_sales_opportunities = $('#user_annual_sales_opportunities'),
    user_annual_prospects = $('#user_annual_prospects'),
    user_annual_not_approved = $('#user_annual_not_approved'),
    user_monthly_attempts = $('#user_monthly_attempts'),
    user_monthly_not_qualified = $('#user_monthly_not_qualified'),
    user_monthly_lost_opportunity = $('#user_monthly_lost_opportunity'),
    user_monthly_contact = $('#user_monthly_contact'),
    user_monthly_pre_qualified = $('#user_monthly_pre_qualified'),
    user_monthly_sales = $('#user_monthly_sales'),
    user_monthly_leads = $('#user_monthly_leads'),
    user_monthly_approved = $('#user_monthly_approved'),
    user_monthly_sales_opportunities = $('#user_monthly_sales_opportunities'),
    user_monthly_prospects = $('#user_monthly_prospects'),
    user_monthly_not_approved = $('#user_monthly_not_approved'),
    user_weekly_attempts = $('#user_weekly_attempts'),
    user_weekly_not_qualified = $('#user_weekly_not_qualified'),
    user_weekly_lost_opportunity = $('#user_weekly_lost_opportunity'),
    user_weekly_contact = $('#user_weekly_contact'),
    user_weekly_pre_qualified = $('#user_weekly_pre_qualified'),
    user_weekly_sales = $('#user_weekly_sales'),
    user_weekly_leads = $('#user_weekly_leads'),
    user_weekly_approved = $('#user_weekly_approved'),
    user_weekly_sales_opportunities = $('#user_weekly_sales_opportunities'),
    user_weekly_prospects = $('#user_weekly_prospects'),
    user_weekly_not_approved = $('#user_weekly_not_approved');

$(document).ready(function(){
    if( $('#user_total_contracts_needed').val() != ''){
        user_sales_plan();
    }
})

$(document).on('keyup','#add_user_form input',function(){
   user_sales_plan();
})

function user_sales_plan()
{
    //total contract needed calculate
    let user_total_contracts_needed_val = ( parseFloat(user_annual_income_target.val()) / user_average_commission_per_sale.val() )
    user_total_contracts_needed.val( user_total_contracts_needed_val.toFixed(2) );
    //total annual needed calculate
    let user_total_annual_sales_needed_val = ( user_total_contracts_needed_val * parseFloat(user_revenue_per_sale_amount.val()) )
    user_total_annual_sales_needed.val(user_total_annual_sales_needed_val.toFixed(2));

    //annual KPI Targets

    //Sale Value Calculate
    var user_annual_sales_value = ( user_total_annual_sales_needed_val / parseFloat(user_revenue_per_sale_amount.val()) );
    user_annual_sales.val(user_annual_sales_value.toFixed(2));

    //Sales Opportunities Calculate
    var user_annual_sales_opportunities_val = (user_annual_sales_value * 100) / parseFloat(user_contract_close_rate.val());
    user_annual_sales_opportunities.val(user_annual_sales_opportunities_val.toFixed(2));

    //approved calculate
    var user_annual_approved_val = (user_annual_sales_value * 100) / parseFloat(user_buy_rate.val());
    user_annual_approved.val(user_annual_approved_val.toFixed(2));

    //Pre-Qualified calculate
    var user_annual_pre_qualified_val = ( ((user_annual_approved_val * 100) / parseFloat(user_file_rate.val()) ) * parseFloat(user_lost_rate.val()) ) / 100;
        user_annual_pre_qualified_val = user_annual_pre_qualified_val + ((user_annual_approved_val * 100) / parseFloat(user_file_rate.val()) );
    user_annual_pre_qualified.val(user_annual_pre_qualified_val.toFixed(2));

    //•	Lost Opportunities calculate
    var user_annual_lost_opportunity_val = ( ( (user_annual_approved_val * 100 ) / parseFloat(user_file_rate.val()) ) * parseFloat(user_lost_rate.val()) ) / 100;
    user_annual_lost_opportunity.val( user_annual_lost_opportunity_val.toFixed(2) );

    //•	Not Approved calculate
    var user_annual_not_approved_val = ( user_annual_pre_qualified_val * parseFloat(user_denied_rate.val()) ) / 100;
    user_annual_not_approved.val( user_annual_not_approved_val.toFixed(2) );

    //•	Prospects calculate
    var user_annual_prospects_val = ( user_annual_pre_qualified_val / parseFloat(user_damage_rate.val()) ) * 100;
    user_annual_prospects.val(user_annual_prospects_val.toFixed(2));

    //leads calculate
    var user_annual_leads_val = ( user_annual_prospects_val / parseFloat(user_damage_rate.val()) ) * 100;
    user_annual_leads.val( user_annual_leads_val.toFixed(2) );

    //not_qualified calculate
    var user_annual_not_qualified_val = ( user_annual_leads_val * parseFloat(user_no_damage_rate.val()) ) / 100;
    user_annual_not_qualified.val( user_annual_not_qualified_val.toFixed(2) );

    //contact calculate
    var user_annual_contact_val = ( user_annual_leads_val / parseFloat(user_inspection_close_rate.val()) ) * 100;
    user_annual_contact.val( user_annual_contact_val.toFixed(2) );

    //attempts calculate
    var user_annual_attempts_val = ( user_annual_contact_val / parseFloat( user_reach_rate.val() ) ) * 100
    user_annual_attempts.val( user_annual_attempts_val.toFixed(2) );

    //monthly KPI Targets

    //attempts
    var user_monthly_attempts_val = ( user_annual_attempts_val / user_total_work_month_left_to_sell.val() )
    user_monthly_attempts.val( user_monthly_attempts_val.toFixed(2) );

    //contacts
    var user_monthly_contact_val = ( user_annual_contact_val /  user_total_work_month_left_to_sell.val() )
    user_monthly_contact.val( user_monthly_contact_val.toFixed(2) );

    //leads
    var user_monthly_leads_val = ( user_annual_leads_val / user_total_work_month_left_to_sell.val() );
    user_monthly_leads.val(user_monthly_leads_val.toFixed(2));

    //prospect
    var user_monthly_prospect_val = ( user_annual_prospects_val / user_total_work_month_left_to_sell.val() );
    user_monthly_prospects.val( user_monthly_prospect_val.toFixed(2) );

    //not qualified
    var user_monthly_not_qualified_val = ( user_annual_not_qualified_val / user_total_work_month_left_to_sell.val() );
    user_monthly_not_qualified.val( user_monthly_not_qualified_val.toFixed(2) );

    //pre qualified
    var user_monthly_pre_qualified_val = ( user_annual_pre_qualified_val / user_total_work_month_left_to_sell.val() )
    user_monthly_pre_qualified.val( user_monthly_pre_qualified_val.toFixed(2) );

    // approved
    var user_monthly_approved_val = ( user_annual_approved_val / user_total_work_month_left_to_sell.val() )
    user_monthly_approved.val( user_monthly_approved_val.toFixed(2) );

    //not approved
    var user_monthly_not_approved_val = ( user_annual_not_approved_val / user_total_work_month_left_to_sell.val() );
    user_monthly_not_approved.val(user_monthly_not_approved_val.toFixed(2));

    //lost opportunities
    var user_monthly_lost_opportunities_val = ( user_annual_lost_opportunity_val / user_total_work_month_left_to_sell.val() )
    user_monthly_lost_opportunity.val(user_monthly_lost_opportunities_val.toFixed(2));

    //sale
    var user_monthly_sales_val = ( user_annual_sales_value / user_total_work_month_left_to_sell.val() );
    user_monthly_sales.val( user_monthly_sales_val.toFixed(2) )

    //sale opportunities
    var user_monthly_sales_opportunities_val = ( ( user_monthly_sales_val / parseFloat(user_contract_close_rate.val()) ) * 100 )
    user_monthly_sales_opportunities.val( user_monthly_sales_opportunities_val.toFixed(2) );

    //weekly kpi target

    //attempts
    var user_weekly_attempts_val = ( user_annual_attempts_val / user_total_work_week_left_to_sell.val() )
    user_weekly_attempts.val( user_weekly_attempts_val.toFixed(2) );

    //contacts
    var user_weekly_contact_val = ( user_annual_contact_val /  user_total_work_week_left_to_sell.val() )
    user_weekly_contact.val( user_weekly_contact_val.toFixed(2) );

    //leads
    var user_weekly_leads_val = ( user_annual_leads_val / user_total_work_week_left_to_sell.val() );
    user_weekly_leads.val(user_weekly_leads_val.toFixed(2));

    //prospect
    var user_weekly_prospect_val = ( user_annual_prospects_val / user_total_work_week_left_to_sell.val() );
    user_weekly_prospects.val( user_weekly_prospect_val.toFixed(2) );

    //not qualified
    var user_weekly_not_qualified_val = ( user_annual_not_qualified_val / user_total_work_week_left_to_sell.val() );
    user_weekly_not_qualified.val( user_weekly_not_qualified_val.toFixed(2) );

    //pre qualified
    var user_weekly_pre_qualified_val = ( user_annual_pre_qualified_val / user_total_work_week_left_to_sell.val() )
    user_weekly_pre_qualified.val( user_weekly_pre_qualified_val.toFixed(2) );

    // approved
    var user_weekly_approved_val = ( user_annual_approved_val / user_total_work_week_left_to_sell.val() )
    user_weekly_approved.val( user_weekly_approved_val.toFixed(2) );

    //not approved
    var user_weekly_not_approved_val = ( user_annual_not_approved_val / user_total_work_week_left_to_sell.val() );
    user_weekly_not_approved.val(user_weekly_not_approved_val.toFixed(2));

    //lost opportunities
    var user_weekly_lost_opportunities_val = ( user_annual_lost_opportunity_val / user_total_work_week_left_to_sell.val() )
    user_weekly_lost_opportunity.val(user_weekly_lost_opportunities_val.toFixed(2));

    //sale
    var user_weekly_sales_val = ( user_annual_sales_value / user_total_work_week_left_to_sell.val() );
    user_weekly_sales.val( user_weekly_sales_val.toFixed(2) )

    //sale opportunities
    var user_weekly_sales_opportunities_val = ( ( user_weekly_sales_val / parseFloat(user_contract_close_rate.val()) ) * 100 )
    user_weekly_sales_opportunities.val( user_weekly_sales_opportunities_val.toFixed(2) );
}