<main>

	<nav class="nav">
		<ul class="nav__list container">
			<li class="nav__item">
				<a href="all-lots.html">Доски и лыжи</a>
			</li>
			<li class="nav__item">
				<a href="all-lots.html">Крепления</a>
			</li>
			<li class="nav__item">
				<a href="all-lots.html">Ботинки</a>
			</li>
			<li class="nav__item">
				<a href="all-lots.html">Одежда</a>
			</li>
			<li class="nav__item">
				<a href="all-lots.html">Инструменты</a>
			</li>
			<li class="nav__item">
				<a href="all-lots.html">Разное</a>
			</li>
		</ul>
	</nav>

	<?php $class_name = isset($errors) ? 'form--invalid' : ''; ?>
	<form class="form form--add-lot container <?= $class_name; ?>" action="add.php" method="post" enctype="multipart/form-data">
		<h2>Добавление лота</h2>
		<div class="form__container-two">

			<?php $class_name = isset($errors['name']) ? 'form__item--invalid' : ''; ?>
			<div class="form__item <?= $class_name; ?>">
				<label for="name">Наименование</label>

				<?php $value = isset($_POST['name']) ? $_POST['name'] : ''; ?>
				<input id="name" type="text" name="name" placeholder="Введите наименование лота" required value="<?= $value; ?>">

				<?php $error_message = isset($errors['name']) ? $errors['name'] : ''; ?>
				<span class="form__error"><?= $error_message; ?></span>
			</div>

			<?php $class_name = isset($errors['category']) ? 'form__item--invalid' : ''; ?>
			<div class="form__item <?= $class_name; ?>">
				<label for="category">Категория</label>
				<select id="category" name="category" required>
					<option value="">Выберите категорию</option>
					<?php foreach ($categories as $category) : ?>
						<?php $attribute = $_POST['category'] === $category ? 'selected' : ''; ?>
						<option <?= $attribute; ?>><?= $category; ?></option>
					<?php endforeach; ?>
				</select>

				<?php $error_message = isset($errors['category']) ? $errors['category'] : ''; ?>
				<span class="form__error"><?= $error_message; ?></span>
			</div>
		</div>

		<?php $class_name = isset($errors['message']) ? 'form__item--invalid' : ''; ?>
		<div class="form__item form__item--wide <?= $class_name; ?>">
			<label for="message">Описание</label>

			<?php $value = isset($_POST['message']) ? $_POST['message'] : ''; ?>
			<textarea id="message" name="message" placeholder="Напишите описание лота" required><?= $value; ?></textarea>

			<?php $error_message = isset($errors['message']) ? $errors['message'] : ''; ?>
			<span class="form__error"><?= $error_message; ?></span>
		</div>

		<div class="form__item form__item--file"> <!-- form__item--uploaded -->
			<label>Изображение</label>
			<div class="preview">
				<button class="preview__remove" type="button">x</button>
				<div class="preview__img">
					<img src="../img/avatar.jpg" width="113" height="113" alt="Изображение лота">
				</div>
			</div>
			<div class="form__input-file">
				<input class="visually-hidden" type="file" id="photo2" name="lot-picture">
				<label for="photo2">
					<span>+ Добавить</span>
				</label>
			</div>
		</div>

		<div class="form__container-three">

			<?php $class_name = isset($errors['price']) ? 'form__item--invalid' : ''; ?>
			<div class="form__item form__item--small <?= $class_name; ?>">
				<label for="price">Начальная цена</label>

				<?php $value = isset($_POST['price']) ? $_POST['price'] : ''; ?>
				<input id="price" type="number" name="price" placeholder="0" required value="<?= $value; ?>">

				<?php $error_message = isset($errors['price']) ? $errors['price'] : ''; ?>
				<span class="form__error"><?= $error_message; ?></span>
			</div>

			<?php $class_name = isset($errors['lot-step']) ? 'form__item--invalid' : ''; ?>
			<div class="form__item form__item--small <?= $class_name; ?>">
				<label for="lot-step">Шаг ставки</label>

				<?php $value = isset($_POST['lot-step']) ? $_POST['lot-step'] : ''; ?>
				<input id="lot-step" type="number" name="lot-step" placeholder="0" required value="<?= $value; ?>">

				<?php $error_message = isset($errors['lot-step']) ? $errors['lot-step'] : ''; ?>
				<span class="form__error"><?= $error_message; ?></span>
			</div>

			<?php $class_name = isset($errors['lot-date']) ? 'form__item--invalid' : ''; ?>
			<div class="form__item <?= $class_name; ?>">
				<label for="lot-date">Дата заверщения</label>

				<?php $value = isset($_POST['lot-date']) ? $_POST['lot-date'] : ''; ?>
				<input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="20.05.2017" required value="<?= $value; ?>">

				<?php $error_message = isset($errors['lot-date']) ? $errors['lot-date'] : ''; ?>
				<span class="form__error"><?= $error_message; ?></span>
			</div>
		</div>

		<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
		<button type="submit" class="button">Добавить лот</button>
	</form>

</main>