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
			.academic_confirmation{
			        padding: 48px 0px 0px 36px;
			}
			.inner_academic_confirmation{
					width: 732px;
					overflow: auto;
					float: left;
					/*background: rgba(49, 255, 0, 0.4);*/
			}


			.logo{
				padding: 27px 0px 0px 87px;
			}
			.logo img{
				width:85px;
			}
			.body_logo{
    width: 311px;
    /*background: rgba(255, 255, 0, 0.69);*/
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
				    /*background: rgba(0, 77, 255, 0.39);*/
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
				/*background: rgba(0, 255, 198, 0.62);*/
			}


			.title_academic_top{
			    width: 268px;
			    /*background: rgba(255, 255, 0, 0.51);*/
			    text-align: center;
			    margin-left: 222px;
			    font-family: khmerOsMollight;
			    font-size: 24.5px;
			    margin-top: 8px;
			    position: absolute;
			}
			.title_academic_bottom{
			    width: 268px;
			    /*background: rgba(255, 255, 0, 0.51);*/
			    text-align: center;
			    margin-left: 222px;
			    font-family: time_new_romen;
			    font-size: 15.6px;
			    margin-top: 46px;
			}

			.view_top_left{
				width: 348px;
				height: 72px;
				/*background: rgba(0, 124, 255, 0.28);*/
				float: left;
				font-family: khmerOsMollight;
				font-size: 14px;
			}

			.view_top_right{
			    width: 382px;
			    height: 72px;
			    /*background: rgba(255, 255, 0, 0.28);*/
			    float: left;
			    font-weight: bold;
			    font-size: 14px;
			}

			.display_top_left{				
				width: 348px;
				overflow: hidden;
				/*background: rgba(179, 255, 0, 0.79);*/
				float: left;
				font-family: khmerOScontent;
				font-size: 14px;
				line-height: 27px;
			}
			.display_top_right{				
			    width: 382px;
			    overflow: hidden;
			    /*background: rgba(179, 255, 0, 0.79);*/
			    float: left;
			    font-family: khmerOScontent;
			    font-size: 14px;
			    line-height: 27px;
			}
			.clear_left{
			    padding-left: 26px;
			    padding-top: 10px;
			}
			.clear_right{
			    padding-left: 13px;
			    padding-top: 12px;
			}
			.float-left{float:left;}
			.name{
			    width: 267px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    text-align: center;
			    font-family: khmerOsMollight;
			    font-size: 17px;
			}
			.gender{
			    width: 49px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}

			.no{
			    width: 116px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    text-align: center;
			    font-family: khmerOsMollight;
			}
			.nation_kh{
			    width: 23px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			}
			.dob{
			    width: 218px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}
			.pob{
			    width: 216px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}

			.fname{
			    width: 141px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}
			.jobf{
			    width: 60px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}

			.mname{
			    width: 141px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}
			.jobm{
			    width: 60px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}
			.stay_in{
			    width: 176px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}
			.stay_in_more{
			    width: 300px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}
			.study_year{
			    width: 39px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}
			.class{
			    width: 151px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}
			.university{
			    width: 220px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}
			.major{
			    width: 252px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}
			.academic_year{
			    width: 139px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			}

			/**/

			.name_eng{
			    width: 237px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    text-align: center;
			    font-family: khmerOsMollight;
			    font-size: 17px;
			    font-weight: bold;
			}
			.gender_eng{
			    width: 50px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}

			.no_eng{
			    width: 109px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    text-align: center;
			    font-family: khmerOsMollight;
			    font-weight: bold;
			}
			.nation_eng{
			    width: 64px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    font-weight: bold;
			    text-align: center;
			}
			.dob_eng{
			    width: 254px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}
			.pob_eng{
			    width: 254px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}

			.fname_eng{
			    width: 123px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}
			.jobf_eng{
			    width: 60px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}

			.mname_eng{
			    width: 120px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}
			.jobm_eng{
			    width: 60px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}
			.stay_in_eng{
			    width: 235px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}
			.stay_in_more_eng{
			    width: 346px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}
			.study_year_eng{
			    width: 26px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}
			.class_eng{
			    width: 114px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}
			.university_eng{
			    width: 277px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}
			.major_eng{
			    width: 289px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}
			.academic_year_eng{
			    width: 212px;
			    height: 25px;
			    border-bottom: dotted 1px #000;
			    float: left;
			    position: relative;
			    margin-top: -5px;
			    line-height: 37px;
			    font-family: khmerOsMollight;
			    text-align: center;
			    font-weight: bold;
			}
			.confirm{
				float: left;
				/*background*/: rgba(206, 0, 255, 0.21);
				font-family: khmerOScontent;
				font-size: 14px;
				padding: 11px 0px 0px 51px;
				letter-spacing: 1px;
			}

			.confirm_eng{
				float: left;
				/*background*/: rgba(206, 0, 255, 0.21);
				font-family: time_new_romen;
				font-size: 14px;
				padding: 1px 0px 0px 51px;
				letter-spacing: 0.3px;
			}
			.director_date{
			    float: right;
			    /*background*/: rgba(206, 0, 255, 0.21);
			    font-family: khmerOScontent;
			    font-size: 14px;
			    padding: 0px 4px 0px 0px;
			}
			.campuse{
				width:100%;
			    float: left;
			    /*background*/: rgba(206, 0, 255, 0.21);
			    font-family: time_new_romen;
			    font-size: 14px;
			    padding: 1px 0px 0px 0px;
			    text-align: right;
			}
			.director{				
			    float: right;
			    /*background*/: rgba(206, 0, 255, 0.21);
			    padding-right: 72px;
			}

			.director_kh{
				width:100%;
			    float: left;
			    /*background*/: rgba(206, 0, 255, 0.21);
			    font-family: khmerOsMollight;
			    font-size: 16px;
			    padding: 1px 4px 0px 0px;
			}
			.director_en{
				width:100%;
			    float: left;
			    /*background*/: rgba(206, 0, 255, 0.21);
			    font-family: time_new_romen;
			    font-size: 16px;
			    padding: 4px 4px 0px 0px;
			}
			.inner_photo{
			    width: 73px;
			    height: 106px;
			    border: solid 1px rgba(97, 97, 97, 0.93);
			    text-align: center;
			    float: left;
			    line-height: 9.5;
			    font-size: 12px;
			    margin: 15px 0px 0px 101px;
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
							<div class="title_academic_top">លិខិតបញ្ជាក់ការសិក្សា</div>
							<div class="title_academic_bottom">ACADEMIC CONFIRMATION</div>
						</div>

						<div class="view_top_left">
							<div style="padding: 4px 0px 0px 18px;text-align: center;">
								នាយកសាខាសកលវិទ្យាល័យ<br>
								គ្រប់គ្រង និង សេដ្ឋកិច្ច បញ្ចាក់ថា:
							</div>
						</div>
						<div class="view_top_right">
							<div style="padding: 1px 0px 0px 5px;text-align: center;line-height: 2;">
								DIRECTOR OF UNIVERSITY OF<br>
								MANAGEMENT AND ECONOMICS CERTIFIES THAT:
							</div>
						</div>

						<!--  -->

						<div class="display_top_left">
							<div class="clear_left">
								<div class="float-left">ឈ្មោះ</div><div class="name">ប្រប ជឿន</div><br>
								<div class="float-left">ភេទ</div><div class="gender">ប្រុស</div><div class="float-left">អត្តលេខ</div><div class="no">២៣៤២៣១</div><div class="float-left">សញ្ជាតិ</div><div class="nation_kh">ខ្មែរ</div><br>
								<div class="float-left">ថ្ងៃខែឆ្នាំកំណើត</div><div class="dob">១១​ មករា ១៩៨០</div><br>
								<div class="float-left">ទីកន្លែងកំណើត</div><div class="pob">សសស</div><br>
								<div class="float-left">ឪពុកឈ្មោះ</div><div class="fname">លាក់ អាន</div>​<div class="float-left">មុខរបរ</div><div class="jobf">កសិករ</div><br>
								<div class="float-left">ម្ដាយឈ្មោះ</div><div class="mname">លាក់ អាន</div>​<div class="float-left">មុខរបរ</div><div class="jobm">កសិករ</div><br>
								<div class="float-left">អាសួយដឍានបច្ចុប្បន្ន</div><div class="stay_in">ភូមិរំដួល ឃុំភ្នំលៀប​</div>​<br>
								<div class="stay_in_more">ស្រុកព្រះនេត្រព្រះខេត្របន្ទាយមានជ័យ</div>​<br>
								<div class="float-left">កុំពុងសិក្សាឆ្នាំទី</div><div class="study_year">៣</div>​<div class="float-left">ថ្នាក់</div><div class="class">បរិញ្ញាប័ត្រ</div>​<br>
								<div class="float-left">មហាវិទ្យាល័យ</div><div class="university">សេដ្ឍកិច្ច</div>​<br>
								<div class="float-left">ឯកទេស</div><div class="major"> ល </div>​<br>
								<div class="float-left">ក្នុងឆ្នាំសិក្សា</div><div class="academic_year"> ២០១៥-២០១៦ </div>​<div class="float-left">ពិតប្រាកដមែន។</div>
							</div>
						</div>
						<div class="display_top_right">
							<div class="clear_right">
								<div class="float-left">Student's Name:</div><div class="name_eng">BRAB CHEOURN</div><br>
								<div class="float-left">Sex:</div><div class="gender_eng">M</div><div class="float-left">ID:</div><div class="no_eng">12345</div><div class="float-left">Nationality:</div><div class="nation_eng">Khmer</div><br>
								<div class="float-left">Date of Birth:</div><div class="dob_eng">12-Sep-1998</div><br>
								<div class="float-left">Place of Birth</div><div class="pob_eng">ABC</div><br>
								<div class="float-left">Father's Name</div><div class="fname_eng">LEAK AN</div>​<div class="float-left">Occuption</div><div class="jobf_eng">Farmer</div><br>
								<div class="float-left">Mother's Name</div><div class="mname_eng">LEAK AN</div>​<div class="float-left">Occuption</div><div class="jobm_eng">Farmer</div><br>
								<div class="float-left">Current Address</div><div class="stay_in_eng">Romdul Village, Ampel Commune</div>​<br>
								<div class="stay_in_more_eng">Preah Net Preah Districe, Banteaymean Chey Provice.</div>​<br>
								<div class="float-left">Is the</div><div class="study_year_eng">3rd</div>​<div class="float-left">Year Student of the</div><div class="class_eng">Bachelor</div>degree​<br>
								<div class="float-left">School of:</div><div class="university_eng">Economic</div>​<br>
								<div class="float-left">Major In</div><div class="major_eng"> Economic </div>​<br>
								<div class="float-left">in the academic year</div><div class="academic_year_eng"> 2015-2016 </div>​
							</div>
						</div>
						<!--  -->
						<div class="confirm">
							លិខិតនេះចេញជូនសាមីខ្លួនប្រើប្រាស់តាមផ្លូវការដែលអាចប្រើបាន។
						</div>
						<div class="confirm_eng">
							This confirmation is issued to the bearer for any official purpose it may serve.
						</div>

						<div class="director_date">
							សាខាបន្ទាយមានជ័យ, ថ្ងៃទី…………ខែ……………ឆ្នាំ២០១… 
						</div>
						<div class="campuse">
							Banteay Meanchey Campus,.................................................
						</div>

						<div class="director">
							<div class="director_kh">
								នាយក
							</div>
							<div class="director_en">
								Director
							</div>
						</div>
						<div class="inner_photo">
							4 X 6
						</div>

				</div>
			</div>

	</page>

</div>


