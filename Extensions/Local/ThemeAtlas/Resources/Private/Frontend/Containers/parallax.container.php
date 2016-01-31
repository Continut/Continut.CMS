<section id="count_parallax_<?= $this->getId() ?>" class="parallax" style="background-image: url('<?= $this->helper("Image")->resize($image, 1600, 900) ?>');" data-stellar-background-ratio="0.6" data-stellar-vertical-offset="20">
	<div class="overlay">
		<div class="container">
			<div class="stat f-container">
				<?= $this->showContainerColumn(4); ?>
			</div>
		</div>
	</div>
</section>