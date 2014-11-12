<?php
use smce\lib\SmForm\SmForm
?>
<h1>Login Form</h1>


<div class="form">
<?php $form=SmForm::beginWidget(array(
	"id"=>"login-form",
));?>
	<?php $form->errorSummary(); ?>
	<div class="row">
        <p>
        admin/admin<br />
        demo/demo
       
        </p>
    	<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
        <?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
    	<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
	</div>


   <div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
        <?php echo $form->labelEx($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo $form->submit('Login'); ?>
	</div>

<?php SmForm::endWidget(); ?>
</div><!-- form -->
