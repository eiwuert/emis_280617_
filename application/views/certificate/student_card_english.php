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
			  /*background-image: url('../assets/img/student_card.png');*/
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
			    src: url(assets/img/fonts/KhmerOSmuollight.ttf);
			}
			@font-face {
			    font-family: ahronbd;
			    src: url(assets/img/fonts/ahronbd.ttf);
			}			
			@font-face {
			    font-family: khmerOScontent;
			    src: url(assets/img/fonts/KhmerOScontent.ttf);
			}
			.body_card{
				padding:38px 25px;
			}
			.inner_body_card{
				width:741px;
				height: 1055px;
			}
			.block{
				width: 227px;
			    height: 331px;
			    border: solid 2px #4C4CB7;
			    margin: 2px 5px 22px 10px;
			    border-radius: 11px;
			    float: left;
			}
			.head{   
				width: 100%;
    			height: 68px;
			    border-top-right-radius: 11px;
			    border-top-left-radius: 11px;
			    /*background: rgba(0, 230, 255, 0.48);*/
				background-image: url('../assets/img/bg_card_yellow.png');
				background-size: contain;
			}
			.head img{
				width: 50px;
    			margin: 1px 7px;
    			float: left;
			}
			.head_text{				
			    font-family: ahronbd;
			    font-size: 27px;
			    padding-top: 4px;
			    color:blue;
			}
			.head_text_bottom{

			    font-family: ahronbd;
			    font-size: 12px;
			    padding-top: 0px;
			    color:blue;
			}
			.small_bottom{
				font-size: 8px;
			    height: 15px;
			    background: rgb(255, 234, 171);
			    margin-top: 4px;
			    line-height: 14px;
			    color: blue;
			    text-align: center;
			}
			.photo{
				width: 62px;
			    height: 85px;
			    margin: 6px 6px 0px 8px;
			    border: solid 1px #ccc;
			    float: left;
			}
			.id{
				width:100%;
				height: 12px;
				float: left;
				text-indent: 12px;
				font-size: 10px;
				margin-top: 4px;
			}
			.school_detail{
			    width: 191px;
			    height: 20px;
			    border: solid 2px #3B3BFF;
			    border-radius: 12px;
			    margin: 1px 0px 0px 19px;
			    float: left;
			    font-size: 11px;
			    text-align: center;
			    line-height: 20px;
			    color: blue;
			}
			.free_space{
				width: 100%;
			    height: 87px;
			    float: left;
			}
			.director{
				    width: 114px;
				    height: 20px;
				    border-top: solid 2px;
				    float: left;
				    margin-left: 52px;
				    text-align: center;
				    font-size: 10px;
    				line-height: 10px;
			}
			.foot{   
				width: 100%;
			    height: 20px;
			    border-bottom-right-radius: 11px;
			    border-bottom-left-radius: 11px;
			    background: rgba(0, 230, 255, 0.48);
			    float: left;
			    font-size: 7px;
			    line-height: 7px;
			    text-align: left;
			    padding-left: 2px;
			}
	</style>

	<page size="A4">
			
			<div class="body_card">
				<div class="inner_body_card">
					<div class="block">
						<div class="head">
							<img src='<?php echo base_url('assets/img/logo.png')?>'>
							<div class="head_text">University of</div>
							<div class="head_text_bottom">Management and Economics</div>

							<div class="small_bottom">Your success with national consciousness is our top prionity</div>
						</div>
						<div class="photo"></div>
						<table style="width: 145px;height: 94px;float:left;font-size: 9px;">
							
						  	<colgroup>
							    <col style="width: 28px;">
							    <col style="width:30px;">
							</colgroup>
							<tr>
								<td colspan="2"><div style="font-size:10px;">Name: MY SOKRENN</div></td>
							</tr>
							<tr>
								<td>Date of Birth</td>
								<td>: 01-October-1991</td>
							</tr>

							<tr>
								<td>Degree</td>
								<td>: Bachelor</td>
							</tr>
							<tr>
								<td>Year</td>
								<td>: 1, Promotion XII</td>
							</tr>
							<tr>
								<td>Issue Date</td>
								<td>: 26-Sep-2015</td>
							</tr>
							<tr>
								<td>Expire Date</td>
								<td>26-Sep-2016</td>
							</tr>
						</table>
						<div class="id">ID: 251288347</div>
						<div class="school_detail">
							School of English
						</div>
						<div class="free_space"></div>
						<div class="director">
							NORNG THA<br>Diriector
						</div>
						<div class="foot">
							Banteay Meanchey Campus, Cambodia. Tel:054-6666-669/012-911-988<br>
							Email:ume_bmc@yahoo.com Website:www.ume-bmc.edu.kh
							<div style="color:red;float:right;font-size: 5px;line-height: 3px;padding-right: 9px;">@2016 All right reserved</div>
						</div>
					</div>

					<div class="block">
						<div class="head">
							<img src='<?php echo base_url('assets/img/logo.png')?>'>
							<div class="head_text">University of</div>
							<div class="head_text_bottom">Management and Economics</div>

							<div class="small_bottom">Your success with national consciousness is our top prionity</div>
						</div>
						<div class="photo"></div>
						<table style="width: 145px;height: 94px;float:left;font-size: 9px;">
							
						  	<colgroup>
							    <col style="width: 28px;">
							    <col style="width:30px;">
							</colgroup>
							<tr>
								<td colspan="2"><div style="font-size:10px;">Name: MY SOKRENN</div></td>
							</tr>
							<tr>
								<td>Date of Birth</td>
								<td>: 01-October-1991</td>
							</tr>

							<tr>
								<td>Degree</td>
								<td>: Bachelor</td>
							</tr>
							<tr>
								<td>Year</td>
								<td>: 1, Promotion XII</td>
							</tr>
							<tr>
								<td>Issue Date</td>
								<td>: 26-Sep-2015</td>
							</tr>
							<tr>
								<td>Expire Date</td>
								<td>26-Sep-2016</td>
							</tr>
						</table>
						<div class="id">ID: 251288347</div>
						<div class="school_detail">
							School of English
						</div>
						<div class="free_space"></div>
						<div class="director">
							NORNG THA<br>Diriector
						</div>
						<div class="foot">
							Banteay Meanchey Campus, Cambodia. Tel:054-6666-669/012-911-988<br>
							Email:ume_bmc@yahoo.com Website:www.ume-bmc.edu.kh
							<div style="color:red;float:right;font-size: 5px;line-height: 3px;padding-right: 9px;">@2016 All right reserved</div>
						</div>
					</div>

					<div class="block">
						<div class="head">
							<img src='<?php echo base_url('assets/img/logo.png')?>'>
							<div class="head_text">University of</div>
							<div class="head_text_bottom">Management and Economics</div>

							<div class="small_bottom">Your success with national consciousness is our top prionity</div>
						</div>
						<div class="photo"></div>
						<table style="width: 145px;height: 94px;float:left;font-size: 9px;">
							
						  	<colgroup>
							    <col style="width: 28px;">
							    <col style="width:30px;">
							</colgroup>
							<tr>
								<td colspan="2"><div style="font-size:10px;">Name: MY SOKRENN</div></td>
							</tr>
							<tr>
								<td>Date of Birth</td>
								<td>: 01-October-1991</td>
							</tr>

							<tr>
								<td>Degree</td>
								<td>: Bachelor</td>
							</tr>
							<tr>
								<td>Year</td>
								<td>: 1, Promotion XII</td>
							</tr>
							<tr>
								<td>Issue Date</td>
								<td>: 26-Sep-2015</td>
							</tr>
							<tr>
								<td>Expire Date</td>
								<td>26-Sep-2016</td>
							</tr>
						</table>
						<div class="id">ID: 251288347</div>
						<div class="school_detail">
							School of English
						</div>
						<div class="free_space"></div>
						<div class="director">
							NORNG THA<br>Diriector
						</div>
						<div class="foot">
							Banteay Meanchey Campus, Cambodia. Tel:054-6666-669/012-911-988<br>
							Email:ume_bmc@yahoo.com Website:www.ume-bmc.edu.kh
							<div style="color:red;float:right;font-size: 5px;line-height: 3px;padding-right: 9px;">@2016 All right reserved</div>
						</div>
					</div>

					<div class="block">
						<div class="head">
							<img src='<?php echo base_url('assets/img/logo.png')?>'>
							<div class="head_text">University of</div>
							<div class="head_text_bottom">Management and Economics</div>

							<div class="small_bottom">Your success with national consciousness is our top prionity</div>
						</div>
						<div class="photo"></div>
						<table style="width: 145px;height: 94px;float:left;font-size: 9px;">
							
						  	<colgroup>
							    <col style="width: 28px;">
							    <col style="width:30px;">
							</colgroup>
							<tr>
								<td colspan="2"><div style="font-size:10px;">Name: MY SOKRENN</div></td>
							</tr>
							<tr>
								<td>Date of Birth</td>
								<td>: 01-October-1991</td>
							</tr>

							<tr>
								<td>Degree</td>
								<td>: Bachelor</td>
							</tr>
							<tr>
								<td>Year</td>
								<td>: 1, Promotion XII</td>
							</tr>
							<tr>
								<td>Issue Date</td>
								<td>: 26-Sep-2015</td>
							</tr>
							<tr>
								<td>Expire Date</td>
								<td>26-Sep-2016</td>
							</tr>
						</table>
						<div class="id">ID: 251288347</div>
						<div class="school_detail">
							School of English
						</div>
						<div class="free_space"></div>
						<div class="director">
							NORNG THA<br>Diriector
						</div>
						<div class="foot">
							Banteay Meanchey Campus, Cambodia. Tel:054-6666-669/012-911-988<br>
							Email:ume_bmc@yahoo.com Website:www.ume-bmc.edu.kh
							<div style="color:red;float:right;font-size: 5px;line-height: 3px;padding-right: 9px;">@2016 All right reserved</div>
						</div>
					</div>

					<div class="block">
						<div class="head">
							<img src='<?php echo base_url('assets/img/logo.png')?>'>
							<div class="head_text">University of</div>
							<div class="head_text_bottom">Management and Economics</div>

							<div class="small_bottom">Your success with national consciousness is our top prionity</div>
						</div>
						<div class="photo"></div>
						<table style="width: 145px;height: 94px;float:left;font-size: 9px;">
							
						  	<colgroup>
							    <col style="width: 28px;">
							    <col style="width:30px;">
							</colgroup>
							<tr>
								<td colspan="2"><div style="font-size:10px;">Name: MY SOKRENN</div></td>
							</tr>
							<tr>
								<td>Date of Birth</td>
								<td>: 01-October-1991</td>
							</tr>

							<tr>
								<td>Degree</td>
								<td>: Bachelor</td>
							</tr>
							<tr>
								<td>Year</td>
								<td>: 1, Promotion XII</td>
							</tr>
							<tr>
								<td>Issue Date</td>
								<td>: 26-Sep-2015</td>
							</tr>
							<tr>
								<td>Expire Date</td>
								<td>26-Sep-2016</td>
							</tr>
						</table>
						<div class="id">ID: 251288347</div>
						<div class="school_detail">
							School of English
						</div>
						<div class="free_space"></div>
						<div class="director">
							NORNG THA<br>Diriector
						</div>
						<div class="foot">
							Banteay Meanchey Campus, Cambodia. Tel:054-6666-669/012-911-988<br>
							Email:ume_bmc@yahoo.com Website:www.ume-bmc.edu.kh
							<div style="color:red;float:right;font-size: 5px;line-height: 3px;padding-right: 9px;">@2016 All right reserved</div>
						</div>
					</div>

					<div class="block">
						<div class="head">
							<img src='<?php echo base_url('assets/img/logo.png')?>'>
							<div class="head_text">University of</div>
							<div class="head_text_bottom">Management and Economics</div>

							<div class="small_bottom">Your success with national consciousness is our top prionity</div>
						</div>
						<div class="photo"></div>
						<table style="width: 145px;height: 94px;float:left;font-size: 9px;">
							
						  	<colgroup>
							    <col style="width: 28px;">
							    <col style="width:30px;">
							</colgroup>
							<tr>
								<td colspan="2"><div style="font-size:10px;">Name: MY SOKRENN</div></td>
							</tr>
							<tr>
								<td>Date of Birth</td>
								<td>: 01-October-1991</td>
							</tr>

							<tr>
								<td>Degree</td>
								<td>: Bachelor</td>
							</tr>
							<tr>
								<td>Year</td>
								<td>: 1, Promotion XII</td>
							</tr>
							<tr>
								<td>Issue Date</td>
								<td>: 26-Sep-2015</td>
							</tr>
							<tr>
								<td>Expire Date</td>
								<td>26-Sep-2016</td>
							</tr>
						</table>
						<div class="id">ID: 251288347</div>
						<div class="school_detail">
							School of English
						</div>
						<div class="free_space"></div>
						<div class="director">
							NORNG THA<br>Diriector
						</div>
						<div class="foot">
							Banteay Meanchey Campus, Cambodia. Tel:054-6666-669/012-911-988<br>
							Email:ume_bmc@yahoo.com Website:www.ume-bmc.edu.kh
							<div style="color:red;float:right;font-size: 5px;line-height: 3px;padding-right: 9px;">@2016 All right reserved</div>
						</div>
					</div>

					<div class="block">
						<div class="head">
							<img src='<?php echo base_url('assets/img/logo.png')?>'>
							<div class="head_text">University of</div>
							<div class="head_text_bottom">Management and Economics</div>

							<div class="small_bottom">Your success with national consciousness is our top prionity</div>
						</div>
						<div class="photo"></div>
						<table style="width: 145px;height: 94px;float:left;font-size: 9px;">
							
						  	<colgroup>
							    <col style="width: 28px;">
							    <col style="width:30px;">
							</colgroup>
							<tr>
								<td colspan="2"><div style="font-size:10px;">Name: MY SOKRENN</div></td>
							</tr>
							<tr>
								<td>Date of Birth</td>
								<td>: 01-October-1991</td>
							</tr>

							<tr>
								<td>Degree</td>
								<td>: Bachelor</td>
							</tr>
							<tr>
								<td>Year</td>
								<td>: 1, Promotion XII</td>
							</tr>
							<tr>
								<td>Issue Date</td>
								<td>: 26-Sep-2015</td>
							</tr>
							<tr>
								<td>Expire Date</td>
								<td>26-Sep-2016</td>
							</tr>
						</table>
						<div class="id">ID: 251288347</div>
						<div class="school_detail">
							School of English
						</div>
						<div class="free_space"></div>
						<div class="director">
							NORNG THA<br>Diriector
						</div>
						<div class="foot">
							Banteay Meanchey Campus, Cambodia. Tel:054-6666-669/012-911-988<br>
							Email:ume_bmc@yahoo.com Website:www.ume-bmc.edu.kh
							<div style="color:red;float:right;font-size: 5px;line-height: 3px;padding-right: 9px;">@2016 All right reserved</div>
						</div>
					</div>

					<div class="block">
						<div class="head">
							<img src='<?php echo base_url('assets/img/logo.png')?>'>
							<div class="head_text">University of</div>
							<div class="head_text_bottom">Management and Economics</div>

							<div class="small_bottom">Your success with national consciousness is our top prionity</div>
						</div>
						<div class="photo"></div>
						<table style="width: 145px;height: 94px;float:left;font-size: 9px;">
							
						  	<colgroup>
							    <col style="width: 28px;">
							    <col style="width:30px;">
							</colgroup>
							<tr>
								<td colspan="2"><div style="font-size:10px;">Name: MY SOKRENN</div></td>
							</tr>
							<tr>
								<td>Date of Birth</td>
								<td>: 01-October-1991</td>
							</tr>

							<tr>
								<td>Degree</td>
								<td>: Bachelor</td>
							</tr>
							<tr>
								<td>Year</td>
								<td>: 1, Promotion XII</td>
							</tr>
							<tr>
								<td>Issue Date</td>
								<td>: 26-Sep-2015</td>
							</tr>
							<tr>
								<td>Expire Date</td>
								<td>26-Sep-2016</td>
							</tr>
						</table>
						<div class="id">ID: 251288347</div>
						<div class="school_detail">
							School of English
						</div>
						<div class="free_space"></div>
						<div class="director">
							NORNG THA<br>Diriector
						</div>
						<div class="foot">
							Banteay Meanchey Campus, Cambodia. Tel:054-6666-669/012-911-988<br>
							Email:ume_bmc@yahoo.com Website:www.ume-bmc.edu.kh
							<div style="color:red;float:right;font-size: 5px;line-height: 3px;padding-right: 9px;">@2016 All right reserved</div>
						</div>
					</div>

					<div class="block">
						<div class="head">
							<img src='<?php echo base_url('assets/img/logo.png')?>'>
							<div class="head_text">University of</div>
							<div class="head_text_bottom">Management and Economics</div>

							<div class="small_bottom">Your success with national consciousness is our top prionity</div>
						</div>
						<div class="photo"></div>
						<table style="width: 145px;height: 94px;float:left;font-size: 9px;">
							
						  	<colgroup>
							    <col style="width: 28px;">
							    <col style="width:30px;">
							</colgroup>
							<tr>
								<td colspan="2"><div style="font-size:10px;">Name: MY SOKRENN</div></td>
							</tr>
							<tr>
								<td>Date of Birth</td>
								<td>: 01-October-1991</td>
							</tr>

							<tr>
								<td>Degree</td>
								<td>: Bachelor</td>
							</tr>
							<tr>
								<td>Year</td>
								<td>: 1, Promotion XII</td>
							</tr>
							<tr>
								<td>Issue Date</td>
								<td>: 26-Sep-2015</td>
							</tr>
							<tr>
								<td>Expire Date</td>
								<td>26-Sep-2016</td>
							</tr>
						</table>
						<div class="id">ID: 251288347</div>
						<div class="school_detail">
							School of English
						</div>
						<div class="free_space"></div>
						<div class="director">
							NORNG THA<br>Diriector
						</div>
						<div class="foot">
							Banteay Meanchey Campus, Cambodia. Tel:054-6666-669/012-911-988<br>
							Email:ume_bmc@yahoo.com Website:www.ume-bmc.edu.kh
							<div style="color:red;float:right;font-size: 5px;line-height: 3px;padding-right: 9px;">@2016 All right reserved</div>
						</div>
					</div>


					
				</div>
			</div>

	</page>

</div>


