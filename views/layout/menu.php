<div class="row back">
	<div class="col-lg-5 col-lg-offset-1 col-md-5 col-sm-5">
		<h1 class="header"><a href="/profile/<?php echo $_COOKIE['id_user']; ?>">Welcome</a></h1>
	</div>

	<ul class="nav nav-pills href">
		<li><a href="/profile/<?php echo $_COOKIE['id_user'] ?>">Моя сторінка</a></li>
		<li><a href="/search">Пошук</a></li>
		<li><a href="/settings">Налаштування</a></li>
		<li class="link"><a>Гості</a>
			<div id="visitor">
			</div>
		</li>
		<li><a href="/logout">Вихід</a></li>
		<li>
			<?php
			if ($status->format('%I%') > 1) {
				echo '<span style="color: red;">Оффлайн ' . $status->format('%I%') . '</span>';
			} else {
				echo '<span style="color: greenyellow;">Онлайн ' . $status->format('%I%') . '</span>';
			}
			?>
		</li>
	</ul>

</div> <!-- header -->
