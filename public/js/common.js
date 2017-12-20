// votes
function setVotes(_data, _url){
    $.ajax( {
    	type: 'POST',
    	url: _url,
    	data: _data,
    	success: function(data){
    		console.log('You voted!');
    	}
    } );
}