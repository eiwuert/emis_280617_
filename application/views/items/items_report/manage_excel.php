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
header("Content-Disposition: attachment; filename=codelution-export.xls");


$headPrint="<table>
                <tr>
                    <td colspan='2' rowspan='3'>
                        <center><img width='9%' src='".base_url('assets/img/logo.png')."'></center>
                    </td>
                    <td colspan='5' class='head_kh1'><center>សាកលវិទ្យាល័យគ្រប់គ្រង និងសេដ្ឋកិច្ច</center></td> 
                </tr>
                <tr>
                    <td colspan='5' class='head_eng1'><center>UNIVERSITY OF MANAGEMENT AND ECONOMICS</center></td> 
                </tr>    
                <tr>
                    <td colspan='5' class='head_eng1' style='text-transform: capitalize'><center><b>".$mainTitle."</b></center></td> 
                </tr>
            </table>";
echo $headPrint;
echo $manage_table;

