<?php



FUNCTION fbChop($t)
	{
		$t1	=substr($t,0,217);
		$ptr=strrpos ( $t1,".");
		return ($ptr===false ? $t1."..." : substr($t1,0,$ptr+1) );
	}
	
$t="My brother Pin was concerned that I was in that dirty house and wooden room on my own too much. 
This poem recalls the conversation.The parts directly about the monkey are fairly accurate.
Monkey’s not in the Shed

The last song was not true;
I have been singing lies to you.
You have been misled:
there was no monkey,
merely a shed.
This is what really happened.";
print  fbChop($t);









