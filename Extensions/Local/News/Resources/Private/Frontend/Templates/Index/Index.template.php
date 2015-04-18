<?= $this->partial('ThemeBootstrap', 'Index/index.partial.php', ["country" => $country]); ?>

<h1>Hello <?php echo $firstname; ?> I come from a template that resides in the Index Controller of an extension</h1>
<p>I know people also like to call you <?php echo $lastname; ?> and that you're from <?php echo $country; ?>.</p>
<p>I can also execute code cause I'm smart...</p>
<p><strong>Here's the date: </strong><?php echo date('d/m/y H:i:s'); ?></p>