@extends('layout')

@section('title')
Guestbook
@endsection

@section('content')
<?php
if (isset($post_created))
{
	?>
	<span class="success">Your message was added to the guestbook</span>
	<?php
}

if (isset($post_removed))
{
	?>
	<span class="success">Your message was removed from the guestbook</span>
	<?php
}

if (!$errors->isEmpty()) {
	foreach ($errors->getMessages() as $field_name => $messages) {
		?>
		<span class="error"><?php echo $messages[0]; ?></span>
		<?php
	}
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#tab-post').hide();
		$('#btn-new-post').click(function(e) {
			e.preventDefault();
			$('#tab-post').show();
			$('#btn-new-post').hide();
		});

		$('#btn-cancel-post').click(function(e) {
			e.preventDefault();
			$('#tab-post').hide();
			$('#btn-new-post').show();
		});
	});
</script>
<h1>Guestbook</h1>
<p>This is a simple guestbook. There exists the ability to leave a message and reply to other people's messages.</p><br />
<a class="btn btn-blue" id="btn-new-post">New Post</a>
<div class="gb-post" id="tab-post">
	<h3>Add Post</h3>
	<form action="" method="post">
		@csrf
		<input style="width: 300px;" class="input" type="text" name="name" placeholder="Your name.." />
		<textarea style="height: 100px; width: calc(100% - 12px);" class="input" name="message" placeholder="Your message here.."></textarea>
		<input type="submit" class="btn btn-blue" name="submit" value="Submit" />
		<a class="btn btn-grey" id="btn-cancel-post">Cancel</a>
	</form>
</div><br /><br />
@if (!$posts->isEmpty())
	@foreach ($posts as $post)
		<div class="gb-post">
			<a class="btn btn-red btn-right" href="/guestbook/delete/{{ $post->id }}">Delete</a>
			<span class="gb-name">{{ $post->name }} </span><br />
			<span class="gb-date">on {{ $post->created_at }}</span><br /><br />
			{{ $post->message }}
		</div><br />
	@endforeach
@endif

@endsection
