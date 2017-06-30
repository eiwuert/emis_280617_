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
			@font-face {
			    font-family: cambria;
			    src: url(../assets/img/fonts/cambria.ttc);
			}			
			@font-face {
			    font-family: lhandw;
			    src: url(../assets/img/fonts/LHANDW.TTF);
			}
		
			@font-face {
			    font-family: nirmalaB;
			    src: url(../assets/img/fonts/NirmalaB.ttf);
			}
			.transcript{
			    padding: 67px 0px 0px 53px;
			}
			.inner_transcript{
			    width: 688px;
			    height: 984px;
			    float: left;	
			}
			.title_top{
			    text-align: center;
			    font-family: cambria;
			    font-weight: bolder;
			    font-size: 26px;
			    line-height: 47px;
			    padding-top: 13px;
			    letter-spacing: 6px;
			    text-shadow: 2px 1px 0px #7B7D17;
			    color: #787B14;
			}

			.title_bottom{
			    text-align: center;
			    font-family: cambria;
			    font-weight: bolder;
			    font-size: 26px;
			    line-height: 47px;
			    padding-top: 13px;
			    letter-spacing: 6px;
			    text-shadow: 2px 1px 0px #7B7D17;
			    color: #986049;
			}
			

			.date_top{
			    text-align: right;
			    font-family: lhandw;
			    font-weight: bolder;
			    font-size: 15px;
			    line-height: 47px;
			    padding-top: 29px;
			    margin-right: 35px;
			}
			.welcome_top{
				font-family: nirmalaB;
			    width: 100%;
			    text-align: center;
			    line-height: 83px;
			    font-size: 29px;
			    color:#808080;
			}
			.desc{
				text-align: left;
				float: left;
				width: 475px;
				margin-left: 34px;
				font-family: lhandw;
				font-size: 18px;
				line-height: 35px;
				padding-top: 29px;
			}

			.photo{
			    width: 142px;
			    height: 131px;
			    text-align: center;
			    font-size: 12px;
			    line-height: 4.5;
			    margin: 92px 37px 0px 0px;
			    float: right;
			}
			.inner_photo{
			    width: 75px;
			    height: 93px;
			    border: solid 1px rgba(97, 97, 97, 0.93);
			    text-align: center;
			    line-height: 9.5;
			    font-size: 12px;
			    margin-left: 29px;
			}
			.end_name{
			    width: 100%;
			    margin: 98px 0px 0px 0px;
			    float: left;
			}
			.e_name{
			    width: 206px;
			    margin: 0px 0px 0px 105px;
			    float: left;
			    text-align: center;
			    border-top: solid 1px #000;
			    font-size: 20px;
			    font-family: cambria;
			    font-weight: bold;
			}
			.director{
			    width: 206px;
			    margin: 0px 0px 0px 105px;
			    text-align: center;
			    border-top: solid 1px #000;
			    font-size: 20px;
			    font-family: lhandw;
			    font-weight: bold;
    			line-height: 32px;
			}
	</style>

	<page size="A4">
			
			<div class="transcript">
				<div class="inner_transcript">
					<div class="title_top">
						University of Management<br>
						and Economics
					</div>
					<div class="title_bottom">
						Banteay Meanchey Campus
					</div>


					<div class="date_top">
						December 23, 2014
					</div>

					<div class="welcome_top">
						TO WHOM IT MAY CONCERN
					</div>

					<div class="desc">
						This is to certify that  <span style='color:#774F28; font-family: nirmalaB;font-size: 20px;'>Mr. Huy Vantha</span>, born on September 28, 1996 in  Banteay Meanchey Province, Cambodia, has successfully completed General English Program (GEP) <span style='font-family: nirmalaB;font-size: 20px;'>LEVEL 6</span> in the academic year 2013-2014.<br/>
						This is a twelve-level Program conducted at the Department of English, University of Management and Economics Banteay Meanchey (UME_BMC).

					</div>

					<div class="photo">
						<div class="inner_photo">
							4 X 6
						</div>
						<center>No:...........................ume.bmc</center>
					</div>

					<div class="end_name">
						<div class="e_name">
							Mr. Norng Tha
						</div>
						<div class="director">
							Director
						</div>
					</div>


				</div>
			</div>

	</page>

</div>


