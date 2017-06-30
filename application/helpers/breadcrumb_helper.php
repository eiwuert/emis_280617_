<?php

function create_breadcrumb() {
    $ci = &get_instance();
    $return = '';
    $dashboard_link = '<a href="' . site_url('home') . '"><i class="ace-icon fa fa-home home-icon"></i> ' . lang('common_dashboard') . '</a> <i class="ace-icon fa fa-angle-double-right"></i> ';

    $return.=$dashboard_link;

    if ($ci->uri->segment(1) == 'customers') {
        if ($ci->uri->segment(2) == false) { //Main page
            $customers_home_link = create_current_page_url(lang('module_customers'));
        } else {
            $customers_home_link = '<a href="' . site_url('customers') . '" >' . lang('module_customers') . '</a>';
        }

        $return.=$customers_home_link;

        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('customers_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('customers_update'));
            }
        } elseif ($ci->uri->segment(2) == 'excel_import') {
            $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('customers_import_customers_from_excel'));
        }
    } elseif ($ci->uri->segment(1) == 'consultants') {
        if ($ci->uri->segment(2) == false) { //Main page
            $consultants_home_link = create_current_page_url(lang('module_consultants'));
        } else {
            $consultants_home_link = '<a href="' . site_url('consultants') . '" >' . lang('module_consultants') . '</a>';
        }
        $return.=$consultants_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('cons_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('cons_update'));
            }
        }elseif($ci->uri->segment(2) == 'views'){
             $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('cons_view'));
        }
    } elseif ($ci->uri->segment(1) == 'project_overviews') {
        $project_overviews_home_link = '<a href="' . site_url('project_overviews') . '">' . lang('module_project_overviews') . '</a>';
        $return.=$project_overviews_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('project_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('project_update'));
            }
        } else if($ci->uri->segment(2) == 'before' || $ci->uri->segment(2) == 'before_fee'){
             $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('project_before'));
        } else if($ci->uri->segment(2) == 'during' || $ci->uri->segment(2) == 'design' || $ci->uri->segment(2) == 'delivery' || $ci->uri->segment(2) == 'debrief'){
             $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('project_during'));
        } else if ($ci->uri->segment(2) == 'after'){
             $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('project_after'));
        }
    } elseif ($ci->uri->segment(1) == 'project_managements') {
        $project_managements_home_link = '<a href="' . site_url('project_overviews') . '">' . lang('module_project_overviews') . '</a>';
        $return.=$project_managements_home_link;
        if ($ci->uri->segment(2) == 'after'){
             $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('project_after'));
        }
    } elseif ($ci->uri->segment(1) == 'template_agreement') {
        $templates_agreement_home_link = '<a href="' . site_url('template_agreement') . '">' . lang('ca_ca') . ' ' . lang('module_template_agreement') . '</a>';
        $return.=$templates_agreement_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('template_ca_new'));
            } else {
               $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('template_ca_update')); 
            }
        }
    } elseif ($ci->uri->segment(1) == 'templates') {
        $templates_home_link = '<a href="' . site_url('templates') . '">' . lang('mc_mc') . ' ' . lang('module_templates') . '</a>';
        $return.=$templates_home_link;

        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('templates_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('templates_update'));
            }
        }elseif($ci->uri->segment(2) == 'views'){
             $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('cons_view'));
        }
    } elseif ($ci->uri->segment(1) == 'user_network') {
        if ($ci->uri->segment(2) == false) { //Main page
            $network_home_link = create_current_page_url(lang('module_user_network'));
        } else {
            $network_home_link = '<a href="' . site_url('user_network') . '" >' . lang('module_user_network') . '</a>';
        }
        $return.=$network_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('user_network_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('user_network_update'));
            }
        }
    } elseif ($ci->uri->segment(1) == 'collaboration') {
        if ($ci->uri->segment(2) == false) { //Main page
            $collaboration_home_link = create_current_page_url(lang('module_collaboration'));
        } else {
            $collaboration_home_link = '<a href="' . site_url('collaboration') . '" >' . lang('module_collaboration') . '</a>';
        }
        $return.=$collaboration_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('collaborations_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('collaborations_update'));
            }
        }
    } elseif ($ci->uri->segment(1) == 'items') {
        if ($ci->uri->segment(2) == false) { //Main page
            $items_home_link = create_current_page_url(lang('module_items'));
        } else {
            $items_home_link = '<a href="' . site_url('items') . '">' . lang('module_items') . '</a>';
        }

        $return.=$items_home_link;

        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('items_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('items_update'));
            }
        } elseif ($ci->uri->segment(2) == 'excel_import') {
            $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('common_excel_import'));
        }
    } elseif ($ci->uri->segment(1) == 'item_kits') {
        if ($ci->uri->segment(2) == false) { //Main page
            $item_kits_home_link = ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('module_item_kits'));
        } else {
            $item_kits_home_link = '<a href="' . site_url('item_kits') . '">' . lang('module_item_kits') . '</a>';
        }

        $return.=$item_kits_home_link;

        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('item_kits_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('item_kits_update'));
            }
        }
    } elseif ($ci->uri->segment(1) == 'suppliers') {
        if ($ci->uri->segment(2) == false) { //Main page
            $suppliers_home_link = create_current_page_url(lang('module_suppliers'));
        } else {
            $suppliers_home_link = '<a href="' . site_url('suppliers') . '">' . lang('module_suppliers') . '</a>';
        }

        $return.=$suppliers_home_link;

        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('suppliers_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('suppliers_update'));
            }
        } elseif ($ci->uri->segment(2) == 'excel_import') {
            $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('suppliers_import_suppliers_from_excel'));
        }
    } elseif ($ci->uri->segment(1) == 'reports') {
        if ($ci->uri->segment(2) == false) { //Main page
            $reports_home_link = create_current_page_url(lang('module_reports'));
        } else {
            $reports_home_link = '<a href="' . site_url('reports') . '">' . lang('module_reports') . '</a>';
        }

        $return.=$reports_home_link;

        if ($ci->uri->segment(2) == 'graphical_summary_categories' || $ci->uri->segment(2) == 'summary_categories') {
            $return.=create_report_breadcrumb(lang('reports_categories_summary_report'));
        } elseif ($ci->uri->segment(2) == 'sales_generator') {
            $return.=create_current_page_url(lang('reports_sales_generator'));
        } elseif ($ci->uri->segment(2) == 'graphical_summary_customers' || $ci->uri->segment(2) == 'summary_customers') {
            $return.=create_report_breadcrumb(lang('reports_customers_summary_report'));
        } elseif ($ci->uri->segment(2) == 'specific_customer') {
            $return.=create_report_breadcrumb(lang('reports_detailed_customers_report'));
        } elseif ($ci->uri->segment(2) == 'deleted_sales') {
            $return.=create_report_breadcrumb(lang('reports_deleted_sales_report'));
        }
        if ($ci->uri->segment(2) == 'graphical_summary_discounts' || $ci->uri->segment(2) == 'summary_discounts') {
            $return.=create_report_breadcrumb(lang('reports_discounts_summary_report'));
        } elseif ($ci->uri->segment(2) == 'graphical_summary_employees' || $ci->uri->segment(2) == 'summary_employees') {
            $return.=create_report_breadcrumb(lang('reports_employees_summary_report'));
        } elseif ($ci->uri->segment(2) == 'specific_employee') {
            $return.=create_report_breadcrumb(lang('reports_detailed_employees_report'));
        } elseif ($ci->uri->segment(2) == 'summary_giftcards') {
            $return.=create_report_breadcrumb(lang('reports_giftcard_summary_report'));
        } elseif ($ci->uri->segment(2) == 'detailed_giftcards') {
            $return.=create_report_breadcrumb(lang('reports_detailed_giftcards_report'));
        } elseif ($ci->uri->segment(2) == 'inventory_low') {
            $return.=create_report_breadcrumb(lang('reports_low_inventory_report'));
        } elseif ($ci->uri->segment(2) == 'inventory_summary') {
            $return.=create_report_breadcrumb(lang('reports_inventory_summary'));
        } elseif ($ci->uri->segment(2) == 'graphical_summary_item_kits' || $ci->uri->segment(2) == 'summary_item_kits') {
            $return.=create_report_breadcrumb(lang('reports_item_kits_summary_report'));
        } elseif ($ci->uri->segment(2) == 'graphical_summary_items' || $ci->uri->segment(2) == 'summary_items') {
            $return.=create_report_breadcrumb(lang('reports_items_summary_report'));
        } elseif ($ci->uri->segment(2) == 'graphical_summary_payments' || $ci->uri->segment(2) == 'summary_payments') {
            $return.=create_report_breadcrumb(lang('reports_payments_summary_report'));
        } elseif ($ci->uri->segment(2) == 'summary_profit_and_loss') {
            $return.=create_report_breadcrumb(lang('reports_profit_and_loss'));
        /*} elseif ($ci->uri->segment(2) == 'detailed_profit_and_loss') {
            $return.=create_report_breadcrumb(lang('reports_profit_and_loss'));*/
        } elseif ($ci->uri->segment(2) == 'detailed_receivings') {
            $return.=create_report_breadcrumb(lang('reports_detailed_receivings_report'));
        } elseif ($ci->uri->segment(2) == 'detailed_register_log') {
            $return.=create_report_breadcrumb(lang('reports_register_log_title'));
        } elseif ($ci->uri->segment(2) == 'graphical_summary_sales' || $ci->uri->segment(2) == 'summary_sales') {
            $return.=create_report_breadcrumb(lang('reports_sales_summary_report'));
        } elseif ($ci->uri->segment(2) == 'detailed_sales') {
            $return.=create_report_breadcrumb(lang('reports_detailed_sales_report'));
        } elseif ($ci->uri->segment(2) == 'store_account_statements') {
            $return.=create_report_breadcrumb(lang('reports_store_account_statements'));
        } elseif ($ci->uri->segment(2) == 'summary_store_accounts') {
            $return.=create_report_breadcrumb(lang('reports_store_account_summary_report'));
        } elseif ($ci->uri->segment(2) == 'specific_customer_store_account') {
            $return.=create_report_breadcrumb(lang('reports_detailed_store_accounts_report'));
        } elseif ($ci->uri->segment(2) == 'graphical_summary_suppliers' || $ci->uri->segment(2) == 'summary_suppliers') {
            $return.=create_report_breadcrumb(lang('reports_suppliers_summary_report'));
        } elseif ($ci->uri->segment(2) == 'specific_supplier') {
            $return.=create_report_breadcrumb(lang('reports_detailed_suppliers_report'));
        } elseif ($ci->uri->segment(2) == 'graphical_summary_taxes' || $ci->uri->segment(2) == 'summary_taxes') {
            $return.=create_report_breadcrumb(lang('reports_taxes_summary_report'));
        } elseif ($ci->uri->segment(2) == 'detailed_suspended_sales') {
            $return.=create_report_breadcrumb(lang('reports_detailed_suspended_sales_report'));
        } elseif ($ci->uri->segment(2) == 'detailed_payments') {
            $return.=create_report_breadcrumb(lang('reports_detailed_payments_report'));
        } elseif ($ci->uri->segment(2) == 'graphical_summary_commissions' || $ci->uri->segment(2) == 'summary_commissions') {
            $return.=create_report_breadcrumb(lang('reports_summary_commission_report'));
        } elseif ($ci->uri->segment(2) == 'detailed_commissions') {
            $return.=create_report_breadcrumb(lang('reports_detailed_commission_report'));
        } elseif ($ci->uri->segment(2) == 'detailed_inventory') {
            $return.=create_report_breadcrumb(lang('reports_detailed_inventory_report'));
        } elseif ($ci->uri->segment(2) == 'summary_proposal') {
            $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_report_breadcrumb(lang('reports_proposal_summary_report'));
        } elseif ($ci->uri->segment(2) == 'summary_expense') {
            $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_report_breadcrumb(lang('reports_expense_summary_report'));
        } elseif ($ci->uri->segment(2) == 'summary_claim') {
            $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_report_breadcrumb(lang('reports_claim_summary_report'));
        } elseif ($ci->uri->segment(2) == 'detailed_profit_and_loss') {
            $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_report_breadcrumb(lang('reports_profit_and_loss'));
        } elseif ($ci->uri->segment(2) == 'graphic_profit_and_loss') {
            $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_report_breadcrumb(lang('reports_graphic_profit_and_loss'));
        }
    } elseif ($ci->uri->segment(1) == 'employees') {
        if ($ci->uri->segment(2) == false) { //Main page
            $employees_home_link = create_current_page_url(lang('module_employees'));
        } else {
            $employees_home_link = '<a href="' . site_url('employees') . '">' . lang('module_employees') . '</a>';
        }

        $return.=$employees_home_link;


        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('employees_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('employees_update'));
            }
        }
    } elseif ($ci->uri->segment(1) == 'giftcards') {
        if ($ci->uri->segment(2) == false) { //Main page
            $giftcards_home_link = create_current_page_url(lang('module_giftcards'));
        } else {
            $giftcards_home_link = '<a href="' . site_url('giftcards') . '">' . lang('module_giftcards') . '</a>';
        }

        $return.=$giftcards_home_link;


        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('giftcards_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('giftcards_update'));
            }
        }
    } elseif ($ci->uri->segment(1) == 'config') {

        if ($ci->uri->segment(2) == false) { //Main page
            $config_home_link = create_current_page_url(lang('module_config'));
        } else {
            $config_home_link = '<a href="' . site_url('config') . '">' . lang('module_config') . '</a>';
        }

        $return.=$config_home_link;


        if ($ci->uri->segment(2) == 'backup') {
            $return.=create_current_page_url(lang('config_backup_overview'));
        }
    } elseif ($ci->uri->segment(1) == 'locations') {
        if ($ci->uri->segment(2) == false) { //Main page
            $locations_home_link = create_current_page_url(lang('module_locations'));
        } else {
            $locations_home_link = '<a href="' . site_url('locations') . '">' . lang('module_locations') . '</a>';
        }

        $return.=$locations_home_link;


        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('locations_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('locations_update'));
            }
        }
    } elseif ($ci->uri->segment(1) == 'sales') {
        $sales_home_link = '<a href="' . site_url('sales') . '">' . lang('module_sales') . '</a>';
        $return.=$sales_home_link;
        if ($ci->uri->segment(2) == 'suspended') {
            $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('sales_suspended_sales'));
        }

        if ($ci->uri->segment(2) == 'batch_sale') {
            $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('batch_sale'));
        }
    } elseif ($ci->uri->segment(1) == 'receivings') {
        $sales_home_link = '<a href="' . site_url('receivings') . '">' . lang('module_receivings') . '</a>';
        $return.=$sales_home_link;
        if ($ci->uri->segment(2) == 'suspended') {
            $return.=create_current_page_url(lang('receivings_suspended_receivings'));
        }

        if ($ci->uri->segment(2) == 'batch_receiving') {
            $return.=create_current_page_url(lang('batch_receivings'));
        }
    } elseif ($ci->uri->segment(1) == 'checklist_template') {
        $checklist_template_home_link = '<a href="' . site_url('checklist_template') . '">' . lang('module_checklist_template') . '</a>';
        $return.=$checklist_template_home_link;
        if ($ci->uri->segment(2) == 'create') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('checklist_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('checklist_update'));
            }
        } elseif ($ci->uri->segment(2) == 'view'){
            $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('checklist_update'));
        } elseif ($ci->uri->segment(2) == 'detail'){
            $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('checklist_detail'));
        }
    } elseif ($ci->uri->segment(1) == 'meeting') {
        $meeting_home_link = '<a href="' . site_url('meeting') . '">' . lang('module_meeting') . '</a>';
        $return.=$meeting_home_link;
        if ($ci->uri->segment(2) == 'create') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('meeting_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('meeting_update'));
            }
        } elseif ($ci->uri->segment(2) == 'view'){
            $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('meeting_view'));
        } elseif ($ci->uri->segment(2) == 'create_step2'){
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('meeting_new_step_2'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('meeting_update_step_2'));
            }
        } elseif ($ci->uri->segment(2) == 'edit'){
            if ($ci->uri->segment(3) != -1) {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('meeting_edit'));
            }
        } elseif ($ci->uri->segment(2) == 'consideration'){
            if ($ci->uri->segment(3) != -1) {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('meeting_consideration'));
            }
        }
    } elseif ($ci->uri->segment(1) == 'proposals') {
        $proposals_home_link = '<a href="' . site_url('proposals') . '">' . lang('module_proposals') . '</a>';
        $return.=$proposals_home_link;
        if ($ci->uri->segment(2) == 'create') {
            $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_proposal_breadcrumb(lang('proposal_step_one'));
        } elseif ($ci->uri->segment(2) == 'create_step2'){
            $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_proposal_breadcrumb(lang('proposal_step_two'));
        } elseif ($ci->uri->segment(2) == 'create_step3'){
            $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_proposal_breadcrumb(lang('proposal_step_three'));
        } elseif ($ci->uri->segment(2) == 'create_step4'){
            $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_proposal_breadcrumb(lang('proposal_step_four'));
        } elseif ($ci->uri->segment(2) == 'view'){
            $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('proposal_view'));
        }
    } elseif ($ci->uri->segment(1) == 'project_invoice') {
        $project_invoice_home_link = '<a href="' . site_url('project_invoice') . '">' . lang('module_pro_invoice') . '</a>';
        $return.=$project_invoice_home_link;
        if ($ci->uri->segment(2) == 'create') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('invoices_new'));
            }
        } elseif ($ci->uri->segment(2) == 'update'){
            $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('invoices_update'));
        }
    } elseif ($ci->uri->segment(1) == 'master_contracts') {
        $master_contracts_home_link = '<a href="' . site_url('master_contracts') . '">' . lang('module_master_contracts') . '</a>';
        $return.=$master_contracts_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('mc_new'));
            } else {
               $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('mc_update')); 
            }
        }
    } elseif ($ci->uri->segment(1) == 'master_track') {
        $master_track_home_link = '<a href="' . site_url('master_track') . '">'  . lang('mc_mc') . ' ' . lang('module_master_track') . '</a>';
        $return.=$master_track_home_link;
    } elseif ($ci->uri->segment(1) == 'collaboration_agreements') {
        $collaboration_agreements_home_link = '<a href="' . site_url('collaboration_agreements') . '">' . lang('module_collaboration_agreements') . '</a>';
        $return.=$collaboration_agreements_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('ca_new'));
            } else {
               $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('ca_update')); 
            }
        }
    } elseif ($ci->uri->segment(1) == 'ca_tracks') {
        $ca_tracks_home_link = '<a href="' . site_url('ca_tracks') . '">' . lang('ca_ca') . ' ' . lang('module_ca_tracks') . '</a>';
        $return.=$ca_tracks_home_link;
    } elseif ($ci->uri->segment(1) == 'template_consultant_project_agreements') {
        $tcp_agreements_home_link = '<a href="' . site_url('template_consultant_project_agreements') . '">' . lang('template_consultant_project_agreements_pac') . ' ' . lang('module_template_consultant_project_agreements') . '</a>';
        $return.=$tcp_agreements_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('template_consultant_project_agreements_new'));
            } else {
               $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('template_consultant_project_agreements_update')); 
            }
        }
    } elseif ($ci->uri->segment(1) == 'consultant_project_agreements') {
        $cp_agreements_home_link = '<a href="' . site_url('consultant_project_agreements') . '">' . lang('module_consultant_project_agreements') . '</a>';
        $return.=$cp_agreements_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('consultants_pa_new'));
            } else {
               $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('consultants_pa_update')); 
            }
        }
    } elseif ($ci->uri->segment(1) == 'pa_consultant_tracks') {
        $pa_consultant_tracks_home_link = '<a href="' . site_url('pa_consultant_tracks') . '">' . lang('template_consultant_project_agreements_pac') . ' ' . lang('module_pa_consultant_tracks') . '</a>';
        $return.=$pa_consultant_tracks_home_link;
    } elseif ($ci->uri->segment(1) == 'template_collaborations_project_agreements') {
        $cp_agreements_home_link = '<a href="' . site_url('template_collaborations_project_agreements') . '">' . lang('template_collaboration_project_agreements_pac') . ' ' . lang('module_template_collaborations_project_agreements') . '</a>';
        $return.=$cp_agreements_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('template_collaboration_project_agreements_new'));
            } else {
               $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('template_collaboration_project_agreements_update')); 
            }
        }
    } elseif ($ci->uri->segment(1) == 'collaborations_project_agreements') {
        $cp_agreements_home_link = '<a href="' . site_url('collaborations_project_agreements') . '">' . lang('module_collaborations_project_agreements') . '</a>';
        $return.=$cp_agreements_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('template_collaboration_project_agreements_new'));
            } else {
               $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('template_collaboration_project_agreements_update')); 
            }
        }
    } elseif ($ci->uri->segment(1) == 'pa_collaborations_tracks') {
        $pa_collaborations_tracks_home_link = '<a href="' . site_url('pa_collaborations_tracks') . '">' . lang('template_collaboration_project_agreements_pac') . ' ' . lang('module_pa_collaborations_tracks') . '</a>';
        $return.=$pa_collaborations_tracks_home_link;
    } elseif ($ci->uri->segment(1) == 'pa_clients') {
        $pa_clients_home_link = '<a href="' . site_url('pa_clients') . '">' . lang('module_pa_clients') . '</a>';
        $return.=$pa_clients_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('loa_new'));
            } else {
               $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('loa_update')); 
            }
        }
    } elseif ($ci->uri->segment(1) == 'template_clients') {
        $template_clients_home_link = '<a href="' . site_url('template_clients') . '">' . lang('loa_loa') . ' ' . lang('module_template_clients') . '</a>';
        $return.=$template_clients_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('loa_new'));
            } else {
               $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('loa_update')); 
            }
        }
    } elseif ($ci->uri->segment(1) == 'project_claim') {
        $project_claim_home_link = '<a href="' . site_url('project_claim') . '">' . lang('module_project_claim') . '</a>';
        $return.=$project_claim_home_link;
        if ($ci->uri->segment(2) == 'create') {
            if ($ci->uri->segment(3) == FALSE or $ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('project_claim_new_claim'));
            } else {
               $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('project_claim_edit')); 
            }
        } elseif ($ci->uri->segment(2) == 'view') {
            $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('project_claim_view'));
        }
    } elseif ($ci->uri->segment(1) == 'project_expense') {
        $project_expense_home_link = '<a href="' . site_url('project_expense') . '">' . lang('module_project_expense') . '</a>';
        $return.=$project_expense_home_link;
        if ($ci->uri->segment(2) == 'create') {
            if ($ci->uri->segment(3) == FALSE or $ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('project_expense_new_expense'));
            } else {
               $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('project_expense_edit')); 
            }
        } elseif ($ci->uri->segment(2) == 'view') {
            $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('project_expense_view'));
        }
    } elseif ($ci->uri->segment(1) == 'partnership_search_list') {
        $partnership_search_list_home_link = '<a href="' . site_url('partnership_search_list') . '">' . lang('module_partnership_search_list') . '</a>';
        $return.=$partnership_search_list_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('caes_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('caes_update'));
            }
        }
    } elseif ($ci->uri->segment(1) == 'partnership_search_template') {
        $partnership_search_template_home_link = '<a href="' . site_url('partnership_search_template') . '">' . lang('caes_caes') . ' ' . lang('module_partnership_search_template') . '</a>';
        $return.=$partnership_search_template_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('caes_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('caes_update'));
            }
        }
    } elseif ($ci->uri->segment(1) == 'executive_search_list') {
        $executive_search_list_home_link = '<a href="' . site_url('executive_search_list') . '">' . lang('module_executive_search_list') . '</a>';
        $return.=$executive_search_list_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('caes_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('caes_update'));
            }
        }
    } elseif ($ci->uri->segment(1) == 'executive_search_template') {
        $executive_search_template_home_link = '<a href="' . site_url('executive_search_template') . '">' . lang('caes_es') . ' ' . lang('module_executive_search_template') . '</a>';
        $return.=$executive_search_template_home_link;
        if ($ci->uri->segment(2) == 'view') {
            if ($ci->uri->segment(3) == -1) {
                $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('caes_new'));
            } else {
                $return.=' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('caes_update'));
            }
        }
    } elseif ($ci->uri->segment(1) == 'executive_search_track') {
        $executive_search_track_home_link = '<a href="' . site_url('executive_search_track') . '">' . lang('caes_es') . ' ' . lang('module_executive_search_track') . '</a>';
        $return.=$executive_search_track_home_link;
    } elseif ($ci->uri->segment(1) == 'partnership_search_track') {
        $partnership_search_track_home_link = '<a href="' . site_url('partnership_search_track') . '">' . lang('caes_caes') . ' ' . lang('module_partnership_search_track') . '</a>';
        $return.=$partnership_search_track_home_link;
    } elseif ($ci->uri->segment(1) == 'recruitment') {
        $recruitment_home_link = '<a href="' . site_url('recruitment') . '">' . lang('module_recruitment') . '</a>';
        $return.=$recruitment_home_link;
    } elseif ($ci->uri->segment(1) == 'project_feedback') {
        $project_feedback_home_link = '<a href="' . site_url('project_feedback') . '">' . lang('module_project_feedback') . '</a>';
        $return.=$project_feedback_home_link;
        if ($ci->uri->segment(2) == 'view') {
            $return.= ' <i class="ace-icon fa fa-angle-right"></i> ' . create_current_page_url(lang('project_view'));
        }
    } elseif ($ci->uri->segment(1) == 'pa_client_tracks') {
        $pa_client_tracks_home_link = '<a href="' . site_url('pa_client_tracks') . '">' . lang('loa_loa') . ' ' . lang('module_pa_client_tracks') . '</a>';
        $return.=$pa_client_tracks_home_link;
    }

    return $return;
}

