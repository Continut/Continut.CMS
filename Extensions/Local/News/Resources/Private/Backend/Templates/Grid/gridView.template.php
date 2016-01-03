<div class="grid">
	<form method="post" action="<?= $this->getFormAction() ?>" class="form">
		<div class="row">
			<?php foreach ($this->getFields() as $fieldName => $field): ?>
				<div class="<?= ($field->getCss()) ? $field->getCss() : 'col-sm-1'; ?>">
					<div class="form-group">
						<label><?= $field->getLabel() ?></label>
						<?php if ($field->getFilter()): ?>
							<?= $field->getFilter()->render() ?>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach ?>
		</div>
		<!-- panel START -->
		<div class="row grid-panel">
			<div class="col-sm-6">
				<nav>
					<ul class="pagination">
						<li>
							<a href="#" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li>
							<a href="#" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
			<div class="col-sm-6 text-right">
				<a href="<?= $this->getFormAction() ?>" class="btn btn-danger"><span class="fa fa-icon fa-refresh"></span> Reset filters</a>
				<input type="submit" class="btn btn-primary" value="Search" />
			</div>
		</div>
		<!-- panel END -->

			<?php foreach ($this->getCollection()->getAll() as $index => $record): ?>
				<div class="row grid-row <?= ($index % 2 == 0) ? '' : 'grid-even' ?>">
				<?php foreach ($this->getFields() as $fieldName => $field): ?>
					<div class="<?= ($field->getCss()) ? $field->getCss() : 'col-sm-1'; ?>">
						<?= $field->getRenderer()->setRecord($record)->render() ?>
					</div>
				<?php endforeach ?>
				</div>
			<?php endforeach ?>

		<!-- panel START -->
		<div class="row grid-panel">
			<div class="col-sm-6">
				<nav>
					<ul class="pagination">
						<li>
							<a href="#" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li>
							<a href="#" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
			<div class="col-sm-6 text-right">
			</div>
		</div>
		<!-- panel END -->
	</form>
</div>