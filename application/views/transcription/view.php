
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
	page[size="A4"] {
	  background: white;
	  /*background-image: url('assets/img/img.jpg');*/
	  background-image: url('assets/img/img2.jpg');
	  background-size: contain;
	  width: 21cm;
	  height: 29.7cm;
	  display: block;
	  margin: 0 auto;
	  margin-bottom: 0.5cm;
	  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	}
	@media print {
	  body, page[size="A4"] {
	    margin: 0;
	    box-shadow: 0;
	  }
	}
	/*++++++++ start body transcript++++++++*/
	.body_transcript{    
						padding-top: 209px;
    					line-height: 11px;
	}
	h2{font-size: 23.5px;}
	.text_indent{
		    			text-indent: 9px;
	}
	#director_detail{
					    font-size: 14px;
			    		letter-spacing: 0.2px;
	}
	#info_left{
						float:left;   
						padding: 8px 0 0 70px;
					    line-height: 15px;
					    letter-spacing: 0px;
					    position: absolute;
    					margin-left: 0px;
    					font-size: 13px;
	}
	#info_right{		float: right;
					    padding: 8px 80px 0 0;
					    line-height: 15px;
					    letter-spacing: 0px;
					    position: absolute;
    					margin-left: 470px;
    					font-size: 13px;
	}
	#the_following{
						color: black;
				    	padding: 6px 0px;
					    font-size: 14px;
					    font-weight: bold;
					    letter-spacing: 0.2px;
	}
	.table_score{
		    color: black;
		    margin: 0 auto;
		    font-size: 11px;
		    border-style: solid solid none none;
		    border-width: 1px;
		    border-color: black;
    		line-height: 14px;
	}

	.table_score tr{
						padding: 1px 0px;
	}
	.table_score tr th{
						padding: 1px 6px;
						border-style: none none solid solid;
						border-width: 1px;
    					border-color: black;
    					font-weight: bolder;
    					font-size: 10px;
	}

	.table_score tr td{
						border-style: none none solid solid;   
						border-width: 1px;
    					border-color: black;
	}
	.table_score tr th span{
						text-indent: 12px;
	}
	.head_subject{
			   		    width: 167px;
					    font-size: 9px;
	}	
	.head_credit{
			   		    width: 38px;
					    font-size: 9px;
	}
	.head_grade{
			   		    width: 38px;
					    font-size: 9px;
	}
	.head_score{
			   		    width: 38px;
					    font-size: 9px;
	}
	.director{    
						width: 300px;
					    float: right;
					    margin-top: 16px;
					    font-size: 14px;
					    letter-spacing: 0.4px;
    					line-height: 16px;
	}
	.system_grading{
					    width: 300px;
					    float: left;
					    margin-top: 160px;
					    margin-left: 59px;
					    font-size: 11px;
	}
	.system_grading table{    
						font-size: 10px;
					    line-height: 11px;
					    text-indent: 6px;
					    margin-top: 4px;
	}
	.system_grading table tr th{    
						font-weight: bold;
	}

</style>

<code>
	Please move image form folder view to : assets/img/img.jpg
</code>

