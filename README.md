# uniqueCharacterString

I wrote this function to create unique url's for my site. Using these urls, 
visitors could demo site functionality without having to create a login. 
The function was intended to return a unique string of characters which could be 
added to a url like this:

http://www.mysite.com?temp_user=dd5vbrk4ax4v4o09l2bm

I set the following criteria for this function:

1) Every call must generate a unique string of alpha numeric characters.
2) Most important: present as near to zero chance of string duplication as possible.
3) 20 characters long (secure, but not awkwardly long.)
4) Repeat calls should reflect a high degree of dissimilarity.
5) Character usage should appear as random as possible.

Scalability issue found: If this function is run on more than one server, there is a 
tiny chance that two users could send a request at exactly the same time and get a 
duplicated code.