<?php
session_start();
$txt="Monkey does your Blackheads
July21st 2015
My brother Pin was concerned that I was in that dirty house and wooden room on
my own too much. This poem recalls the conversation.The parts directly about 
the monkey are fairly accurate.
Monkey’s not in the Shed
The last song was not true;
I have been singing lies to you.
You have been misled:
there was no monkey,
merely a shed.
This is what really happened.
My brother came to see me.
He said, ‘You’re so slow, boring:
I worry, my brother.
You’re sullen, bored.
not the sporty sort of fellow
who taught me all I know
about fun and duty.
I’m worried, and so’s Mother.
You’re just not the same chap:
don’t you ever leave the flat?
You really need new scenery.
We think some far off country.
Me and you! Sun, sand and sea
would stand us both fine and dandy.’
‘No; I have important things to do.’
‘It’s beautiful, and cheap.’
‘No; I have important things to do.’
‘The fruit is so sweet.’
‘No; I have important things to do.’
‘The girls will make you weep.’
‘No; I have important things to do.’
‘We can lie on the beach and sleep.’
‘No; I have important things to do.’
‘Feel hot sand under our feet.’
‘No; I have important things to do.’
‘It’ll be my treat.’
‘No; I have important things to do.’
‘You can bring your own Shredded Wheat.’
‘No; I have important things to do.’
‘We can hire a Jeep.’
‘No; I have important things to do.’
‘We can watch strange animals leap
across picturesque streets
in a haze of mellow heat
as we beep the horn of our Jeep.’
‘No; I have important things to do.’
Then, sweetly, and brightly
My brother whispered to me. 
‘There’s what?’
‘A shed.’
‘What, a shed?’
‘Yes, a shed.’
‘And a monkey?’
‘Yes, a monkey.’
‘A monkeymonkey?’
‘Yes, a monkeymonkey.’
‘A realmonkey monkey?’
‘Yes.’
‘And the monkey’s in the shed?’
‘Yes.’
‘And the monkey does your blackheads?’
‘Yes’
‘Right, there’s a real monkey, in a shed,
that does your blackheads.’
‘Yes.’
We ate the cheap sweet fruit
with the Shredded Wheat I brought.
We wept over girls 
as we lay on the beach
among the inexpensive beauty,
in the shorts my brother bought.
We walked on hot sand,
and I got a nice tan,
and we watched strange animals leap
across picturesque streets
in a haze of mellow heat
as we beeped the horn of our Jeep.
Every day, it was a lot of fun.
Every day, I asked,
‘Can I see the monkey now?’
‘Monkey?’
‘Yes, monkey.’
‘What monkey?’
‘The monkeymonkey. The
monkey in the shed.’
‘In the shed?’
‘In the shed.’
‘Shed?’
‘Shed. Shed. Shed.’
‘Monkey?’
‘Yes, the monkey in the shed. That
does your blackheads. That
every day I ask to go and see, and
you always say, “some other day.”
That monkey.’
‘O, right. That monkey.’
‘So that’s the shed.’
‘Yes.’
‘The shed with the monkey in it.’
‘Yes.’
‘That does your blackheads?’
‘Yes.’
‘I’m so happy.’
‘Right, I’ll wait outside.’
‘Aren’t you coming in?’
‘No. It’s alright.’
‘There’s no monkey.’
‘It must be out.’
I enjoyed that holiday with my brother long after it was over. However I 
continued to regret that lack of a blackhead-pinging monkey. Luckily, art can
make the never-happened a momentous occurrence for ever. I set to and after
a fortnight of spooning salt into tea and forgetting to open the doors of 
rooms I was walking into, I had this better poem. Towards the end of the first
verse when reading it, and even sooner when singing it, I can usually feel the
earnest beast sifting the hair off my back, the hot blows of breath, those 
certain finger's grip. 
Monkey’s in the Shed 
I work hard
to make a sort of lard
from sweat and dirt 
inside my shirt.
This rich grease
crawls in each new crease,
each old crack 
of my neck and back.
By morning,
amazing spawning!
Monkey says,
‘Sit down,’
wraps his legs around 
my waist:
I brace.
Blackheads in their holes,
jumping out like tadpoles!
The light is brown;
black flies fly round.
Wet heat rots;
Monkey squats.
I take off my shirt:
Monkey goes to work,
puckers his lips,
grips me 
so softly;
Monkey,
keen as mustard,
kind as custard,
empties my back 
until my fat is slack.
Monkey’s in the shed!
Monkey does your blackheads!
I returned to Thailand and also visited Laos and Cambodia. I was pleased by
how very many shops, particularly those in country towns, had hand-painted 
signs.
In a small town in CambodiaI asked a young chap who had introduced 
himself to me to and was eager for employment to take me to a sign-making 
shop and request the painting of a sign to place on a shop I owned in which 
monkeys removed people's blackheads. I did not not give him any other 
information. The sign painter, a cheerful and respectable, solid fellow of 
about fifty, looked at me and my companion as if he might not have fully 
grasped my requirements; I provided a quick imitation of a monkey 
attending to a client in my shop. The sign writer nodded affably and with 
comprehension. 
PHOTO
Monkey Shop I do your Blackheads
This is the sign I was cheerfully and proudly shown a day or two later. I 
responded as cheerfully with the rest of the cash. I think I may have paid ten 
dollars in all. The chap being de-blackheaded looks a little like me and a 
little like his painter. The shorts are mine, and the back-hairs certainly 
suggest mine – surprisingly too, as I had not removed my shirt for my 
enactment of the purpose of my shop. 
I think the next sign-painting shop I visited was in Pnom Pen, Cambodia's 
capital. There, myself and another young chap who had suggested this shop 
and offered to translate for me, was greeted by a smart and confident youth 
who, with his long and cared-for hair and tight denim, obviously claimed 
kinship with the South-Eastern Asian metal I had been hearing just perhaps a
little too much of. He too was requested to provide a sign for a shop in 
which monkeys removed people's blackheads. He smiled nicely then asked 
for an extra piece of information: “Did the monkey staff extract blackheads 
from ladies?” 
I said they did and he looked delighted. Here is his remarkable response. 
PHOTO
Monkey Shop I do Blackheads
clip
https://youtu.be/Sz7fmqgKZiM";
$j=0;
$s=$txt;
$sz=8000;
while (strlen($s)>0)
{
		$j++;
	    $_SESSION["txt".$j]=substr($s,0,$sz);
		$s = substr($s,$sz);
		 
}
$_SESSION["txtctr"]=$j;
header("location: tmp2.php");