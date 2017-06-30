<meta charset="utf-8" />

<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js" > </script>
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Transcription</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>
<script type="text/javascript">
   // jQuery(document).ready(function($) {
   //    if (window.history && window.history.pushState) {

   //      window.history.pushState('forward', null, null);

   //      $(window).on('popstate', function() {
   //          window.location.href = "<?php echo site_url('score')?>";
   //      });

   //    }
   //  });
</script>

<input type="button" value="Print Div" onclick="PrintElem('#mydiv')" />

<div id="mydiv">
    <style type="text/css">
            body {
              background: rgb(204,204,204); 
            }
            page {
              background: white;
              display: block;
              margin: 0 auto;
              margin-bottom: 0.5cm;
              box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
            }           
            page[size="A4"]{
              width: 21cm;
              height: 29.7cm;  
            }
            @media print {
              body, page {
                margin: 0;
                box-shadow: 0;
              }
            }
            @font-face {
                font-family: khmerOsMollight;
                src: url(../../assets/img/fonts/KhmerOSmuollight.ttf);
            }
            @font-face {
                font-family: time_new_romen;
                src: url(../../assets/img/fonts/times.ttf);
            }           
            @font-face {
                font-family: khmerOScontent;
                src: url(../../assets/img/fonts/KhmerOScontent.ttf);
            } 
        /*++++++++ start body transcript++++*/      

        .body_form{
            width: 765px;
            float: left;
            overflow: auto;
            margin: 14px 0px 0px 15px;
        }
        .subj_header{
            width:100%;
            overflow: auto;
        }
        .logo{
            width: 550px;
            height: 108px;
            margin: 30px 0px 16px 117px;
            left: 93px;
            float: left;
        }
        .subj_nation{
            float:left;
            width:342px;
            height:23px;
            margin-top: 32px;
            font-weight: bold;
        }

        .head_kh1{             
            font-size: 20px;
            font-family: khmerOsMollight;
            letter-spacing: 1px;
            text-align: center;
        }
        .subj_university{
            width: 365px;
            height: px;
            float: left;
            margin-left: 23px;
            margin-bottom: 22px;
        }

        .head_kh11{
            float: left;             
            font-size: 16px;   
            font-family: khmerOsMollight;
            letter-spacing: 1px;
        }
        .head_eng11{ 
            float: left;
            font-size: 12px;
            letter-spacing: 1px;
            font-weight: bold;
        }
        .head_center{
            width: 750px;
            float: left;
            text-align: center;
            color: #000000;
        }
        /* user form */
        .user_receipt{
            width:100%;
            overflow:auto;
        }
        .tblist{
            border-collapse: collapse;
            border-spacing: 0;
            background-color: transparent;
            font-family: arial;
            font-size: 11px;
            margin-top:5px;
            text-align: center;
        }
        .tblist tr th{
            text-align: center;
            padding:5px 0px;
            border:solid 1px black;
        }        
        .tblist tr td{
            font-size: 10px;
            padding:0px 0px;
            border:solid 1px black;
        }
        .uppercase{text-transform: uppercase;}
       
        .list_table{
            padding:0px;
            margin:0px;
        }
        .list_table li{
            list-style: none;
            display: inline-block;
            border-bottom: solid 1px;
            width: 100%;
            line-height: 24px;
            margin-bottom: -1px;
        }
        .footer_right{    
            width: 324px;
            min-height: 80px;
            text-align:center;
            line-height: 40px;
            float:right;
        }

        .footer_left{    
            width: 360px;
            min-height: 80px;
            text-align:center;
            line-height: 40px;
            float:left;
            margin-top: 70px;
        }
    </style>


    <page size="A4">
        <div class="body_form">
        <!-- center -->
            <div class="subj_header">
                <div class='logo'>
                    <img width="104" style="float:left" src="<?php echo base_url('assets/img/logo.png')?>">
                    <div class="subj_nation">
                        <div class="head_kh1">ព្រះរាជាណាចក្រកម្ពុជា</div>
                        <div class="head_kh1">ជាតិ សាសនា ព្រះមហាក្សត្រ</div>
                    </div>
                </div>
            </div>
            <div class="subj_university">
                <div class="head_kh11">សាកលវិទ្យាល័យគ្រប់គ្រង និងសេដ្ឋកិច្ច</div>
                <div class="head_eng11">UNIVERSITY OF MANAGEMENT AND ECONOMICS</div>
            </div>

            <div>
                <div class="head_center">
                    FORM OF TRANSCRIPT RECORD<br/>
                    Bachelor of Business Administration and Tourism<br/>
                    Major: <?=$major_name?>
                </div>
            </div>

            <div class="user_receipt">
                <table class="tblist"cellspacing="0" width="100%">
                    <tr>
                        <th rowspan="2" style="width: 71px;">Year</th>
                        <th style="width: 220px;">First Semester</th>
                        <th rowspan="2" style="width: 123px;">Credit</th>
                        <th style="width: 220px;">Second Semester</th>
                        <th rowspan="2" style="width: 124px;">Credit</th>
                    </tr>
                    <tr>
                        <th>Subjects</th>
                        <th>Subjects</th>
                    </tr>
                    <? if($subject_year->num_rows > 0): ?>
                    <?  $i ='';
                        $sort = '';?>
                    <? foreach($subject_year->result() as $row): ?>
                    <? $i++ ?>
                    
                    <? $major_id = $row->major_id ?>
                    <? $level_year = $row->level_year ?>
                    <? $semester1 = 1?>
                    <? $semester2 = 2?>
                    <? $subject_select = $this->Subject->get_subject($major_id, $level_year, $semester1); ?>
                    <? $subject_select2 = $this->Subject->get_subject($major_id, $level_year, $semester2); ?>
                    <? $count_null1 = (($subject_select->num_rows() > 0)? $subject_select->num_rows() : 0 );?>
                    <? $count_null2 = (($subject_select2->num_rows() > 0)? $subject_select2->num_rows() : 0 );?>
                    <? $get_row = '';?>
                    <? if($count_null1 < $count_null2){
                        $get_row1 = ($count_null2 - $count_null1);
                    }else{
                        $get_row1 = '';
                    }?>
                    <? if($count_null1 > $count_null2){
                        $get_row2 = ($count_null1 - $count_null2);
                    }else{
                        $get_row2 = '';
                    }?>
                    <tr>
                        <td width="70"><?=$level_year?></td>
                        <td colspan="2" width="280">
                            <ul class="list_table" style="float:left;width: 100%;">                                
                                <? if($subject_select->num_rows() > 0): ?>
                                    <? foreach($subject_select->result() as $row1): ?>
                                        <li>
                                            <div style="width:220px; float:left; border-right:1px solid black;">
                                                <?=$row1->subject_name?>
                                            </div>
                                            <div style="width:123px; float:left;">
                                                <?=$row1->subject_credit?>
                                            </div>
                                        </li>
                                    <? endforeach ?>                                    
                                    <? if(!empty($get_row1)): ?>
                                        <? for ($i=0; $i < $get_row1; $i++): ?>
                                            <li>
                                                <div style="width:220px; float:left; border-right:1px solid black;">&nbsp;</div>
                                                <div style="width:123px; float:left;">&nbsp;</div>
                                            </li>
                                        <? endfor ?>
                                    <? endif ?>     
                                <? endif ?>
                            </ul>
                        </td>

                        <td colspan="2" width="280">
                            <ul class="list_table" style="float:left;width: 100%;">
                                <? if($subject_select2->num_rows() > 0): ?>
                                    <? foreach($subject_select2->result() as $row2): ?>
                                        <li>
                                            <div style="width:220px; float:left; border-right:1px solid black;">
                                                <?=$row2->subject_name?>
                                            </div>
                                            <div style="width:123px; float:left;">
                                                <?=$row2->subject_credit?>
                                            </div>
                                        </li>
                                    <? endforeach ?>
                                    <? if(!empty($get_row2)): ?>
                                        <? for ($i=0; $i < $get_row2; $i++): ?>
                                            <li>
                                                <div style="width:220px; float:left; border-right:1px solid black;">&nbsp;</div>
                                                <div style="width:123px; float:left;">&nbsp;</div>
                                            </li>
                                        <? endfor ?>
                                    <? endif ?>
                                <? endif ?>
                            </ul>
                        </td>                        
                    </tr>
                    <? endforeach ?>
                    <? endif ?> 
                </table>
                <!-- ================================================= -->
                <div class="footer_right">
                    <div style="float:left">Academic, Date</div> <div style="float:left">..............</div> <div style="float:left">/</div> <div style="float:left">..............</div> <div style="float:left">/</div> <div style="float:left">..............</div>
                    <br/>
                    <b>Head of BA Department</b>
                </div>
                <div class="footer_left">
                    <div>Seen and Approved</div>
                    <div style="float:left">Banteay Meanchey, Date </div> <div style="float:left">..............</div> <div style="float:left">/</div> <div style="float:left">..............</div> <div style="float:left">/</div> <div style="float:left">..............</div>
                    <br/>
                    <b>Director</b>
                </div>
            </div>
        <!-- end center -->
        </div>      
    </page>

</div>














