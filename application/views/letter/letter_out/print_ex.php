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
    header("Content-Disposition: attachment; filename=Letter OUT.xls");
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
                        <th style='text-align:left'>
                            ".lang('send_out_date')."
                        </th>
                        <td style='text-align:left'>".$detail->send_out_date."</td> 
                    </tr>

                    <tr>
                        <th style='text-align:left'>
                            ".lang('send_to')."
                        </th>
                        <td style='text-align:left'>".$detail->send_to."</td> 
                    </tr>

                    <tr>
                        <th style='text-align:left'>
                            ".lang('organization')."
                        </th>
                        <td style='text-align:left'>".$detail->organization."</td> 
                    </tr>

                    <tr>
                        <th style='text-align:left'>
                            ".lang('purpose')."
                        </th>
                        <td style='text-align:left'>".$detail->purpose."</td> 
                    </tr>
                    <tr>
                        <th style='text-align:left'>
                            ".lang('send_by')."
                        </th>
                        <td style='text-align:left'>".$detail->user_type."</td> 
                    </tr>
                </table>";
echo $headPrint;
echo $manage_table;
?>
