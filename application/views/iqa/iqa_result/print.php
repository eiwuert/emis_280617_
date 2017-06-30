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
    function goBack() {
        window.location.hash = window.location.lasthash[window.location.lasthash.length-1];
        window.location.href = "<?php echo site_url('score')?>";
        window.location.lasthash.pop();
    }
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
            page[size="A4"][layout="portrait"] {
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

        .logo{
            width: 104px;
            height: 108px;
            margin: 30px 0px 16px 26px;
            left: 93px;
            float: left;
        }

        .head_center{
            width: 766px;
            float: left;
            text-align: center;
            color: #000000;
        }
        .head1{     
            text-align: center;
            font-size: 28px;
            width: 500px;
        }
        .head2{     
            font-size: 25px;
            width: 423px;
            margin: 0 auto;
        }
        .head3{     
            width: 381px;
            margin: 0 auto;
            border: solid 1px #000;
        }

        /*----*/

        .user_center{
            width: 100%;
            float: left;
        }
        .title_center{
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        .name_center{
            margin-top: 10px;
            overflow: auto;
            padding:10px 0px;
            line-height: 25px;
        }
        .name{
            float:left;
            width: 375px;
            border-bottom: dotted 1px #ccc;
            margin-left: 52px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .gender{
            float:left;
            width: 180px;
            border-bottom: dotted 1px #ccc;
        }
        .position{
            float:left;
            width: 586px;
            border-bottom: dotted 1px #ccc;
            margin-left: 66px;
        }
        .time_evaluation{
            float:left;
            width: 586px;
            border-bottom: dotted 1px #ccc;
            margin-left: 21px;
        }
        .st_date{
            float:left;width:254px;border-bottom: dotted 1px #ccc;text-align: center;
        }
        .to_date{
            float:left;width:254px;border-bottom: dotted 1px #ccc;text-align: center;
        }
        .rule_evaluation{
            float:left;margin-left: 20px;
        }

        /* user form */
        .user_receipt{
            width:100%;
            overflow:auto;
        }

        .singature{
            margin-top:20px;
            float: right;
        }
        .sign_date{
            width:30px;
            float: left;
            height: 14px;
            border-bottom: dotted 1px;
        }
        .sign_month{
            width: 55px;
            float: left;
            height: 14px;
            border-bottom: dotted 1px;
        }
        .sign_year{
            width: 15px;
            float: left;
            height: 14px;
            border-bottom: dotted 1px;
        }
        .space_sing{            
            width: 274px;
            height: 14px;
            border-bottom: dotted 1px;
        }
        
    </style>


    <?php if($get_query->num_rows() > 0): ?>
    <?php foreach($get_query->result() as $row1 ): ?>
    <?php $evaluate_to =  $row1->evaluate_to?>
    <?php $iqa_evaluate_type =  $row1->evaluate_type_id?>
        <?php $get_main_title = $this->Iqa_results->get_main_evaluate_title($iqa_evaluate_type)->row();?>
    <page size="A4" layout="portrait">
        <div class="body_form">
        <!-- center -->
            <div class='logo'>
                <img width="100%" src="<?php echo base_url('assets/img/logo.png')?>">
            </div>
            <div style="position: relative;top:40px;line-height: 1.5;width: 500px 500px;float: left;text-align: center;">
                <div class="head1">សកលវិទ្យាល័យគ្រប់គ្រង និង​ សេដ្ឋកិច្ច</div>
                <div class="head2">University of Management and Economic</div>
                <hr class="head3">
            </div>
            <div class="user_center">
                <div class="title_center">
                    <?php echo $get_main_title->name_kh?>
                </div>
                <div class="name_center">
                    <div style="float:left; width:100%52px">
                        <div style="float:left">គោតនាម-នាម​ </div>
                        <div class="name">: <?php echo $row1->f_name?> <?php echo $row1->l_name?></div>
                        <div style="float:left">ភេទ​ </div>
                        <div class="gender">: <?php echo (($row1->gender == 'F')? 'Female': 'Male')?></div>
                    </div>
                    <div style="float:left; width:100%52px">
                        <div style="float:left">មុខតំណែងជា </div>
                        <div class="position">: <?php echo $row1->designation_name?></div>
                    </div>

                    <div style="float:left; width:100%52px">
                        <div style="float:left">រយះពេលវាយតំលៃ </div>
                        <div style="float:left;margin-left: 39px;">: ចាប់ពី </div><div class="st_date"><?php echo $row1->date_from?></div>
                        <div style="float:left">ដល់ </div><div class="to_date"><?php echo $row1->date_to?></div>
                    </div>
                    <div style="float:left; width:100%52px">
                        <div style="float:left">គោលការណ៍វាយតម្លៃ </div>
                        <div class="rule_evaluation">:(៥=ល្អណាស់    ៤=ល្អ​​    ៣=ល្អបង្គួរ   ២=មធ្យម    ១=ខ្សោយ, សូមប្រើសញ្ញា​ <img width="15" src="<?php echo base_url('assets/img/ch.png')?>">)</div>
                    </div>
                    
                </div>
            </div>
            <div class="user_receipt">
                <table class="tblist" border="1" cellspacing="0" width="100%">
                    <optgroup>
                        <col style="width: 5px"></col>
                        <col style="width: 100px"></col>
                        <col style="width: 5px"></col>
                    </optgroup>
                    <tr>
                        <th rowspan="2">ល.រ</th>
                        <th rowspan="2">លក្ខណះវនិច្ឆ័យ</th>
                        <th colspan="1">លទ្ធភាពទទួលបាន</th>
                    </tr> 
                    <tr>
                        <th>Total</th>
                    </tr> 
                    <?php $evaluate_type_info = $this->Iqa_results->get_evaluate_score($evaluate_to, $iqa_evaluate_type)?>
                    <?php if($evaluate_type_info->num_rows() > 0): ?>
                        <?php $i = ''?>
                        <?php $total = ''?>
                        <?php foreach($evaluate_type_info->result() as $row2): ?>
                            <?php $i++ ?>
                            <?php $total += $row2->sum_total;?>
                            <tr>
                                <td><center><?php echo $i?></center></td>
                                <td><?php echo $row2->title_kh?></td>
                                <td style="color:blue"><center><?php echo $row2->sum_total?></center></td>
                            </tr> 
                        <?php endforeach?>
                    <?php endif ?>
                    <tr>
                        <td colspan="2" style="text-align: right; text-indent: 20px"><b> Total :</b></td>
                        <td style="color:red"><center><b><?php echo $total?></b></center></td>
                    </tr>  
                </table>
            </div>
            <div class="singature">
                <div style="float:left">ស.គ.ស/បជថ្ងៃទី</div>
                        <div class="sign_date"></div>
                        <div style="float:left">ខែ</div>
                        <div class="sign_month"></div>
                        <div style="float:left">ឆ្នាំ201</div><div class="sign_year"></div>
                        <br/>
                        <br/>
                        <div class="space_sing"></div>
            </div>
        <!-- end center -->
        </div>      
    </page>
    <?php endforeach ?>
    <?php endif ?>
</div>






