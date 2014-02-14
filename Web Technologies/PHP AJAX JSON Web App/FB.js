
        function postToFeed(vtitle,vcap,vdesc,vdetails,vcover) {

          alert(vtitle+vcap+vdesc+vdetails+vcover);
          FB.init({
            appId      : '511042045598384', // App ID
            channelUrl : 'http://cs-server.usc.edu:19444/examples/servlets/channel.html', // Channel File
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml      : true  // parse XFBML
          });
          FB.ui({ 
            method: 'feed',
            name: vtitle,
            caption: vcap,
            description: vdesc,
            link: vdetails,
           picture: vcover,
           properties: {
          'Look at details': {
          text: 'here',
          href: vdetails
}
}

          },
function(response)
{
if (response && response.post_id)
{
alert('Post was published.');
} else
{
alert('Post was not published.');
}
}
          );
       return false; };
        // Load the SDK Asynchronously
        (function(d){
           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           ref.parentNode.insertBefore(js, ref);
         }(document));
  
     