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
header("Content-Disposition: attachment; filename=Student Report -".date("Y-m-d H:i:s").".xls");

$headPrint="<table>
                <tr>
                    <td colspan='1' rowspan='10' height='45'>
                        <center><img width='7%' src='".base_url('assets/img/logo.png')."'></center>
                    </td>
                    <td colspan='4' class='head_kh1'><center>សាកលវិទ្យាល័យគ្រប់គ្រង និងសេដ្ឋកិច្ច</center></td> 
                </tr>
                <tr>
                    <td colspan='4' class='head_eng1'><center>UNIVERSITY OF MANAGEMENT AND ECONOMICS</center></td> 
                </tr>    
                <tr>
                    <td colspan='4' class='head_eng1' style='text-transform: capitalize'><center><b>".$mainTitle."</b></center></td> 
                </tr>   
                <tr>
                    <td colspan='4' class='head_eng1' style='text-transform: capitalize'><center><b>Major: ".$main_title_skill."</b></center></td> 
                </tr>   
                <tr>
                    <td colspan='4' class='head_eng1' style='text-transform: capitalize'><center><b>University: ".$main_title_university."</b></center></td> 
                </tr>   
                <tr>
                    <td colspan='4' class='head_eng1' style='text-transform: capitalize'><center><b>Academic Year: ".$main_title_academic_year."</b></center></td> 
                </tr>
                <tr>
                    <td colspan='4' class='head_eng1' style='text-transform: capitalize'><center><b>Scholarship From: ".$main_title_scholarship."</b></center></td> 
                </tr>     
                <tr>
                    <td colspan='4' class='head_eng1' style='text-transform: capitalize'><center><b>Class: ".$main_title_class."</b></center></td> 
                </tr>
                <tr>
                    <td colspan='4' class='head_eng1' style='text-transform: capitalize'><center><b>Room: ".$main_title_room."</b></center></td> 
                </tr>
                <tr>
                    <td colspan='4' class='head_eng1' style='text-transform: capitalize'><center><b>Date: ".$main_title_date."</b></center></td> 
                </tr>
            </table>";
echo $headPrint;
echo $manage_table;
