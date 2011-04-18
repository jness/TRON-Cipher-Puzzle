<?php

$input = '';
foreach ( $_POST as $key=>$value ) {
    if ( strpos($key, 'put') == 2 ) {
        $value = strtoupper($value);
        $input = "$input$value";
    }
}

$answer = $_POST['answer'];
$word = $_POST['word'];

#print "INPUT: $input<br>";
#print "ANSWER: $answer<br>";

echo "<html><body bgcolor='black'>";
echo '<h2><img width=200 src="tron_legacy_logo.jpg"></h2>';

if ( $input == $answer ) {
    echo '<h1><font color=#6cc7d9>Great work!</font></h1>';
    echo "<A HREF='index.php'><img src='good.jpg'></A><br><br>";
    echo "<h2>$word</h2>";
    echo '<A HREF="index.php"><font color=#6cc7d9>New Puzzle</font></a>';

} else {
    echo '<h1><font color=#fdce20>Sorry that is incorrect</font></h1>';
    echo '<img width=400 src="bad.jpg"><br><br>';

    echo '<form action="index.php" method="POST">';
    $num = 0;
    foreach ( $_POST as $key=>$value ) {
        if ( strpos($key, 'put') == 2 ) {
            echo "<input type=hidden name='input$num' value='$value'>";
            $num ++;
        }
    }
    echo "<input type=hidden name='id' value='$_POST[id]'>";
    echo "<input type=hidden name='key' value='$_POST[key]'>";
    echo '<input type="submit" value="Try Again" />';
    echo '</form>';
}

echo "<br><br>";
echo '<font size=1 color=#6cc7d9>The Tron Legacy logo is a registered trademark of The Walt Disney Company.</font></a>';

?>
