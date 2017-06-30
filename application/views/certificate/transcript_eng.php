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
			  background-image: url('../assets/img/transcript.png');
			  background-size: contain;
			  display: block;
			  margin: 0 auto;
			  margin-bottom: 0.5cm;
			  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
			}
			page[size="A4"] {  
			  width: 21cm;
			  height: 29.7cm; 
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
			    font-family: ahronbd;
			    src: url(../assets/img/fonts/ahronbd.ttf);
			}			
			@font-face {
			    font-family: khmerOScontent;
			    src: url(../assets/img/fonts/KhmerOScontent.ttf);
			}
			@font-face {
			    font-family: time_new_romen;
			    src: url(../assets/img/fonts/times.ttf);
			}	
			@font-face {
			    font-family: coprgtb;
			    src: url(../assets/img/fonts/COPRGTB.TTF);
			}	
			.transcript{
			    padding: 67px 0px 0px 53px;
			}
			.inner_transcript{
			    width: 688px;
			    height: 984px;
			    float: left;	
			}

			.ministry_left{
			    width: 366px;
			    height: 173px;
			    float: left;
			}
			.ministry_text{
			    font-family: time_new_romen;
			    font-size: 14.5px;
			    color: blue;
			    font-weight: bold;
			    margin-left: 5px;
			    margin-top: 60px;
			    line-height: 31px;
			    letter-spacing: 0.1px;
			}
			.kingdom{
			    width: 227px;
			    height: 125px;
			    float: right;
			}
			.kingdom_text{
			    text-align: left;
			    font-family: time_new_romen;
			    font-size: 16px;
			    color: blue;
			    font-weight: bold;
			    margin-left: 7px;	
			}
			
			.nation{				
			    text-align: left;
			    font-family: time_new_romen;
			    font-size: 16px;
			    color: blue;
			    font-weight: bold;
			    margin-left: 7px;
			    margin-top: 9px;
			    letter-spacing: 0.9px;
			}
			.title_transcript{
			    width: 100%;
			    height: 33px;
			    text-align: center;
			    font-family: coprgtb;
			    font-size: 17.3px;
			    float: left;
			    margin-top: -1px;
			    text-decoration: underline;				
			}
			.body_transaction{
				width:100%;overflow: auto;
			}
			.the_following{
			    width: 100%;
			    text-indent: 48px;
			    font-family: time_new_romen;
			    margin-top: 16px;
			}
			.score{
			    border: solid 1px #000;
			    width: 685px;
			    margin-top: 10px;
			}

			.score_head tr{
			    line-height: 14px;
			    text-align: center;
			    font-size: 14px;
			}


			.score_body tr{
			    line-height: 35px;
			    font-size: 14px;
			    text-indent: 8px;
			}
			.score_body tr td center{
			    text-indent: 0px;
			}
			.score_foot tr{
			    line-height: 16px;
			    font-size: 14px;
			    text-indent: 8px;
			}			
			.score_foot tr td center{
			    text-indent: 0px;
			}
			.photo{
				width: 97px;
			    height: 153px;			    
			    text-align: center;
			    font-size: 14px;
			    line-height: 2.5;
			    margin: 21px 0px 0px 295px;
			    float: left;
			}
			.inner_photo{
				width: 95px;
			    height: 113px;
			    border: solid 1px rgba(97, 97, 97, 0.93);
			    text-align: center;
			    line-height: 9.5;
			    font-size: 12px;
			}
			.date_director{
			    font-family: time_new_romen;		
				width: 231px;
			    overflow: auto;
			    float: right;
			    text-align: left;
			    margin-top: 44px;
			    text-indent: 1px;
			}
			.director{
			    font-family: time_new_romen;			    
				width: 231px;
			    overflow: auto;
			    float: right;
			    text-align: left;
			    text-indent: 1px;
			    text-align: center;
				
			}
			.grading{    
				font-family: time_new_romen;
			    width: 173px;
			    overflow: auto;
			    float: left;
			    text-align: left;
			    position: absolute;
			    margin-top: 251px;
			}
			.top_grading{
				text-align: center;
			    width: 100%;
			    overflow: auto;
			    font-size: 11px;
			    margin: 2px 0px 0px 0px;
			    text-decoration: underline;
			}
			.show_grading{
				text-align: left;
			    width: 100%;
			    overflow: hidden;
			    font-size: 11px;
			}
	</style>

	<page size="A4">
			
			<div class="transcript">
				<div class="inner_transcript">
					<div class="ministry_left">
						<div class="ministry_text">
							MINISTRY OF EDUCATION, YOUTH AND SPORT<br>
							UNIVERSITY OF MANAGEMENT AND ECONOMICS<br>					
							No……………….……….ume/bmc
						</div>
					</div>

					<div class='kingdom'>
						<div class="kingdom_text">
							KINGDOM OF CAMBODIA
						</div>						
						<div class="nation">
							NATION RELIGION KING
						</div>
					</div>
					<div class="title_transcript">
						TRANSCRIPT OF RECORD
					</div>
					<div class="body_transaction">
						<center style='line-height: 20px;'>Director of University of Management and Economics, Banteay Meanchey Campus, Certifies that:</center>
						<table style="margin-left: 24px;margin-top: 15px;width: 328px;line-height: 16px;text-indent: -1px;">
							<colgroup>
								<col style="width:8px;"></col>
								<col style="width:40px"></col>
								<col style="width:40px"></col>
							</colgroup>
							<tr>
								<td>-</td>
								<td>Surname and Name</td>
								<td>: <b>BOENG KOLKA</b></td>
							</tr>
							<tr>
								<td>-</td>
								<td>Sex</td>
								<td>: Female</td>
							</tr>
							<tr>
								<td>-</td>
								<td>Date of Birth</td>
								<td>: 10-November-1990</td>
							</tr>
							<tr>
								<td>-</td>
								<td>Nationality</td>
								<td>: Cambodian</td>
							</tr>
						</table>
						<div class="the_following">
							<div style="padding-left:3px;">
								The following transcript of record is certified as correct according to the record of General English Program (GEP) at University of Management and Economics, Banteay Meanchey Campus.
							</div>
						</div>
						<table class="score" border="1" cellpadding="0" cellspacing="0">
							<colgroup>
								<col style="width: 66px;">
								<col style="width: 140px;">
								<col style="width: 88px;">
								<col style="width: 68px;">
								
								<col style="width: 65px;">
								<col style="width: 138px;">
								<col style="width: 77px;">
								<col style="width: 65px;">
							</colgroup>
							<thead class="score_head">
								<tr>
									<td>LEVEL</td>
									<td>SUBJECTS</td>
									<td>SCORES</td>
									<td>GRADES</td>
									<td>LEVEL</td>
									<td>SUBJECTS</td>
									<td>SCORES</td>
									<td>GRADES</td>
								</tr>
							</thead>
							<tbody class="score_body">
									<tr>
										<td><center>1</center></td>
										<td>Englis in Mind</td>
										<td><center>65.50</center></td>
										<td><center>D</center></td>
										<td><center>7</center></td>
										<td>English in Mind</td>
										<td><center>65.00</center></td>
										<td><center>D</center></td>
									</tr>
									<tr>
										<td><center>2</center></td>
										<td>Englis in Mind</td>
										<td></td>
										<td></td>
										<td><center>8</center></td>
										<td>English in Mind</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td><center>3</center></td>
										<td>Englis in Mind</td>
										<td></td>
										<td></td>
										<td><center>9</center></td>
										<td>English in Mind</td>
										<td></td>
										<td></td>
									</tr>
							
							</tbody>
							<tfoot class="score_foot">
								<tr>
									<td rowspan="2"><center>4</center></td>
									<td rowspan="2">Englis in Mind</td>
									<td rowspan="2"></td>
									<td rowspan="2"></td>
									<td rowspan="2"><center>10</center></td>
									<td>English in Mind</td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td>TOEFL</td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td rowspan="2"><center>5</center></td>
									<td rowspan="2">Englis in Mind</td>
									<td rowspan="2"></td>
									<td rowspan="2"></td>
									<td rowspan="2"><center>11</center></td>
									<td>English in Mind</td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td>TOEFL</td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td rowspan="2"><center>6</center></td>
									<td rowspan="2">Englis in Mind</td>
									<td rowspan="2"></td>
									<td rowspan="2"></td>
									<td rowspan="2"><center>12</center></td>
									<td>English in Mind</td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td>TOEFL</td>
									<td></td>
									<td></td>
								</tr>
							</tfoot>
						</table>

						<div class="photo">
							<div class="inner_photo">
								4 X 6
							</div>
							<center>ID: 54000146</center>
						</div>

						<div class="date_director">
							Banteay Meanchey, March...., 2012	
						</div>

						<div class="grading">
							<div class="top_grading">
								<b>GRADING SYSTEM</b>
							</div>
							<div class="show_grading">
								<div style="margin: 13px 0px 0px 9px">
									A &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;90%  - 100%&nbsp;&nbsp;Excellent<br>
									B+&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;85%  - 89%&nbsp;&nbsp;&nbsp;&nbsp;Very Good<br>
									B &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;75%  - 84%&nbsp;&nbsp;&nbsp;&nbsp;Good<br>
									C &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;70%  - 74%&nbsp;&nbsp;&nbsp;&nbsp;Fairly Good<br>
									D &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;60%  - 69%&nbsp;&nbsp;&nbsp;&nbsp;Fair<br>
									F &nbsp;&nbsp;&nbsp;&nbsp; = &nbsp;< &nbsp;60&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failure
								</div>
							</div>	
						</div>
					</div>


				</div>
			</div>

	</page>

</div>


