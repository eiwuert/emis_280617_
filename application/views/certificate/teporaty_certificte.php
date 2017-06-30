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
			    font-family: khmerOSmuol;
			    src: url(../assets/img/fonts/KhmerOSmuol.ttf);
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
			.academic_confirmation{
			        padding: 48px 0px 0px 36px;
			}
			.inner_academic_confirmation{
					width: 732px;
					/*overflow: auto;*/
					float: left;
			}


			.logo{
				padding: 27px 0px 0px 87px;
			}
			.logo img{
				width:85px;
			}
			.body_logo{
    width: 311px;
   	overflow: auto;
    margin: -3px 0px 0px 0px;
    float: left;
    color:blue;
			}
			.logo_text{
    padding-left: 0px;
    margin-top: 3px;
    font-size: 16.1px;
    font-family: khmerOsMollight;
    letter-spacing: 0.2;
			}
			.logo_text_eng{
    padding-left: 0px;
    font-size: 14px;
    font-family: time_new_romen;
    margin-top: -2px;
    letter-spacing: 1.1;
			}
			.logo_text_kh{
    padding-left: 2px;
    font-size: 13px;
    font-family: khmerOScontent;
    margin-top: 0px;
    letter-spacing: 1.1;
			}
			.logo_text_no{
    padding-left: 2px;
    font-size: 13px;
    font-family: khmerOScontent;
    margin-top: 2px;
    letter-spacing: 1.1;
			}


			.body_kingdom{
				    float: right;
				    width: 230px;
				    margin: 0px 12px 0px 0px;
				    height: 170px;
				    font-family: khmerOsMollight;
				    color:blue;
			}
			.txt_kingdom{  
				    margin: -7px 0px 0px 12px;
				    font-family: khmerOsMollight;
				    font-size: 18.6px;
			}
			.txt_kingdom_eng{  
				    margin: 1px 0px 0px 21px;
				    font-family: time_new_romen;
				    letter-spacing: 0;
			}
			.txt_nation_kingdom{  
			    	margin: 0px 0px 0px 1px;
				    font-family: khmerOsMollight;
				    font-size: 16px;
				    letter-spacing: 0.9;
			}
			.txt_nation_kingdom_eng{  
				    margin: 1px 0px 0px 19px;
				    font-family: time_new_romen;
				    letter-spacing: 1.1px;
			}

			.title_academic{
				width:100%;
				overflow: auto;
			}


			.title_academic_top{
			    width: 623px;
			    text-align: center;
			    font-family: khmerOSmuol;
			    font-size: 20px;
			    margin-top: -23px;
			    margin-left: 97px;
			    position: absolute;
			}
			.confirm_top{
			    width: 601px;
			    text-align: center;
			    font-family: khmerOSmuol;
			    font-size: 18px;
			    margin-left: 97px;
			    color: blue;
			    margin-top: 77px;
			}
			.block_photo{
				width: 147px;
				height: 200px;
				float: left;
				text-align: center;
				line-height: 38px;
			}
			.photo{
			    width: 99px;
			    height: 126px;
			    float: left;
			    border: solid 1px #000;
			    text-align: center;
			    line-height: 124px;
			    margin: 0px 0px 0px 24px;
			}
			
			.block_view{
				width: 578px;
				overflow: auto;
				float: right;
				padding-left: 7px;
				padding-top: 13px;
				line-height: 7px;
			}
			.float_left{float:left;}
			.name{	
			    float: left;
			    width: 122px;
			    font-family: khmerOScontent;
			    position: relative;
			    line-height: 2.6;
			    top: -15px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
			}
			.name_eng{	
			    float: left;
			    width: 162px;
			    font-family: khmerOScontent;
			    position: relative;
			    line-height: 2.6;
			    top: -15px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
			}	
			.sex{	
			    float: left;
			    width: 119px;
			    font-family: khmerOScontent;
			    position: relative;
			    line-height: 2.6;
			    top: -15px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
			}

			.nation{	
			    float: left;
			    width: 162px;
			    font-family: khmerOScontent;
			    position: relative;
			    line-height: 2.6;
			    top: -15px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
			}	
			.dob{
			    float: left;
			    width: 400px;
			    font-family: khmerOScontent;
			    position: relative;
			    line-height: 2.6;
			    top: -15px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
			}
			.pob{
			    float: left;
			    width: 400px;
			    font-family: khmerOScontent;
			    position: relative;
			    line-height: 2.6;
			    top: -15px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
			}
			.fname{
			    float: left;
			    width: 400px;
			    font-family: khmerOScontent;
			    position: relative;
			    line-height: 2.6;
			    top: -15px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
			}
			.mname{
			    float: left;
			    width: 400px;
			    font-family: khmerOScontent;
			    position: relative;
			    line-height: 2.6;
			    top: -15px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
			}
			.confirm_view{
			    width: 585px;
			    float: right;
			    font-family: khmerOScontent;
			    font-size: 14.5px;
			    text-indent: 7px;
			    margin-top: 5px;
			}
			.block_university{
				    width: 579px;
				    float: right;
				    font-family: khmerOScontent;
    				line-height: 33px;
			}
			.university{
			    float: left;
			    width: 400px;
			    font-family: khmerOScontent;
			    position: relative;
			    line-height: 2.6;
			    top: 0px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;561px
			}
			.can_use{
			    width: 585px;
			    float: right;
			    font-family: khmerOSmuol;
			    font-size: 14.5px;
			    text-indent: 7px;
			    margin-top: -4px;
			}

			.note{
				width: 585px;
				float: left;
				font-family: khmerOScontent;
				font-size: 13px;
				margin-top: -1px;
				text-align: left;
				margin-left: 20px;
			}
			.date{
			    width: 362px;
			    float: right;
			    font-family: khmerOScontent;
			    font-size: 15px;
			    margin-top: 7px;
			    text-align: left;
			    margin-left: 20px;
			}
			.director{
			    width: 376px;
			    float: right;
			    font-family: khmerOSmuol;
			    font-size: 15px;
			    margin-top: -3px;
			    text-align: left;
			    text-indent: 122px;
			}
	</style>

	<page size="A4">
			
			<div class="academic_confirmation">
				<div class="inner_academic_confirmation">
						<div class="body_logo">
							<div class='logo'>
								<img src="<?php echo base_url('assets/img/logo.png')?>">
							</div>
							<div class="logo_text">សកលវិទ្យាល័យគ្រប់គ្រង និង​ សេដ្ឋកិច្ច</div>
							<div class="logo_text_eng">University of Management and Economics</div>
							<div class="logo_text_kh">សាខាខេត្តបន្ទាយមានជ័យ</div>
							<div class="logo_text_no">លេខោ:.............................</div>
						</div>

						<div class="body_kingdom">				
							<div class="txt_kingdom">ព្រះរាជាណាចក្រកម្ពុជា</div>
							<div class="txt_kingdom_eng">KINGDOM OF CAMBODIA</div>
							<div class="txt_nation_kingdom">ជាតិ សាសនា ព្រះមហាក្សត្រ</div>
							<div class="txt_nation_kingdom_eng">NATION RELIGION KING</div>
						</div>

						<div class="title_academic">
							<div class="title_academic_top">វិញ្ញាបនបត្របណ្តោះអាសន្នថ្នាក់បរិញ្ញាបត្រ<br/><span style='letter-spacing: -3px;'>សាកលវិទ្យាធិការនៃសាកលវិទ្យាល័យគ្រប់គ្រង និង សេដ្ឋកិច្ច</div>
							<div class="confirm_top">បញ្ជាក់ថាៈ</div>
						</div>

						<div class="block_photo">
							ID: 2508003034
							<div class="photo">
								4 X 6
							</div>
						</div>

						<div class="block_view">
							<div class="float_left">និស្សិតឈ្មោះ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="name">អិន ចាន់រស្មី</div><div class="float_left">អក្សរឡាតាំង&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="name_eng">IN CHANRAKSMEY</div><br/>
							<div class="float_left">ភេទ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="sex">ស្រី</div><div class="float_left">សញ្ជាតិ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="nation">ខ្មែរ</div><br/>
							<div class="float_left">ថ្ងៃខែឆ្នាំកំណើត&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="dob">ថ្ងៃទី២៣ ខែមេសា ឆ្នាំ១៩៩០</div><br/>
							<div class="float_left">ទីកន្លែងកំណើត&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="pob">ថ្ងៃទី២៣ ខែមេសា ឆ្នាំ១៩៩០</div><br/>
							<div class="float_left">ទីកន្លែងកំណើត&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="pob">ខេត្ត បន្ទាយមានជ័យ</div><br/>
							<div class="float_left">ឪពុកឈ្មោះ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="fname">លឿម យ៉ុង</div><br/>
							<div class="float_left">ម្តាយឈ្មោះ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="mname">វ៉ាន គឹមសាន់</div><br/>
							
						</div>

						<div class="confirm_view">
							បានបំពេញគ្រប់លក្ខខណ្ឌដោយជោគជ័យ ក្នុងការប្រឡងបញ្ចប់ការសិក្សាថ្នាក់ <span​ style='font-family:khmerOsMollight'>បរិញ្ញាប័ត្រ</span>
						</div>

						<div class="block_university">
							<div class="float_left">មហាវិទ្យាល័យ&nbsp;:</div><div class="university">គ្រប់គ្រងពាណិជ្ជកម្ម</div><br/>
							<div class="float_left">ឯកទេស&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="university">គណនេយ្យ</div><br/>
							<div class="float_left">សម័យប្រឡង&nbsp;&nbsp;:</div><div class="university">ថ្ងៃទី០៥ ខែមិថុនា ឆ្នាំ២០១៥</div><br/>
						</div>
						<div class="can_use">
							វិញ្ញាបនបត្រនេះចេញជូនសាមីជន យកទៅប្រើប្រាស់តាមការដែលអាចប្រើបាន។
						</div>

						<div class="note">
							<div style='font-family:khmerOsMollight;float:left'>កំណត់សម្គាល់ៈ</div> វិញ្ញាបនបត្រនេះមិនចេញជូនជាលើកទី២ទេ។
						</div>

						<div class="date">
							បន្ទាយមានជ័យ ថ្ងៃទី…………… ខែ……………… ឆ្នាំ២០១…
						</div>
						<div class="director">
							សាកលវិទ្យាធិការ
						</div>

						

				</div>
			</div>

	</page>

</div>


