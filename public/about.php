<?php $pagename = "About"; include_once("../private/header.php");?>

<h1>Welcome to Squimblo!</h1>
<h2>Getting Started</h2>
<p>The basic usage of this service (for now!) is as follows.</p>
<ol>
<li>Create an account</li>
<li>Create a ladder (see &quot;Ladders&quot;)</li>
<li>Invite your friends!</li>
<li>Start your first round</li>
<li>You&#39;ll be matched with the person above or below you on the ladder.<ul>
<li>Odd number of people? The top and bottom members will take turns sitting out each round.</li>
</ul>
</li>
<li>Each member plays their game, reports their score (&quot;Matches&quot;), then the winner takes the higher spot between the two members.</li>
<li>Start the next round. Unreported games will be recorded as a 0-0 draw.</li>
<li>See 5!</li>
</ol>
<h2>Coming Soon</h2>
<ul>
<li>UI overhaul (using <a href="https://getbootstrap.com/">Bootstrap</a> or similar)</li>
<li>General quality of life improvements<ul>
<li>Optional display names</li>
<li>Matches list within ladder screen</li>
<li>Delete options for your account, your ladders, and for kicking members within your ladders.</li>
</ul>
</li>
<li>Pick-your-opponent round<ul>
<li>You will get to choose between a few opponents above you on the ladder to challenge them, they can accept the challenge or forfeit their spot to you.</li>
</ul>
</li>
<li>Hit me up at squimbler@squimblo.com for suggestions!</li>
</ul>
<h2>Known issues</h2>
<ul>
<li>Your session may be <em>very</em> short before requiring sign-in again. This is due to a limitation of Heroku and I will be fixing this soon.</li>
</ul>



<?php include_once("../private/footer.php");?>