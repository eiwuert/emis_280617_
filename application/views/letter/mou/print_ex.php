<meta charset="ISO-8859-1">
<script type="text/javascript">
    $(function(){
  
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
        })

    });

</script>
<style type="text/css">
    table td{
        border-left: 1px solid #eee;
        border-right: 1px solid #eee;
    }
    .table tr td{
        cursor: pointer;
    }
    .class_label{
        width:70px;
    }
    .class_input{
        width:300px;
    }
</style>
<?php 
    header("Content-type: text/excel; charset=utf-8");

    header("Cache-Control: public"); 
    // The function header by sending raw excel
    header("Content-type: application/vnd-ms-excel");
    // header("Content-Type: text/csv; charset=utf-8"); 
    // Defines the name of the export file "codelution-export.xls"
    header("Content-Disposition: attachment; filename=MOU.xls");
?>
<?php 
$headPrint="<table>
                <tr>
                    <td colspan='1' rowspan='3'>
                        <center><img width='9%' src='".base_url('assets/img/logo.png')."'></center>
                    </td>
                    <td colspan='1' class='head_kh1'><center>សាកលវិទ្យាល័យគ្រប់គ្រង និងសេដ្ឋកិច្ច</center></td> 
                </tr>
                <tr>
                    <td colspan='1' class='head_eng1'><center>UNIVERSITY OF MANAGEMENT AND ECONOMICS</center></td> 
                </tr>    
                <tr>
                    <td colspan='1' class='head_eng1' style='text-transform: capitalize'><center><b>MOU</b></center></td> 
                </tr>
            </table>";

$manage_table = "<table>
                    <tr>
                        <th style='float:left'>
                            ".lang('sign_date_mou')."
                        </th>
                        <td style='float:left'>".($detail->sign_date != '0000-00-00' ? date(get_date_format(), strtotime($detail->sign_date)) : '')."</td> 
                    </tr>

                    <tr>
                        <th style='float:left'>
                            ".lang('purpose_mou')."
                        </th>
                        <td style='float:left'>".$detail->purpose."</td> 
                    </tr>

                    <tr>
                        <th style='float:left'>
                            ".lang('orginazation_mou')."
                        </th>
                        <td style='float:left'>".$detail->orginazation."</td> 
                    </tr>

                    <tr>
                        <th style='float:left'>
                            ".lang('valid_date_from_mou')."
                        </th>
                        <td style='float:left'>".($detail->valid_date_from != "0000-00-00" ? date(get_date_format(), strtotime($detail->valid_date_from)) : '')."</td> 
                    </tr>

                    <tr>
                        <th style='float:left'>
                            ".lang('valid_date_to_mou')."
                        </th>
                        <td style='float:left'>".($detail->valid_date_to != "0000-00-00" ? date(get_date_format(), strtotime($detail->valid_date_to)) : '')."</td> 
                    </tr>

                    <tr>
                        <th style='float:left'>
                            ".lang('response_by_mou')."
                        </th>
                        <td style='float:left'>".$detail->user_type."</td> 
                    </tr>                    
                </table>";
echo $headPrint;
echo $manage_table;
?>