<page size="A4">
	
		<div class="body_transcript">
		<center><h2>TRANSCRIPT OF RECORD</h2></center>
		<center><span id='director_detail'>Director of University of Management and Economics certifies that:</span></center>
		
		<div style="width:100%;min-height: 124px">
			<table id="info_left">
				<tr>
					<td>Name in Khmer</td>
					<td><b>: Name Khmer</b></td>
				</tr>
				<tr>
					<td>Name in English</td>
					<td><b>: Name in English</b></td>
				</tr>
				<tr>
					<td>Sex</td>
					<td>: Male</td>
				</tr>
				<tr>
					<td>Date of Birth</td>
					<td>: 08-September-1990</td>
				</tr>
				<tr>
					<td>Nationality</td>
					<td>: Khmer</td>
				</tr>
				<tr>
					<td>Place of Birth</td>
					<td>: Banteay Meanchey Province, Cambodia</td>
				</tr>
			</table>

			<table id="info_right">
				<tr>
					<td>Degree</td>
					<td>: Bachelor</td>
				</tr>
				<tr>
					<td>Promotion</td>
					<td>: VIII</td>
				</tr>
				<tr>
					<td>YEAR</td>
					<td>: III</td>
				</tr>
				<tr>
					<td>Period</td>
					<td>: 2016 - 2017</td>
				</tr>
				<tr>
					<td>School of</td>
					<td>: Business Administration</td>
				</tr>
				<tr>
					<td>Major</td>
					<td>: Management</td>
				</tr>
			</table>
		</div>


		<div id="the_following" style="width:100%;overflow:auto;">
				<center>The following transcript is certified as correct according to the record of University.</center>
		</div>

		<div style="width:100%;overflow:auto;">
			<table class="table_score" cellpadding="0" cellspacing="0" width="705">

				  <colgroup>
				    <col style="width: 50px;">
				    <col style="width: 180px;">
				    <col style="width: 50px;">
				    <col style="width:50px;">
				    <col style="width:50px;">
				    <col style="width:180px;">
				    <col style="width: 50px;">
				    <col style="width:50px;">
				    <col style="width:50px;">
				  </colgroup>

				<tr>
					<th><center>YEAR</center></th>
					<th colspan="4"><center>FIRST SEMESTER</center></th>
					<th colspan="4"><center>SECOND SEMESTER</center></th>
				</tr>
				<tr>
					<th rowspan="7"><center>1st</center></th>
					<th><center>SUBJECT</center></th>
					<!-- <th><center>CREDIT</center></th> -->
					<th><center>CREDIT</center></th>
					<!-- <th><center>GRADE</center></th> -->
					<th><center>GRADE</center></th>
					<!-- <th><center>SCORE</center></th> -->
					<th><center>SCORE</center></th>
					<th><center>SUBJECT</center></th>
					<th><center>CREDIT</center></th>
					<th><center>GRADE</center></th>
					<th><center>SCORE</center></th>
				</tr>

				<tr>
					<td class="text_indent">Introduction to Business</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
					<td class="text_indent">Introduction to Business</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Business Math</td>
					<td><center>3</center></td>
					<td><center>C+</center></td>
					<td><center>65.00</center></td>
					<td class="text_indent">Business Math</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>65.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Public & Office Administration</td>
					<td><center>3</center></td>
					<td><center>B</center></td>
					<td><center>70.00</center></td>
					<td class="text_indent">Public & Office Administration</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>70.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Contract Law</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
					<td class="text_indent">Contract Law</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Computer Administration</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
					<td class="text_indent">Computer Administration</td>
					<td><center>3</center></td>
					<td><center>B+</center></td>
					<td><center>50.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Business English</td>
					<td><center>3</center></td>
					<td><center>B</center></td>
					<td><center>70.00</center></td>
					<td class="text_indent">Business English</td>
					<td><center>3</center></td>
					<td><center>A</center></td>
					<td><center>70.00</center></td>
				</tr>

		<!--  -->

				<tr>
					<th rowspan="6"><center>2st</center></th>
					<td class="text_indent">Introduction to Business</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
					<td class="text_indent">Introduction to Business</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Business Math</td>
					<td><center>3</center></td>
					<td><center>C+</center></td>
					<td><center>65.00</center></td>
					<td class="text_indent">Business Math</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>65.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Public & Office Administration</td>
					<td><center>3</center></td>
					<td><center>B</center></td>
					<td><center>70.00</center></td>
					<td class="text_indent">Public & Office Administration</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>70.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Contract Law</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
					<td class="text_indent">Contract Law</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Computer Administration</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
					<td class="text_indent">Computer Administration</td>
					<td><center>3</center></td>
					<td><center>B+</center></td>
					<td><center>50.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Business English</td>
					<td><center>3</center></td>
					<td><center>B</center></td>
					<td><center>70.00</center></td>
					<td class="text_indent">Business English</td>
					<td><center>3</center></td>
					<td><center>A</center></td>
					<td><center>70.00</center></td>
				</tr>

		<!--  -->
				<tr>
					<th rowspan="6"><center>3st</center></th>
					<td class="text_indent">Introduction to Business</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
					<td class="text_indent">Introduction to Business</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Business Math</td>
					<td><center>3</center></td>
					<td><center>C+</center></td>
					<td><center>65.00</center></td>
					<td class="text_indent">Business Math</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>65.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Public & Office Administration</td>
					<td><center>3</center></td>
					<td><center>B</center></td>
					<td><center>70.00</center></td>
					<td class="text_indent">Public & Office Administration</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>70.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Contract Law</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
					<td class="text_indent">Contract Law</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Computer Administration</td>
					<td><center>3</center></td>
					<td><center>C</center></td>
					<td><center>50.00</center></td>
					<td class="text_indent">Computer Administration</td>
					<td><center>3</center></td>
					<td><center>B+</center></td>
					<td><center>50.00</center></td>
				</tr>

				<tr>
					<td class="text_indent">Business English</td>
					<td><center>3</center></td>
					<td><center>B</center></td>
					<td><center>70.00</center></td>
					<td class="text_indent">Business English</td>
					<td><center>3</center></td>
					<td><center>A</center></td>
					<td><center>70.00</center></td>
				</tr>

			</table>
		</div>

		<div style="width:100%;overflow:auto;">
			<div class="director">
				<center>Banteay Meanchey, April ......., 2015</center>
				<center>Director</center>
			</div>
		</div>

		<!-- <div style="width:100%;overflow:auto;">
			<div class="system_grading">
				<span>GRADING SYSTEM</span>
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>Grade</td>
						<td>Pereentage Score</td>
						<td>Remark</td>
					</tr>
					<tr>
						<td>A</td>
						<td>85% - 100%</td>
						<td>Excellent</td>
					</tr>
					<tr>
						<td>B+</td>
						<td>80% - 84%</td>
						<td>Very Good</td>
					</tr>
					<tr>
						<td>B</td>
						<td>70% - 79%</td>
						<td>Good</td>
					</tr>
					<tr>
						<td>C+</td>
						<td>65% - 69%</td>
						<td>Fairly Good</td>
					</tr>
					<tr>
						<td>C</td>
						<td>50% - 64%</td>
						<td>Fair</td>
					</tr>
					<tr>
						<td>D</td>
						<td>45% - 49%</td>
						<td>Poor</td>
					</tr>
					<tr>
						<td>E</td>
						<td>40% - 44%</td>
						<td>Very Poor</td>
					</tr>
					<tr>
						<td>F</td>
						<td>0% - 39%</td>
						<td>Failure</td>
					</tr>

				</table>
			</div>
		</div> -->
		</div>

</page>
</div>

