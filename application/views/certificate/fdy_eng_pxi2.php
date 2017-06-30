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
			@font-face {
			    font-family: gothic;
			    src: url(../assets/img/fonts/GOTHIC.TTF);
			}
			#body_page{
				    padding: 94px 72px;
				    color:#333399;
			}	
			#inner_body{
				    width: 970px;
				    height: 552px;
			}
			.float_left{float:left;}
			.left_side{
				float: left;
				width:452px;
				height:200px;
			}
			.right_side{
				float: right;
				width:434px;
				height:200px;
			}

			.boss{
		    	margin: 0px 0px 0px 188px;
			    font-family: khmerOSmuol;
			    font-size: 15px;

			}
			.confirm{				
			    margin: 4px 0px 0px 181px;
			    font-family: khmerOScontent;
			    font-size: 17px;
			    font-weight: bold;
			    letter-spacing: 0.6px;
			}
			.boss_eng{
			    margin: 0px 0px 0px 178px;
			    font-family: gothic;
			    font-size: 19px;
			    font-weight: bolder;
			}
			.confirm_eng{		
			    margin: 15px 0px 0px 164px;
			    font-family: gothic;
			    font-size: 19px;
			}

			.body_view{
			    width: 100%;
			    float: left;
			    margin: 40px 0px 0px 9px;
			    font-family: khmerOScontent;
			    font-size: 15px;
			    line-height: 33px;
			    letter-spacing: 2px;
			}
			.float_left{float:left;}
			.name{	
			    float: left;
			    width: 183px;
			    font-family: khmerOsMollight;
			    position: relative;
			    line-height: 2.6;
			    top: -5px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			}	
			.sex{
			    float: left;
			    width: 98px;
			    font-family: khmerOsMollight;
			    position: relative;
			    line-height: 2.6;
			    top: -5px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			}
			.body_view_right{
			    width: 100%;
			    float: left;
			    margin: 46px 0px 0px 9px;
			    font-family: time_new_romen;
			    font-size: 18px;
			    line-height: 33px;
			    letter-spacing: 2px;
			}
			.name_eng{	
			    float: left;
			    width: 197px;
			    font-family: time_new_romen;
			    position: relative;
			    line-height: 2.6;
			    top: -2px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
			}	
			.sex_eng{
			    float: left;
			    width: 98px;
			    font-family: time_new_romen;
			    position: relative;
			    line-height: 2.6;
			    top: -5px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
			}


			.confirm_more{
			    font-size: 15px;
			    line-height: 29px;
			    margin-top: 17px;
			    margin-left: 0px;
			    letter-spacing: 1;
			    margin-bottom: 13px;
			}
			.confirm_more_eng{
			    font-size: 15px;
			    line-height: 20px;
			    margin-top: 17px;
			    margin-left: 0px;
			    margin-bottom: 13px;
			    font-family: gothic;
			}
			.photo{
			    width: 91px;
			    height: 113px;
			    float: left;
			    border: solid 1px #000;
			    margin: 28px 14px;
			    line-height: 116px;
			    text-align: center;
			}
			.date{
			    margin-top: 56px;
			    margin-left: 5px;
			    float: left;
			    font-size: 14px;
			    font-family: khmerOScontent;
			}
			.date_eng{
				margin-top: 68px;
				margin-left: 5px;
				float: right;
				font-size: 14px;
				font-family: khmerOScontent;
				letter-spacing: 0px;
			}
			/**/

			

	</style>

	<page size="A4" layout="portrait">
			<div id="body_page">
				<div id="inner_body">
				<!-- start -->					
						<div class="left_side">
							<div class="boss">នាយក</div>
							<div class="confirm">បញ្ជាក់ថា :</div>
							<div class="body_view">
								<div class="float_left">និស្សិតឈ្មោះ&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="name">ជឿន ចាន់ឡី</div><div class="float_left">ភេទ&nbsp;:</div><div class="sex">ប្រុស</div>
								<div class="float_left">ថ្ងៃខែឆ្នាំកំណើត 	:</div><div class="name">ជឿន ចាន់ឡី</div>
								<div class="float_left confirm_more">បានបញ្ចប់ថ្នាក់ឆ្នាំសិក្សាមូលដ្ឋានដោយជោគជ័យនៅសាកលវិទ្យាល័យ<br/>
								គ្រប់គ្រង និង សេដ្ឋកិច្ច ក្នុងឆ្នាំសិក្សា ២០១៣-២០១៤។</div>
								<div class="float_left confirm_more">វិញ្ញាបនបត្រនេះ ប្រគល់ជូនសាមីជន ដើម្បីយកទៅប្រើប្រាស់តាម<br/>
								ដែលអាចប្រើបាន ។</div>
							</div>

							<div class="photo">
								4 X 6
							</div>
							<div class="date">
								បន្ទាយមានជ័យ.ថ្ងៃទី...........ខែ.................ឆ្នាំ២០១៤
							</div>
						</div>			
						<div class="right_side">
							
							<div class="boss_eng">DIRECTOR</div>
							<div class="confirm_eng">Certifies that</div>
							<div class="body_view_right">
								<div class="float_left">Name:</div><div class="name_eng">Leang Makara</div><div class="float_left">Sex:</div><div class="sex_eng">Male</div><br/>
								<div class="float_left">Name:</div><div class="name_eng">23-January-1996</div><br/>
								<div class="float_left confirm_more_eng">Has successfully completed Foundation Year<br/>
																	Course at <b>University of Management and</b><br/>
																	<b>Economics in  2013-2014<b/>  academic year.</div>
								<div class="float_left confirm_more_eng">This certificate is presented to the bearer with all
																	right and privileges there to pertaining.</div>	

								<div class="date_eng">
									  Issued at Banteay Meanchey, date ......... /............../ 2014
								</div>								
								
							</div>
						</div>
				<!-- stop -->
				</div>
			</div>

	</page>

</div>


