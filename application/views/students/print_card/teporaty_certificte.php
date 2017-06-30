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
			    font-family: khmerOSmuol;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/KhmerOSmuol.ttf);
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
			    min-width: 122px;
			    font-family: khmerOScontent;
			    position: relative;
			    line-height: 2.6;
			    top: -15px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
			        margin-right: 6px;
			}
			.name_eng{
			    float: left;
			    min-width: 162px;
			    font-family: khmerOScontent;
			    position: relative;
			    line-height: 2.6;
			    top: -15px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
				text-transform: uppercase;
			}
			.sex{
			    float: left;
			    min-width: 119px;
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
			    min-width: 162px;
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
			    min-width: 400px;
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
			    min-width: 400px;
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
			    min-width: 400px;
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
			    min-width: 400px;
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
			    min-width: 585px;
			    float: right;
			    font-family: khmerOScontent;
			    font-size: 14.5px;
			    text-indent: 7px;
			    margin-top: 5px;
			}
			.block_university{
				    min-width: 579px;
				    float: right;
				    font-family: khmerOScontent;
    				line-height: 33px;
			}
			.university{
			    float: left;
			    min-width: 400px;
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
			    min-width: 585px;
			    float: right;
			    font-family: khmerOSmuol;
			    font-size: 14.5px;
			    text-indent: 7px;
			    margin-top: -4px;
			}

			.note{
				min-width: 585px;
				float: left;
				font-family: khmerOScontent;
				font-size: 13px;
				margin-top: -1px;
				text-align: left;
				margin-left: 20px;
			}
			.date{
			    min-width: 362px;
			    float: right;
			    font-family: khmerOScontent;
			    font-size: 15px;
			    margin-top: 7px;
			    text-align: left;
			    margin-left: 20px;
			}
			.director{
			    min-width: 376px;
			    float: right;
			    font-family: khmerOSmuol;
			    font-size: 15px;
			    margin-top: -3px;
			    text-align: left;
			    text-indent: 122px;
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
									$stu_dob = date_format(date_create($row->stu_dob),"F j, Y");
									$stu_gender= $row->stu_gender;
									$stu_gender_kh = ($stu_gender == 'Male')? 'ប្រុស':'ស្រី';
									$level_name = $row->level_name;
									$level_name_kh = $row->level_name_kh;
									$section_name = $row->section_name;
									$stu_unique_id = $row->stu_unique_id;
									$stu_birthplace = $row->stu_birthplace;
									$university_name = $row->university_name;
									$university_name_kh = $row->university_name_kh;
									$university_id = $row->university_id;
									$skill_name = $row->skill_name;
									$skill_name_kh = $row->skill_name_kh;
									$nationality_name_kh = $row->nationality_name_kh;

									$y= date_format(date_create($row->stu_dob),"Y");
									$m= date_format(date_create($row->stu_dob),"m");
									$d= date_format(date_create($row->stu_dob),"d");
									$months = array (1=>'មករា',2=>'កុម្ភះ',3=>'មីនា',4=>'មេសា',5=>'ឧសភា',6=>'មិថុនា',7=>'កក្ដា',8=>'សីហា',9=>'កញ្ញា',10=>'តុលា',11=>'វិច្ឆិកា',12=>'ធ្នូរ');
									$get_month = $months[(int)$m];

                  $y= date_format(date_create($aproved_date),"Y");
                  $m= date_format(date_create($aproved_date),"m");
                  $d= date_format(date_create($aproved_date),"d");
                  $d1 = substr($d,0,1);
                  $d2 = substr($d,1,1);
                  $y1 = substr($y,0,1);
                  $y2 = substr($y,1,1);
                  $y3 = substr($y,2,1);
                  $y4 = substr($y,3,1);
                  $get_month = substr($m,1,1);
                  $months = array(1=>'មករា',2=>'កុម្ភះ',3=>'មីនា',4=>'មេសា',5=>'ឧសភា',6=>'មិថុនា',7=>'កក្ដា',8=>'សីហា',9=>'កញ្ញា',10=>'តុលា',11=>'វិច្ឆិកា',12=>'ធ្នូរ');
                  $softConv = array (0=>'០',1=>'១',2=>'២',3=>'៣',4=>'៤',5=>'៥',6=>'៦',7=>'៧',8=>'៨',9=>'៩');
									$stu_dob_kh = 'ថ្ងៃ'.$softConv[(int)$d1].$softConv[(int)$d2].'&nbsp;ខែ'.$months[(int)$get_month].'&nbsp;ឆ្នាំ'.$softConv[(int)$y1].$softConv[(int)$y2].$softConv[(int)$y3].$softConv[(int)$y4];
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
													<div class="logo_text_no"><div style="float:left">លេខ:</div><div style="border-bottom:dotted 1px #ccc;width: 110px;float:left;text-align:center;margin-top: 5px;line-height: 12px;"><?php echo ($id_temporaty_certificate)? sprintf("%07s", $id_temporaty_certificate++) : '&nbsp;'?></div></div>
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
													ID: <?php echo $stu_unique_id?>
													<div class="photo">
														4 X 6
													</div>
												</div>

												<div class="block_view">
													<div class="float_left">និស្សិតឈ្មោះ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="name"><?php echo $name_kh?></div><div class="float_left">អក្សរឡាតាំង&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="name_eng"><?php echo $name?></div><br/>
													<div class="float_left">ភេទ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="sex"><?php echo $stu_gender_kh?></div><div class="float_left">សញ្ជាតិ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="nation"><?php echo $nationality_name_kh?></div><br/>
													<div class="float_left">ថ្ងៃខែឆ្នាំកំណើត&nbsp;&nbsp;&nbsp;:</div><div class="dob"><?php echo $stu_dob_kh?></div><br/>
													<!-- <div class="float_left">ទីកន្លែងកំណើត&nbsp;&nbsp;&nbsp;:</div><div class="pob">ថ្ងៃទី២៣ ខែមេសា ឆ្នាំ១៩៩០</div><br/> -->
													<div class="float_left">ទីកន្លែងកំណើត&nbsp;&nbsp;&nbsp;:</div><div class="pob"><?php echo $stu_birthplace?></div><br/>
													<div class="float_left">ឪពុកឈ្មោះ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="fname">លឿម យ៉ុង</div><br/>
													<div class="float_left">ម្តាយឈ្មោះ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="mname">វ៉ាន គឹមសាន់</div><br/>
												</div>

												<div class="confirm_view">
													បានបំពេញគ្រប់លក្ខខណ្ឌដោយជោគជ័យ ក្នុងការប្រឡងបញ្ចប់ការសិក្សាថ្នាក់ <span​ style='font-family:khmerOsMollight'>បរិញ្ញាប័ត្រ</span>
												</div>

												<div class="block_university">
													<div class="float_left">មហាវិទ្យាល័យ&nbsp;:</div><div class="university"><?php echo $university_name_kh ?></div><br/>
													<div class="float_left">ឯកទេស&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="university"><?php echo $skill_name_kh?></div><br/>
													<div class="float_left">សម័យប្រឡង&nbsp;&nbsp;:</div><div class="university"><?php echo $date_exam_kh ?></div><br/>
												</div>
												<div class="can_use">
													វិញ្ញាបនបត្រនេះចេញជូនសាមីជន យកទៅប្រើប្រាស់តាមការដែលអាចប្រើបាន។
												</div>

												<div class="note">
													<div style='font-family:khmerOsMollight;float:left'>កំណត់សម្គាល់ៈ</div> វិញ្ញាបនបត្រនេះមិនចេញជូនជាលើកទី២ទេ។
												</div>

												<div class="date">
													<div style="float:left">បន្ទាយមានជ័យ ថ្ងៃទី</div><div style="border-bottom:dotted 1px #ccc;width: 37px;float:left;text-align:center;margin-top: 5px;line-height: 12px;"><?php echo ($get_date)? $get_date : '&nbsp;'?></div> <div style="float:left">ខែ</div><div style="border-bottom:dotted 1px #ccc;width: 50px;float:left;text-align:center;margin-top: 5px;line-height: 12px;"><?php echo ($get_month_date_out)? $get_month_date_out : '&nbsp;'?></div> <div style="float:left">ឆ្នាំ</div><div style="border-bottom:dotted 1px #ccc;width: 46px;float:left;text-align:center;margin-top: 5px;line-height: 12px;"><?php echo ($get_year)? $get_year : '២០១'?></div>
												</div>
												<div class="director">
													សាកលវិទ្យាធិការ
												</div>



										</div>
									</div>

							</page>
							<?php endforeach ?>
				<?php endfor ?>
	<?php endif ?>

</div>
