<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Data Design Project</title>
	</head>
	<body>
		<h2>Persona</h2>
		<p>The user of the commenting feature is Bob.  Bob is a fan of the sport of soccer - and of Major League Soccer in particular - and has some degree of knowledge in the sport.
			Bob is American; as MLS is an American league, most of its fans are from that country.
			American soccer fans tend to be teens and young adults (millenials) and often have roots in a country where the sport is more widespread (such as immigrants or first generation Americans): Bob is in his mid-20s and American-born, but the son of an immigrant family.
			Younger generations, in general, are typically more comfortable around technology, and heavily use mobile devices such as smart phones in particular.  Bob himself uses an iPhone 6.
			Someone who comments on the site would be looking to discuss the sport (and the contents of a given article) with other fans.
			Bob is most likely to be drawn into reading and commenting articles about his favorite team (the San Jose Earthquakes), so most other commentators he interacts with will be fans of the team, as well.
		</p>

		<h2>Use Case: Bob goes to read an article about the San Jose Earthquakes, and post a comment about it</h2>
		<ul>
			<li>Bob goes to MLSSoccer.com</li>
			<li>Bob scrolls through the list of current articles on the site</li>
			<li>Bob sees an article about his favorite team, the Earthquakes</li>
			<li>Bob selects the headline of the article in question</li>
			<li>The site retrieves and displays the article</li>
			<li>Bob reads the article, and decides to comment</li>
			<li>Bob scrolls to the comment section</li>
			<li>Bob selects the "Login" button</li>
			<li>The site prompts a user with a window to either log in to their profile, or create a new one</li>
			<li>Bob has a profile, so he uses his user name and password to log in</li>
			<li>The site uses this information to log in Bob</li>
			<li>Bob enters the message they wish to post to the comment board into the given field</li>
			<li>Bob selects the "Post" button</li>
			<li>The site posts the comment</li>
		</ul>
		<h2>Use Case 2: Bob wants to read through the comments on an article he viewed previously, and respond to someone else's comment</h2>
		<ul>
			<li>Bob goes to MLSSoccer.com</li>
			<li>Bob goes to the headline of the article he read previously</li>
			<li>Bob selects the article</li>
			<li>The site retrieves and displays the article</li>
			<li>Bob jumps to the comment section by clicking the "comment" button on the bottom of the article</li>
			<li>Bob reads through the comments, and decides to respond to one</li>
			<li>Bob selects the "Login" button</li>
			<li>The site prompts a user with a window to either log in to their profile, or create a new one</li>
			<li>Bob has a profile, so he uses his user name and password to log in</li>
			<li>The site uses this information to log in Bob</li>
			<li>Bob selects the "Reply" option on the comment to which he wants to respond</li>
			<li>The site presents a box for entering a response, and a "Post" button</li>
			<li>Bob enters his response</li>
			<li>Bob selects the "Post" button</li>
			<li>The site posts the response underneath the original comment</li>
		</ul>
		<h2>Conceptual Schema</h2>
		<h3>Entity 1: User</h3>
		<h4>Attributes</h4>
		<ul>
			<li>User Name</li>
			<li>User Profile</li>
		</ul>
		<h4>Relationships</h4>
		<p>One user can make many comments</p>
		<h3>Entity 2: Article</h3>
		<h4>Attributes</h4>
		<ul>
			<li>Title</li>
			<li>Author</li>
			<li>Text</li>
		</ul>
		<h4>Relationships</h4>
		<p>One article can have many comments</p>
		<h3>Entity 3: Comment</h3>
		<h4>Attributes</h4>
		<ul>
			<li>Author</li>
			<li>Article</li>
			<li>Time Posted</li>
		</ul>
	</body>
</html>