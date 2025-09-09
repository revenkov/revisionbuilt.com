<?php
/**
 * Template Name: Contact
 */
?>


<?php get_header(); ?>


<?php get_template_part('parts/hero'); ?>


<?php
$intro_content = get_field('intro_content');
$address = get_field('address', 'options');
$phone = get_field('phone', 'options');
$email = get_field('email', 'options');
$form = get_field('form');
?>
<div class="section">
    <div class="container">
        <div class="contactBlock">
            <div class="contactBlock__col1">
                <?php echo $intro_content; ?>

                <div class="contacts">
                    <h3 class="contacts__title">Contact information</h3>
                    <div class="contacts__cols">
                        <div class="contacts__col">
                            <div class="contacts__address"><a href="//google.com/maps?q=<?php echo $address; ?>" target="_blank"><?php echo $address; ?></a></div>
                        </div>
                        <div class="contacts__col">
                            <div class="contacts__email"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
                            <div class="contacts__phone"><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></div>
                        </div>
                    </div>
                </div>

                <div class="socials contactBlock__socials">
                    <?php get_template_part('parts/socials'); ?>
                </div>
            </div>
            <div class="contactBlock__col2">
                <div class="contactFormBlock">
                    <div class="contactFormBlock__formContainer"><?php echo $form['content']; ?></div>
                    <div class="contactFormBlock__response" style="display: none;"><?php echo $form['response']; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_template_part('parts/cta'); ?>


<?php get_footer(); ?>
