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
<script type="text/javascript">
   jQuery(document).ready(function($) {
      	if (window.history && window.history.pushState) {
	        window.history.pushState('forward', null, null);
	        $(window).on('popstate', function() {
	            window.location.href = "<?php echo site_url('student_print_form')?>";
	        });
      	}
    });
</script>
<input type="button" value="Print Div" onclick="PrintElem('#mydiv')" />
<div id="mydiv">
	<style type="text/css">
			body {
			  background: rgb(204,204,204);
			}
			page {
			  background: white;
			  background-image: url('<?php echo $base_css_parth?>assets/img/transcript.png');
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
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/KhmerOSmuollight.ttf);
			}
			@font-face {
			    font-family: ahronbd;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/ahronbd.ttf);
			}
			@font-face {
			    font-family: khmerOScontent;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/KhmerOScontent.ttf);
			}
			@font-face {
			    font-family: time_new_romen;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/times.ttf);
			}
			@font-face {
			    font-family: coprgtb;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/COPRGTB.TTF);
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
	<?php if($get_query->num_rows() > 0 ):?>
		<?php $count = $get_query->num_rows()?>
			<?php $p = 0 ?>
				<?php $b = 0?>
				<?php for ($i=0; $i < $count ; $i++): ?>
					<?php $limit = ($i == 0)? 0 : $p+=1;?>
							<?php $n = 0?>
							<?php $s = ''?>
							<?php foreach(array_slice($get_query->result(), $limit, 1) as $key=>$row ): ?>
								<?php
									$n++;
									$name = $row->stu_last_name.(isset($row->stu_middle_name)? '&nbsp;'.$row->stu_middle_name.'&nbsp;' : '&nbsp;').$row->stu_first_name;
									$name_kh = $row->stu_last_name_kh.(isset($row->stu_middle_name_kh)? '&nbsp;'.$row->stu_middle_name_kh.'&nbsp;' : '&nbsp;').$row->stu_first_name_kh;
									$stu_dob = date_format(date_create($row->stu_dob),"j-F-Y");
									$stu_gender= $row->stu_gender;
									$get_gender = ($stu_gender == 'Male')? 'M':'F.';
									$get_gender_kh = ($stu_gender == 'Male')? 'ប្រុស':'ស្រី.';
									$level_name = $row->level_name;
									$level_name_kh = $row->level_name_kh;
									$section_name = $row->section_name;
									$stu_unique_id = $row->stu_acad_stu_acad_card;
									$stu_birthplace = $row->stu_birthplace;
									$university_name = $row->university_name;
									$university_name_kh = $row->university_name_kh;
									$university_id = $row->university_id;
									$skill_name = $row->skill_name;
									$skill_name_kh = $row->skill_name_kh;
									$nationality_name_kh = $row->nationality_name_kh;
									$nationality_name = $row->nationality_name;
									$address = $row->stu_cadd;
									$address_kh = $row->stu_cadd_kh;

                  $yy= date_format(date_create($row->stu_dob),"Y");
                  $mm= date_format(date_create($row->stu_dob),"m");
                  $dd= date_format(date_create($row->stu_dob),"d");
                  $d1 = substr($dd,0,1);
                  $d2 = substr($dd,1,1);
                  $y1 = substr($yy,0,1);
                  $y2 = substr($yy,1,1);
                  $y3 = substr($yy,2,1);
                  $y4 = substr($yy,3,1);
                  $get_month = substr($mm,1,1);
                  $months = array(1=>'មករា',2=>'កុម្ភះ',3=>'មីនា',4=>'មេសា',5=>'ឧសភា',6=>'មិថុនា',7=>'កក្ដា',8=>'សីហា',9=>'កញ្ញា',10=>'តុលា',11=>'វិច្ឆិកា',12=>'ធ្នូរ');
                  $softConv = array (0=>'០',1=>'១',2=>'២',3=>'៣',4=>'៤',5=>'៥',6=>'៦',7=>'៧',8=>'៨',9=>'៩');
                  $stu_dob_kh = $softConv[(int)$d1].$softConv[(int)$d2].'&nbsp;'.$months[(int)$get_month].'&nbsp;'.$softConv[(int)$y1].$softConv[(int)$y2].$softConv[(int)$y3].$softConv[(int)$y4];
								?>
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
												<div class="logo_text_no"><div style="float:left">លេខ:</div><div style="border-bottom:dotted 1px #ccc;width: 132px;float:left;text-align:center;margin-top: 5px;line-height: 12px;"><?php echo ($id_academic_confirm)? sprintf("%07s", $id_academic_confirm++) : "&nbsp;" ?></div></div>
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
													<div class="float-left">ឈ្មោះ</div><div class="name"><?php echo $name_kh?></div><br>
													<div class="float-left">ភេទ</div><div class="gender"><?php echo $get_gender_kh?></div><div class="float-left">អត្តលេខ</div><div class="no"><?php echo $stu_unique_id?></div><div class="float-left">សញ្ជាតិ</div><div class="nation_kh"><?php echo $nationality_name_kh?></div><br>
													<div class="float-left">ថ្ងៃខែឆ្នាំកំណើត</div><div class="dob"><?php echo $stu_dob_kh?></div><br>
													<div class="float-left">ទីកន្លែងកំណើត</div><div class="pob"><?php echo $stu_birthplace?></div><br>
													<div class="float-left">ឪពុកឈ្មោះ</div><div class="fname">no db</div>​<div class="float-left">មុខរបរ</div><div class="jobf">no db</div><br>
													<div class="float-left">ម្ដាយឈ្មោះ</div><div class="mname">no db</div>​<div class="float-left">មុខរបរ</div><div class="jobm">no db</div><br>
													<div class="float-left">អាសួយដឍានបច្ចុប្បន្ន</div><div class="stay_in"><?php echo $address_kh?></div>​<br>
													<!-- <div class="stay_in_more">ស្រុកព្រះនេត្រព្រះខេត្របន្ទាយមានជ័យ</div>​<br> -->
													<div class="float-left">កុំពុងសិក្សាឆ្នាំទី</div><div class="study_year"></div>​<div class="float-left">ថ្នាក់</div><div class="class"><?php echo $level_name_kh?></div>​<br>
													<div class="float-left">មហាវិទ្យាល័យ</div><div class="university"><?php echo $university_name_kh?></div>​<br>
													<div class="float-left">ឯកទេស</div><div class="major"> <?php echo $skill_name_kh?> </div>​<br>
													<div class="float-left">ក្នុងឆ្នាំសិក្សា</div><div class="academic_year"> <?php echo $year_to_year_kh?> </div>​<div class="float-left">ពិតប្រាកដមែន។</div>
												</div>
											</div>
											<div class="display_top_right">
												<div class="clear_right">
													<div class="float-left">Student's Name:</div><div class="name_eng">BRAB CHEOURN</div><br>
													<div class="float-left">Sex:</div><div class="gender_eng">M</div><div class="float-left">ID:</div><div class="no_eng">12345</div><div class="float-left">Nationality:</div><div class="nation_eng"><?php echo $nationality_name?></div><br>
													<div class="float-left">Date of Birth:</div><div class="dob_eng"><?php echo $stu_dob?></div><br>
													<div class="float-left">Place of Birth</div><div class="pob_eng"><?php echo $stu_birthplace?></div><br>
													<div class="float-left">Father's Name</div><div class="fname_eng">no db</div>​<div class="float-left">Occuption</div><div class="jobf_eng">no db</div><br>
													<div class="float-left">Mother's Name</div><div class="mname_eng">no db</div>​<div class="float-left">Occuption</div><div class="jobm_eng">no db</div><br>
													<div class="float-left">Current Address</div><div class="stay_in_eng"><?php echo $address ?></div>​<br>
													<!-- <div class="stay_in_more_eng">Preah Net Preah Districe, Banteaymean Chey Provice.</div>​<br> -->
													<div class="float-left">Is the</div><div class="study_year_eng"></div>​<div class="float-left">Year Student of the</div><div class="class_eng"><?php echo $level_name?></div>degree​<br>
													<div class="float-left">School of:</div><div class="university_eng"><?php echo $university_name?></div>​<br>
													<div class="float-left">Major In</div><div class="major_eng"> <?php echo $skill_name?> </div>​<br>
													<div class="float-left">in the academic year</div><div class="academic_year_eng"> <?php echo $year_to_year?> </div>​
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
												<div style="float:left">សាខាបន្ទាយមានជ័យ, ថ្ងៃទី</div><div style="border-bottom:dotted 1px #ccc;width: 40px;float:left;text-align:center;margin-top: 5px;line-height: 12px;"><?php echo ($date_out_academic_confirmation)? $d: '&nbsp;'?></div><div style="float:left">ខែ</div><div style="border-bottom:dotted 1px #ccc;width: 40px;float:left;text-align:center;margin-top: 5px;line-height: 12px;"><?php echo ($date_out_academic_confirmation)? $month : '&nbsp;'?></div><div style="float:left">ឆ្នាំ</div><?php echo ($date_out_academic_confirmation)? $y : '២០១'?>
											</div>
											<div class="campuse">
												<div style="border-bottom:dotted 1px #ccc;width: 132px;float:right;text-align:center;margin-top: 0px;line-height: 12px;"><?php echo ($date_out_academic_confirmation)? $date_eng : '&nbsp;'?></div><div style="float:right">Banteay Meanchey Campus,</div>
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
							<?php endforeach ?>
				<?php endfor ?>
	<?php endif ?>

</div>
