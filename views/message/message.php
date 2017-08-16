<?php require_once(ROOT . '/views/layout/head.php'); ?>

<div class="container-fluid">

	<?php require_once(ROOT . '/views/layout/menu.php'); ?> <!-- header -->

	<div class="container">

		<div class="row">

			<div class="conversation-wrap col-lg-3">

				<?php foreach ($users as $row) : ?>

					<?php
//					$res = Message::getLastMessageById($row['id']);
//					foreach ($res as $rr) {
//						$message = $rr['msg'];
//					} треба обрізати поіідомлення, щоб арно виглядало, і ще треба зробити щоб воно аяксом оновлювало його
					?>

					<div class="media conversation" data-text="<?php echo $row['id'] ?>">
						<a class="pull-left" href="#">
							<img class="media-object" data-src="holder.js/64x64" alt="64x64"
								 style="width: 50px; height: 50px;" src="<?php echo $row['avatar'] ?>">
						</a>
						<div class="media-body">
							<h5 class="media-heading"><?php echo $row['login'] ?></h5>
<!--							<small>--><?php //echo $message; ?><!--</small>-->
						</div>
					</div>

				<?php endforeach; ?>

			</div>


			<div class="message-wrap col-lg-8">

				<div class="msg-wrap">

				</div>

				<div class="send-wrap ">

					<textarea class="form-control send-message" rows="3" id="message"
							  placeholder="Повідомлення"></textarea>

				</div>
				<div class="btn-panel">
					<a href="#" id="send" class=" col-lg-4 text-right btn   send-message-btn pull-right"
					   role="button"><i class="fa fa-plus"></i> Send Message</a>
				</div>
			</div>
		</div>
	</div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
<script src="/template/js/online.js"></script>
<script src="/template/js/script.js"></script>
<script src="/template/js/chat.js"></script>
<?php require_once(ROOT . '/views/layout/footer.php'); ?>

<?php
//print_r($users);
?>
