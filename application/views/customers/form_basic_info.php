        <div class="form-group" style="margin-bottom:10px;">
            <?php echo form_label(lang('customers_company_name') . ':', 'company_name', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
            <div class="col-sm-8 col-md-8 col-lg-5">
                <?php
                echo form_input(array(
                    'class' => 'filter form-control',
                    'name' => 'company_name',
                    'id' => 'company_name',
                    'class' => 'filter form-control',
                    'value' => $person_info->company_name)
                );
                ?>
            </div>
        </div>
          <div class="form-group" style="margin-bottom:10px;">
            <?php echo form_label(lang('customers_company_reg') . ':', 'company_reg', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
            <div class="col-sm-8 col-md-8 col-lg-5">
                <?php
                echo form_input(array(
                    'class' => 'filter form-control',
                    'name' => 'company_reg',
                    'id' => 'company_reg',
                    'class' => 'filter form-control',
                    'value' => $person_info->company_registration_num)
                );
                ?>
            </div>
        </div>
          <div class="form-group"  style="margin-bottom:10px;">
            <?php echo form_label(lang('customers_company_director') . ':', 'company_director', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
            <div class="col-sm-8 col-md-8 col-lg-5">
                <?php
                echo form_input(array(
                    'class' => 'filter form-control',
                    'name' => 'company_director',
                    'id' => 'company_director',
                    'class' => 'filter form-control',
                    'value' => $person_info->directors_name)
                );
                ?>
            </div>
        </div>
        <div class="form-group"  style="margin-bottom:10px;">
            <?php echo form_label(lang('customers_person_contact') . ':', 'person_contact', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
            <div class="col-sm-8 col-md-8 col-lg-5">
                <?php
                echo form_input(array(
                    'class' => 'filter form-control',
                    'name' => 'person_contact',
                    'id' => 'person_contact',
                    'class' => 'filter form-control',
                    'value' => $person_info->person_contact)
                );
                ?>
            </div>
        </div>
        <div class="form-group"  style="margin-bottom:10px;">
            <?php echo form_label(lang('customer_designation') . ':', 'customer_designation', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
            <div class="col-sm-8 col-md-8 col-lg-5">
                <?php
                echo form_input(array(
                    'class' => 'filter form-control',
                    'name' => 'customer_designation',
                    'id' => 'customer_designation',
                    'class' => 'filter form-control',
                    'value' => $person_info->designation)
                );
                ?>
            </div>
        </div>
        <div class="form-group"  style="margin-bottom:10px;">
            <?php echo form_label(lang('employees_email') . ':', 'email', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
            <div class="col-sm-8 col-md-8 col-lg-5">
                <?php
                echo form_input(array(
                    'class' => 'filter form-control',
                    'name' => 'email',
                    'id' => 'email',
                    'class' => 'filter form-control',
                    'value' => $person_info->email)
                );
                ?>
            </div>
        </div>
        <div class="form-group"  style="margin-bottom:10px;">
            <?php echo form_label(lang('customers_Mobile') . ':', 'mobile', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
            <div class="col-sm-8 col-md-8 col-lg-5">
                <?php
                echo form_input(array(
                    'class' => 'filter form-control',
                    'name' => 'mobile',
                    'id' => 'mobile',
                    'class' => 'filter form-control',
                    'value' => $person_info->phone_number)
                );
                ?>
            </div>
        </div>
        <div class="form-group"  style="margin-bottom:10px;">
            <?php echo form_label(lang('customers_tel') . ':', 'tel', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
            <div class="col-sm-8 col-md-8 col-lg-5">
                <?php
                echo form_input(array(
                    'class' => 'filter form-control',
                    'name' => 'tel',
                    'id' => 'tel',
                    'class' => 'filter form-control',
                    'value' => $person_info->office_number)
                );
                ?>
            </div>
        </div>
         <div class="form-group"  style="margin-bottom:10px;">
            <?php echo form_label(lang('customers_address') . ':', 'address', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
            <div class="col-sm-8 col-md-8 col-lg-5" >
                <?php
                echo form_textarea(array(
                    'name' => 'address',
                    'id' => 'address',
                    'class' => 'filter form-control',
                    'value' => $person_info->address_1)
                );
                ?>
            </div>
        </div>

       