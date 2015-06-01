{{ Form::open(['action' => ['SearchController@searchUser'], 'method' => 'GET']) }}
    {{ Form::text('q', '', ['id' =>  'q', 'placeholder' =>  'Enter name'])}}
    {{ Form::submit('Search', array('class' => 'button expand')) }}
{{ Form::close() }}


<script type="text/javascript">
$(function()
{
	 $( "#q" ).autocomplete({
	  source: "search/autocomplete",
	  minLength: 3,
	  select: function(event, ui) {
	  	$('#q').val(ui.item.value);
	  }
	});
});
</script>