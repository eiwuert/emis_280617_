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
              width: 29.7cm;
              height: 21cm;  
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
            width: 1095px;
            float: left;
            overflow: auto;
            margin: 14px 0px 0px 15px;
        }

        .logo{
            width: 104px;
            height: 108px;
            margin: 30px 0px 16px 72px;
            left: 93px;
            float: left;
        }

        .head_center{
            width: 766px;
            float: left;
            text-align: center;
            color: #000000;
        }
        .head_kh1{             
            font-size: 30px;   
            font-family: khmerOsMollight;
            letter-spacing: 1px;
        }
        .head_eng1{ 
            font-size: 22px;
            letter-spacing: 1px;
            font-weight: bold;
        }
        .head_s2{
            font-size:22px;
        }

        .head_s3{
            font-size:22px;
        }

        .head_s4{
            font-size:22px;
        }
        .main_title_center{
            float: left;
            width:100%;
        }
        .inner_main_center{
            float: left;
            width: 240px;
            position: relative;
            left: 263px;
        }
        .receipt_kh{
            font-size: 20px;
            font-family: khmerOsMollight;
            text-align: center;
            float:left;
        }.receipt_eng{
            float: left;
            font-size: 21px;
            line-height: 32px;
            margin-left: 41px;
            font-weight: bold;
        }
        .no{
            width:174px;
            float: right;
            font-size: 21px;
            line-height: 32px;
            font-weight: bold;
        }.num_no{
            float: left;
            padding: 0px 21px;
            border-bottom: dotted 2px #000;
            position: relative;
            top: 8px;
            line-height: 14px;
            margin: 0px 5px;
            color: red;
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
        }        
        .tblist tr td{
            font-size: 10px;
            padding:5px 0px;
        }
        .uppercase{text-transform: uppercase;}
       
        
    </style>
    <page size="A4" layout="portrait">
        <div class="body_form">
        <!-- center -->
            <div class='logo'>
                <img width="100%" src="<?php echo base_url('assets/img/logo.png')?>">
            </div>
            <div style="margin-top:22px">
                <div class="head_center">
                    <div class="head_kh1">សាកលវិទ្យាល័យគ្រប់គ្រង និងសេដ្ឋកិច្ច</div>
                    <div class="head_eng1">UNIVERSITY OF MANAGEMENT AND ECONOMICS</div>
                    <div class="head_s2">លទ្ធផលប្រឡង ឆមាសទី<?php echo ($stu_head_print->course_schedule_semester)? $stu_head_print->course_schedule_semester : ''?> ឆ្នាំទី<?php echo ($stu_head_print->course_schedule_year)? $stu_head_print->course_schedule_year : ''?> ឆ្នាំសិក្សា <?php echo ($stu_head_print->stu_acad_admission_date)? $stu_head_print->stu_acad_admission_date : ''?></div>
                    <div class="head_s3">មហាវិទ្យាល័យ<?php echo ($stu_head_print->university_name)? $stu_head_print->university_name : ''?> ជំនាន់ទី null</div>
                    <div class="head_s4">សិក្សាថ្ងៃ​ <?php echo ($stu_head_print->stu_master_stu_schedule​​ == '1')? 'Mon-Fri' : 'Sat-Sun'?> ពេលព្រឹកnull បន្ទប់ <?php echo ($stu_head_print->room_name)? $stu_head_print->room_name : ''?></div>
                </div>
            </div>

            <div class="user_receipt">
                <table class="tblist" border="1" cellspacing="0" width="100%">
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2" style="width:20px">គោត្តនាមេ-នាម</th>
                        <th rowspan="2" style="width:20px">អក្សរឡាតាំង</th>
                        <th rowspan="2" style="width:20px">ភេទ</th>
                        <?php echo $print_subject?>
                    </tr>
                    <?php if($count_subject > 0 ):?>
                    <tr>                        
                        <?php for ($i=0; $i < $count_subject; $i++): ?>
                            <th style="width: 25px;">Att</th>
                            <th style="width: 25px;">Mid</th>
                            <th style="width: 25px;">Final</th>
                            <th style="width: 25px;">Total</th>
                        <?php endfor ?> 
                    </tr>
                    <?php endif ?>
                    <?php echo $print?>
                </table>
            </div>
        <!-- end center -->
        </div>      
    </page>

</div>






