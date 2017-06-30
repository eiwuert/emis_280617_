<meta charset="utf-8" />
<script type="text/javascript" src="<?php echo base_url('js/jquery.min.js')?>" > </script>
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

<input type="button" value="Print Div" onclick="PrintElem('#mydiv')" />

<div id="mydiv">
	<style type="text/css">
			body {
			  background: rgb(204,204,204); 
			}
			page {
			  background: white;		  
			  background-image: url('../assets/img/fdy.png');
			  background-size: contain;
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
		/*++++++++ start body transcript++++*/
			
			@font-face {
			    font-family: khmerOsMollight;
			    src: url(../assets/img/fonts/KhmerOSmuollight.ttf);
			}
			@font-face {
			    font-family: khmerOSmuol;
			    src: url(../assets/img/fonts/KhmerOSmuol.ttf);
			}
			@font-face {
			    font-family: time_new_romen;
			    src: url(../assets/img/fonts/times.ttf);
			}			
			@font-face {
			    font-family: khmerOScontent;
			    src: url(../assets/img/fonts/KhmerOScontent.ttf);
			}
		
			@font-face {
			    font-family: khmerOSbokor;
			    src: url(../assets/img/fonts/KhmerOSbokor.ttf);
			}

			#body_page{
				    padding: 115px 72px;
			}	
			#inner_body{
				    width: 970px;
				    height: 552px;
			}
			.float_left{float:left;}
			.front_left_side{
				float: left;
				width:452px;
				height:200px;
			}
			.front_right_side{
				float: right;
				width:434px;
				height:200px;
			}

			.front_academic_trans_kh{
		    	margin: 0px 0px 0px 174px;
			    font-family: khmerOSmuol;
			    font-size: 15px;
			    color: #993300;
			}
			.front_academic_trans_eng{				
			    margin: 0px 0px 0px 141px;
			    font-family: time_new_romen;
			    font-size: 17px;
			    font-weight: bold;
			    letter-spacing: 0.6px;
			    color:#008080;
			}
			.front_name{		
			    margin: 15px 0px 0px 8px;
			    font-family: time_new_romen;
			    font-size: 14px;
			    color:#333399;
			}
			.front_id{			
			    margin: -16px 19px 0px 0px;
			    font-family: time_new_romen;
			    font-size: 14px;
			    font-weight: bold;
			    letter-spacing: 0.6px;
			    float: right;
			    color:#333399;
			}
			.khmerOSmuol{
			    font-family: khmerOSmuol;
    			font-weight: 100;
			}

			.khmerOScontent{
			    font-family: khmerOScontent !important;
    			font-weight: 100;
				font-size: 10px !important;
			}


			.front_table{
				padding:16px 0px 0px 0px;
			}
			.front_table table{
			    width: 100%;
			    overflow: auto;
			    color:#333399;
			}
			.front_table table tr th{
				font-size: 12px;
			}
			
			.front_table table tr td{
				font-size: 11px;
				font-family: time_new_romen;
				line-height: 19px;
			}

			.front_table2{
				padding:0px 0px 0px 0px;
			}
			.front_table2 table{
			    width: 100%;
			    overflow: auto;
			    color:#333399;
			}
			.front_table2 table tr th{
			    font-size: 12px;
			    text-align: left;
			    text-indent: 37px;
			    line-height: 16px;
			}
			
			.front_table2 table tr td{
				font-size: 11px;
				font-family: time_new_romen;
				line-height: 19px;
			}
			.front_gpa{
			    float: left;
			    font-size: 14px;
			    font-family: time_new_romen;
			    margin: 21px 0px 0px 8px;
			    font-weight: bolder;
			    color:#333399;
			}
			.front_grading{    
			    font-family: time_new_romen;
			    float: left;
			    text-align: left;
			    width: 100%;
			    line-height: 22px;
			    margin: 0px 2px 0px 0px;
			    color:#333399;
			}
			.front_top_grading{
			    text-align: left;
			    text-indent: 8px;
			    width: 100%;
			    overflow: auto;
			    font-size: 13px;
			    margin: 2px 0px 0px 0px;
			    color:#333399;
			}
			.front_show_grading{
			    text-align: left;
			    width: 217px;
			    overflow: hidden;
			    font-size: 11px;
			    margin-top: -17px;
			    float: left;
			    color:#333399;
			}
			.front_only{
			    font-family: khmerOSbokor;
			    font-size: 14px;
			    line-height: 30px;
			    text-indent: 11px;
			    color:#333399;
			}

			/**/

			.front_body_kingdom{
			    float: right;
			    width: 225px;
			    font-family: khmerOsMollight;
			    color:#333399;
			}
			.fornt_txt_kingdom{  
			    margin: -6px 0px 0px 44px;
			    font-family: khmerOsMollight;
			}
			.fornt_txt_kingdom_eng{  
			    margin: 1px 0px 0px 51px;
			    font-family: time_new_romen;
			    letter-spacing: 1;
			}
			.fornt_txt_nation_kingdom{  
			    margin: 0px 0px 0px 50px;
			    font-family: khmerOsMollight;
			    font-size: 12px;
			    letter-spacing: 0.5px;
			}
			.fornt_txt_nation_kingdom_eng{  
				margin: 1px 0px 0px 75px;
				font-size: 13px;
				font-family: time_new_romen;
				letter-spacing: 0.3px;
			}

			.front_logo{
				padding: 17px 62px;
			}
			.front_logo img{
				width:85px;
			}
			.front_logo_text{
				    padding-left: 0px;
				    margin-top: -6px;
				    font-size: 15px;
				    font-family: khmerOSmuol;
				    color:#008080;
			}
			.front_logo_text_eng{
				    margin-top: -2px;
				    font-size: 15px;
				    font-family: time_new_romen;
				    color:#FF6600;
			}
			.front_big_title_kh{
			    width: 100%;
			    height: 36px;
			    float: left;
			    margin-top: 67px;
			    font-size: 23px;
			    font-family: khmerOSmuol;
			    text-align: center;
			    line-height: 39px;
			    color:#E36C0A;
			}
			.front_big_title_eng{
				width: 100%;
				height: 36px;
				float: left;
				margin-top: 2px;
				font-size: 24px;
				font-family: time_new_romen;
				text-align: center;
				line-height: 39px;
				font-weight: bold;
				letter-spacing: 1.4;
			    color:#FF6600;
			}
			.front_academic_year{				
		    	width: 100%;
			    height: 36px;
			    float: left;
			    margin-top: 29px;
			    font-size: 18px;
			    font-family: khmerOSbokor;
			    text-align: center;
			    color:#993300;
			    line-height: 39px;
			    font-weight: bold;
			    letter-spacing: 1.4;
			}
			.front_no{
			    color:#333399;
				width: 100%;
				height: 36px;
				float: left;
				margin-top: 142px;
				font-size: 13px;
				font-family: khmerOSbokor;
				text-align: left;
				line-height: 39px;
				letter-spacing: 0.9;
				text-indent: 23px;
			}

	</style>

	<page size="A4" layout="portrait">
			<div id="body_page">
				<div id="inner_body">
				<!-- start -->					
						<div class="front_left_side">
							<div class="front_academic_trans_kh">ព្រឹត្តិបត្រពិន្ទុ</div>
							<div class="front_academic_trans_eng">Academic Transcript</div>
							<div class="front_name"><div class="float_left">Name:</div><div style="font-weight:bold;margin-left: 44px;letter-spacing: 0.5px;">LEANG MAKARA</div></div>
							<div class="front_id">ID: BMC2511005266</div>
							<div class="front_table">
								<table>
									<colgroup>
										<col style="width: 127px;"></col>
										<col style="width:124px;"></col>
										<col style="width:5px;"></col>
										<col style="width:5px;"></col>
									</colgroup>
									<tr>
										<th class="khmerOSmuol">មុខវិជ្ជាទូទៅ</th>
										<th>General Subjects</th>
										<th>Credits</th>
										<th>Grade</th>
									</tr>
									<tr>
										<td class="khmerOScontent">-	ប្រវត្តិសាស្រ្តប្រទេសកម្ពុជា</td>
										<td>-	History of Cambodia</td>
										<td><center>3</center></td>
										<td><center>B</center></td>
									</tr>
									<tr>
										<td class="khmerOScontent">-	គណិតវិទ្យាអាជីវកម្ម</td>
										<td>-	Business Math</td>
										<td><center>3</center></td>
										<td><center>B</center></td>
									</tr>
									<tr>
										<td class="khmerOScontent">-	សង្គមវិទ្យា</td>
										<td>-	Sociology</td>
										<td><center>3</center></td>
										<td><center>C</center></td>
									</tr>
									<tr>
										<td class="khmerOScontent">-	ទស្សនទានអាជីវកម្ម ១</td>
										<td>-	Business Concepts I</td>
										<td><center>3</center></td>
										<td><center>B</center></td>
									</tr>
									<tr>
										<td class="khmerOScontent">-	មូលដ្ឋានគ្រឹះនៃព្រះពុទ្ធសាសនា</td>
										<td>-	Basic  Buddhism</td>
										<td><center>3</center></td>
										<td><center>C</center></td>
									</tr>
									<tr>
										<td class="khmerOScontent">-	កុំព្យូទ័ររដ្ឋបាល</td>
										<td>-	Administrative Computer</td>
										<td><center>3</center></td>
										<td><center>A</center></td>
									</tr>
									<tr>
										<td class="khmerOScontent">-	រដ្ឋបាលសាធារណៈ និង ការិយាល័យ</td>
										<td>-	Public and Office Administration</td>
										<td><center>3</center></td>
										<td><center>C+</center></td>
									</tr>
									<tr>
										<td class="khmerOScontent">-	ទស្សនទានអាជីវកម្ម ២</td>
										<td>-	Business Concepts II</td>
										<td><center>3</center></td>
										<td><center>C</center></td>
									</tr>
								</table>
							</div>
							<div class="front_table2">
								<table>
									<colgroup>
										<col style="width: 26%;"></col>
										<col style="width:25%;"></col>

										<col style="width: 11%;"></col>
										<col style="width:5%;"></col>
									</colgroup>
									<tr>
										<th class="khmerOSmuol">មុខវិជ្ជាតម្រង់ទិស</th>
										<th colspan="3">Oriented Subjects</th>
									</tr>

									<tr>
										<td class="khmerOScontent">-	ជំនាញការសរសេរ</td>
										<td>-	Academic Writing</td>
										<td><center>3</center></td>
										<td><center>B</center></td>
									</tr>	
									<tr>
										<td class="khmerOScontent">-	អង់គ្លេសស្នូល</td>
										<td>-	Academic Writing</td>
										<td><center>3</center></td>
										<td><center>B</center></td>
									</tr>									
								</table>
							</div>
							<div class="gpa">
								GPA:   2.50
							</div>
							<div class="front_grading">
							<div class="front_top_grading">
								<b>Note:</b>
							</div>
							<div class="front_show_grading">
								<div style="margin: 13px 0px 0px 3px;width: 208px;">
									A &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;85%  - 100%&nbsp;&nbsp;=Excellent&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ល្អប្រសើរ<br>
									B+&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;80%  - 84%&nbsp;&nbsp;&nbsp;&nbsp;=Very Good&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ល្អណាស់<br>
									B &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;70%  - 79%&nbsp;&nbsp;&nbsp;&nbsp;=Good&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ល្អ<br>
									C+ &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;65%  - 69%&nbsp;&nbsp;&nbsp;&nbsp;=Fairly Good&nbsp;&nbsp;&nbsp;ល្អបង្គួរ<br>
									
								</div>
							</div>
							<div class="front_show_grading">
								<div style="margin: 13px 0px 0px 3px;width: 208px;">
									C &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;50%  - 64%&nbsp;&nbsp;=Fairly&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;មធ្យម<br>
									D &nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;45%  - 49% &nbsp;&nbsp;=Poor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ខ្សោយ<br>
									E &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;40%  - 44%&nbsp;=Very poor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ខ្សោយណាស់<br>
									F &nbsp;&nbsp;&nbsp; ≤ &nbsp;&nbsp;&nbsp;39% &nbsp;&nbsp;&nbsp;&nbsp;=Failure&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ធ្លាក់<br>
									
								</div>
							</div>
							<div class="front_only">
								<div style="font-size: 30px;line-height: 46px;float: left;">*</div>	វិញ្ញាបនបត្រនេះ មិនចេញជូនជាលើកទី២ ទេ​​ ។
							</div>	
						</div>
						</div>			
						<div class="front_right_side">
							<div class="front_body_kingdom">				
								<div class="fornt_txt_kingdom">ព្រះរាជាណាចក្រកម្ពុជា</div>
								<div class="fornt_txt_kingdom_eng">Kingdom of Cambodia</div>
								<div class="fornt_txt_nation_kingdom">ជាតិ សាសនា ព្រះមហាក្សត្រ</div>
								<div class="fornt_txt_nation_kingdom_eng">Nation Religion King</div>
							</div>

							<div class='front_logo'>
								<img src="<?php echo base_url('assets/img/logo.png')?>">
							</div>
							<div>								
								<div class="front_logo_text">សកលវិទ្យាល័យគ្រប់គ្រង និង​ សេដ្ឋកិច្ច</div>
								<div class="front_logo_text_eng">University of Management and Economics</div>
							</div>

							<div class="front_big_title_kh">
								វិញ្ញាបនបត្រថ្នាក់ឆ្នាំសិក្សាមូលដ្ឋាន
							</div>
							<div class="front_big_title_eng">
								Certificate of Foundation Year Course 
							</div>
							<div class="front_academic_year">
								២០១៣~២០១៤
							</div>
							<div class="front_no">
								No  គ.ទ.ក ០៣៤០១ ១៣០៣៨/០០១/១៤/សគស.បជ
							</div>

						</div>
				<!-- stop -->
				</div>
			</div>

	</page>

</div>


