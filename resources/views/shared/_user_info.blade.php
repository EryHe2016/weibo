<a href="{{ route('users.show', $user->id)}}">
	<img src="{{ asset('ery.jpg') }}" alt="{{ $user->name }}" class="gravatar">
</a>
<h1>{{ $user->name }}</h1>