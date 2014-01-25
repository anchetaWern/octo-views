octo-views
==========

get view status for your octopress blog

Octo-views allows you to determine the number of views that each page in your Octopress blog gets. 
This works by adding a JavaScript code that makes an http request to a remote server which keeps track of the page views that each post gets.


###Dependencies

- [csshttprequest](https://github.com/nbio/csshttprequest) - for making cross-domain http request
- [jQuery](http://jquery.com) - used for easier element selection. Most Octopress installations already has this one so you may or may not need to include it manually.


###Requirements

- PHP
- MySQLi - the server code requires the mysqli extension to be installed and enabled on the server
- MySQL Database - used for storing page view count


###How to Install

To install simply copy the files that are inside the `octopress/source/` folder into the `source` directory of your Octopress installation. Note that the `after_footer.html` file may already exist in your current Octopress installation. If that's the case then simply copy the following line after the last line in your current `after_footer.html` file:

```
{% include post_stats.html %}
```

This will include the main template that includes the dependency csshttprequest library and the JavaScript code which makes an http request to the remote server.

Here's the JavaScript code which makes the request to the remote server. Note that the selector for the entry title may not exist in your Octopress installation. If that's the case then simply open up your Octopress blog in the browser and look for whatever element the entry title is contained and use it as the value for the `entry_title` variable.

```
<script>
if($('.entry-title').length == 1){ //make sure that there's only one entry in the current page (home page not included)
	var entry_title = $('.entry-title').text(); //the title of the current page
	CSSHttpRequest.get(
	    "http://yoursite.com/counter.php?title=" + entry_title,
	    function(response){
	  	//do something with the response	
	    }
	);
}
</script>
```


###Setting up the Server

Execute the queries in the `create-db.sql` file to create the tables that will store the page view status.
After that, upload the contents of the `stats-viewer` directory into a web accessible directory in your server. Be sure to update `db-config.php` to include your database credentials. Once you've set that up, simply update the JavaScript code to make the request to the server you've just setup.



