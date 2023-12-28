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
	<form class="form container <?= $class_name; ?>" action="login.php" method="post">
		<h2>Вход</h2>

		<?php $class_name = isset($errors['email']) ? 'form__item--invalid' : ''; ?>
		<div class="form__item <?= $class_name; ?>">
			<label for="email">E-mail*</label>

			<?php $value = isset($_POST['email']) ? $_POST['email'] : ''; ?>
			<input id="email" type="text" name="email" placeholder="Введите e-mail" required value="<?= $value; ?>">

			<?php $error_message = isset($errors['email']) ? $errors['email'] : ''; ?>
			<span class="form__error"><?= $error_message; ?></span>
		</div>

		<?php $class_name = isset($errors['password']) ? 'form__item--invalid' : ''; ?>
		<div class="form__item form__item--last <?= $class_name; ?>">
			<label for="password">Пароль*</label>
			<input id="password" type="text" name="password" placeholder="Введите пароль" required>

			<?php $error_message = isset($errors['password']) ? $errors['password'] : ''; ?>
			<span class="form__error"><?= $error_message; ?></span>
		</div>

		<button type="submit" class="button">Войти</button>
	</form>

</main>