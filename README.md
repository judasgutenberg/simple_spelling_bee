This version of Spelling Bee is something I wrote from scratch.  If you refresh the screen, you lose the game.  But if you don't do that, you can play the day's New York Times Spelling Bee all the way to Queen Bee if you are so inclined.  To see this in action (and play the game there) go to http://randomsprocket.com/simple_spellingbee.

This version reflects my design principles when it comes to web apps. I don't like big ponderous frameworks that require Javascript compilation if it's a simple matter to just write the code in a natural, readable, easy-to-modify way. This code comes to less than 12K!

Note: this version caches data from the NYT to a file, so you might encounter permission problems that will cause the page not to render. If so, liberalize the write permissions in the directory this code is served from. Or alter the path of cached file and liberalize the permissions that points to.
