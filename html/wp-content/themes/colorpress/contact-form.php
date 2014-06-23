<?php
/*
Template Name: Contact Form
*/
?>
<?php
global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
?>
<?php 
//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['contactemail']) === '')  {
			$emailError = 'You forgot to enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['contactemail']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['contactemail']);
		}
			
		//Check to make sure comments were entered	
		if(trim($_POST['comments']) === '') {
			$commentError = 'You forgot to enter your comments.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = $sp_contactmail;
			$blog_title = get_bloginfo();
			$subject = 'Contact Form Submission from '.$name;
			$sendCopy = trim($_POST['sendCopy']);
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$blog_title.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			if($sendCopy == true) {
				$subject = 'You emailed '.$blog_title;
				$headers = 'From: '.$blog_title.' '.$emailTo;
				mail($email, $subject, $body, $headers);
			}

			$emailSent = true;

		}
	}
} ?>


<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/contact-form.js"></script>

<div id="wrapper">


    <?php include (TEMPLATEPATH . '/navigation.php');?>
    
<div id="contents">
<div id="entry">
	

<?php if(isset($emailSent) && $emailSent == true) { ?>

	<div class="thanks">
		<h1 class="thank">Thanks</h1>
		<p>Your email was successfully sent. We will be in touch soon.</p>
	</div>

<?php } else { ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="breadcrumbs"><?php breadcrumbs(); ?></div>
        <div class="post" id="post-<?php the_ID(); ?>">   
			        <h2 style="margin-left:0;"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2> 
					<div class="content"><?php the_content("Read More"); ?></div>
                    		
		<?php if(isset($hasError) || isset($captchaError)) { ?>
			<p class="error">There was an error submitting the form!<p>
		<?php } ?>
	
		<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
	
			<ol class="forms">
				<li><label for="contactName">Name</label>
					<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField" />
					<?php if($nameError != '') { ?>
						<span class="error"><?=$nameError;?></span> 
					<?php } ?>
				</li>
				
				<li><label for="email">Email</label>
					<input type="text" name="contactemail" id="contactemail" value="<?php if(isset($_POST['contactemail']))  echo $_POST['contactemail'];?>" class="requiredField email" />
					<?php if($emailError != '') { ?>
						<span class="error"><?=$emailError;?></span>
					<?php } ?>
				</li>
				
				<li class="textarea"><label for="commentsText">Comments</label>
					<textarea name="comments" id="commentsText" rows="10" cols="20" class="requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
					<?php if($commentError != '') { ?>
						<span class="error"><?=$commentError;?></span> 
					<?php } ?>
				</li>
				<li class="inline"><input type="checkbox" name="sendCopy" id="sendCopy" value="true"<?php if(isset($_POST['sendCopy']) && $_POST['sendCopy'] == true) echo ' checked="checked"'; ?> /><label for="sendCopy">Send a copy of this email to yourself</label></li>
				<li class="screenReader"><label for="checking" class="screenReader">If you want to submit this form, do not enter anything in this field</label><input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></li>
				<li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit">Contact Us</button></li>
			</ol>
		</form>
	
		<?php endwhile; ?>
	<?php endif; ?>
<?php } ?>

        <br clear="all" />
		</div><!--post-->

</div><!--entry-->

<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
<div class="clear"><!----></div>
<br clear="all" />
</div><!--contents-->

<?php get_footer(); ?>
	