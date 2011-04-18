<?php

if ( $_POST['id'] ) {
    $id = $_POST['id'];
} else {
    $id = rand(1 , 12);
}

# Available Words
if ( $id == 1 ) {
    $word = strtoupper("Hey, kiddo, lost track of time.");
} elseif ( $id == 2 ) {
    $word = strtoupper("Sam, I was paged last night. ");
} elseif ( $id == 3 ) {
    $word = strtoupper("I'm not your father, Sam. But, I'm very very happy to see you.");
} elseif ( $id == 4 ) {
    $word = strtoupper("Your father was the creator.");  
} elseif ( $id == 5 ) {
    $word = strtoupper("Make it there alive. And he'll find you.");  
} elseif ( $id == 6 ) {
    $word = strtoupper("Your move, Flynn. Come on!");  
} elseif ( $id == 7 ) {
    $word = strtoupper("Your old man's about to knock on the sky and listen to the sound.");  
} elseif ( $id == 8 ) {
    $word = strtoupper("Taking herself out of the equation.");  
} elseif ( $id == 9 ) {
    $word = strtoupper("I fight for the users!");  
} elseif ( $id == 10 ) {
    $word = strtoupper("Now that is a BIG door.");  
} elseif ( $id == 11 ) {
    $word = strtoupper("You're messing with my Zen thing, man!");  
} elseif ( $id == 12 ) {
    $word = strtoupper("Some things are worth the risk.");  
}

$letters = str_split($word);

$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$alpha = str_split($alphabet);
$pos = array_flip($alpha);

if ( $_POST['key'] ) {
    $key = $_POST['key'];
} else {
    $key = rand(1, 25);
    $key = $alpha[$key];
}

# Answer 
$answer = '';
foreach ( $letters as $letter ) {
    if ( in_array($letter, $alpha) ) {
        $answer = "$answer$letter";
    }
}

echo "<html><body bgcolor='black'>";
echo '<a href="https://github.com/jness/TRON-Cipher-Puzzle"><font size=2 color=#6cc7d9>Source Available from Github</font></a>';
echo '<h2><img width=200 src="tron_legacy_logo.jpg"></h2>';

# Build my Character Map
$count = $pos[$key];
if ( $count != 0 ) {
    $loop = True;
}

echo '<table width=800><tr>';
while ( $count <= 25 ) {
    echo "<td width=30><font size=5><img src='letters/$alpha[$count].png'></font></td>";
    $count ++;
}

if ( $loop == True ) {
    $count = 0;
    while ( $count < $pos[$key] ) {
        echo "<td width=30><font size=5><img src='letters/$alpha[$count].png'></font></td>";
        $count ++;
    }
}

$count = 0;
echo '</tr><tr>';
while ( $count <= 25 ) {
    print '<td width=30 align=center><img src="down_arrow.png" width=8></td>';
    $count ++;
}
echo '</tr><tr>';

foreach ( $alpha as $letter ) {
    $letter = strtolower($letter);
    echo "<td with=30 align=center><font size=5 color=#6cc7d9>$letter</font></td>";
}
echo '</tr></table>';

# Print out the Cipher Text
echo "<br><br>";

echo '<form action="check.php" method="POST" AUTOCOMPLETE="off">';
echo '<table><tr>';

$count = 0;
$word_count = 1;

foreach ( $letters as $letter ) {
    if ( !in_array($letter, $alpha) ) {
        if ( $letter == ' ' ) {
            echo "<td width=10> <font color=black> - </font> </td>";
            $word_count ++;
        }
            echo "<td width=1 valign='bottom'> <font color=#6cc7d9> $letter </font> </td>";
        continue;
    }

    $drift = $pos[$key];
    $end = $pos[$letter] + $drift;
    if ( $end <= 25 ) {
        if ( $word_count == 4 ) {
            echo '</tr></table><table><tr>';
            $word_count = 1;
        }
        echo "<td align='center' width=1><font size=3><img src='letters/$alpha[$end].png'></font>";
        echo "<br>";
        $user_input = $_POST["input$count"];
             
        echo "<input size=1 maxlength=1 type='text' name='input$count' value=$user_input></td>";

    } else {
        if ( $word_count == 4 ) {
            echo '</tr></table><table><tr>';
            $word_count = 1;
        }
        $newend = $end - 25 - 1;
        echo "<td align='center' width=1><font size=3><img src='letters/$alpha[$newend].png'></font>";
        echo "<br>";
        $user_input = $_POST["input$count"];
            
        echo "<input size=1 maxlength=1 type='text' name='input$count' value=$user_input></td>";
    }
    $count ++;
}

echo '</tr></table>';
echo "<input type=hidden name='answer' value='$answer'>";
echo "<input type=hidden name='word' value=\"$word\">";
echo "<input type=hidden name='id' value=$id>";
echo "<input type=hidden name='key' value=$key>";
echo '<input type="submit" value="Submit" />';
echo '</form>';
echo "<br><br>";
echo '<font size=1 color=#6cc7d9>The Tron Legacy logo is a registered trademark of The Walt Disney Company.</font></a>';
echo "</body></html>";
?>
