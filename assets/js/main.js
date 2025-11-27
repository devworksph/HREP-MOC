$(document).ready(function(){

    $.ajax({
        url: "https://api.devworksph.com/congress/members",
        type: 'jsonp',
        success:function(response){
            console.info(response);
        }
    });


    console.log('Initially ' + (window.navigator.onLine ? 'on' : 'off') + 'line');
    window.addEventListener('online', () => console.log('Became online'));
    window.addEventListener('offline', () => console.log('Became offline'));
});