function create_current_page_url($link_text) {
    return '<a  class="current" href="' . current_url() . '">' . $link_text . '</a>';
}

function create_report_breadcrumb($report_name) {
    $ci = &get_instance();

    $return = '';
    if ($ci->uri->segment(3) === FALSE) { // Input page
        $return.=create_current_page_url(lang('reports_report_input') . ': ' . $report_name);
    } else {
        $return.= '<a href="' . site_url('reports/' . $ci->uri->segment(2)) . '">' . lang('reports_report_input') . ': ' . $report_name . '</a> <i class="ace-icon fa fa-angle-right"></i> ' ;
        $return.= create_current_page_url($report_name);
    }

    return $return;
}

function create_proposal_breadcrumb($step_name) {
    $ci = &get_instance();

    $return = '';
    if ($ci->uri->segment(3) === FALSE) { // Input page
        $return.=create_current_page_url(lang('proposal_new') . ': ' . $step_name);
    } else {
        if ($ci->uri->segment(3) == -1) {
            $return.= '<a href="' . site_url('proposals/' . $ci->uri->segment(2)) . '/' . $ci->uri->segment(3) .'">' . lang('proposal_new') . ': ' . $step_name . '</a>' ;
        } else {
            $return.= '<a href="' . site_url('proposals/' . $ci->uri->segment(2)) . '">' . lang('proposal_update') . ': ' . $step_name . '</a>' ;
        }
    }

    return $return;
}

?>