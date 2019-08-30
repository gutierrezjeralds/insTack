<script>
    var token = '{{Session:: token()}}';
    var urlEdit = '{{route('edit')}}';
    var urlLike = '{{route('like')}}';
    var urlPostPhoto = '{{route('post.share.photo')}}';
    var urlEnableComment = '{{route('post.comment.enable')}}';
	var urlName = '{{ Request::route()->getName() }}';
</script>